<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class StorageHelper
{
    private static function ossConfigured(): bool
    {
        return config('filesystems.disks.oss.key')
            && config('filesystems.disks.oss.bucket');
    }

    /**
     * Upload file to OSS via signed HTTP PUT request.
     * Returns the object path (key).
     */
    private static function uploadToOss(UploadedFile $file, string $directory, string $fileName): string
    {
        $key        = trim($directory, '/') . '/' . $fileName;
        $bucket     = env('OSS_BUCKET');
        $endpoint   = env('OSS_ENDPOINT');
        $accessId   = env('OSS_ACCESS_KEY_ID');
        $accessKey  = env('OSS_ACCESS_KEY_SECRET');
        $date       = gmdate('D, d M Y H:i:s \G\M\T');
        $contentType = $file->getMimeType();
        $content    = file_get_contents($file->getRealPath());
        $md5        = base64_encode(md5($content, true));

        $stringToSign = "PUT\n{$md5}\n{$contentType}\n{$date}\n/{$bucket}/{$key}";
        $signature    = base64_encode(hash_hmac('sha1', $stringToSign, $accessKey, true));

        $url = "https://{$bucket}.{$endpoint}/{$key}";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_POSTFIELDS     => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                "Content-Type: {$contentType}",
                "Content-MD5: {$md5}",
                "Date: {$date}",
                "Authorization: OSS {$accessId}:{$signature}",
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \Exception("OSS upload failed with HTTP {$httpCode}: {$response}");
        }

        return $key;
    }

    /**
     * Delete file from OSS via signed HTTP DELETE request.
     */
    private static function deleteFromOss(string $path): void
    {
        $key      = ltrim($path, '/');
        $bucket   = env('OSS_BUCKET');
        $endpoint = env('OSS_ENDPOINT');
        $accessId = env('OSS_ACCESS_KEY_ID');
        $accessKey = env('OSS_ACCESS_KEY_SECRET');
        $date     = gmdate('D, d M Y H:i:s \G\M\T');

        $stringToSign = "DELETE\n\n\n{$date}\n/{$bucket}/{$key}";
        $signature    = base64_encode(hash_hmac('sha1', $stringToSign, $accessKey, true));

        $url = "https://{$bucket}.{$endpoint}/{$key}";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'DELETE',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                "Date: {$date}",
                "Authorization: OSS {$accessId}:{$signature}",
            ],
        ]);
        curl_exec($ch);
        curl_close($ch);
    }

    public static function store(UploadedFile $file, string $directory): string
    {
        // Sanitize filename — replace spaces with underscores
        $originalName = str_replace(' ', '_', $file->getClientOriginalName());
        $fileName = uniqid() . '_' . $originalName;
        return self::storeAs($file, $directory, $fileName);
    }

    public static function storeAs(UploadedFile $file, string $directory, string $fileName): string
    {
        if (self::ossConfigured()) {
            try {
                return self::uploadToOss($file, $directory, $fileName);
            } catch (\Throwable $e) {
                // Fallback to public disk
            }
        }

        return $file->storeAs($directory, $fileName, 'public');
    }

    public static function delete(string $path): void
    {
        try {
            if (self::ossConfigured()) {
                self::deleteFromOss($path);
            } else {
                Storage::disk('public')->delete($path);
            }
        } catch (\Throwable $e) {
            // Fail silently
        }
    }

    public static function url(?string $path): string
    {
        if (!$path) {
            return '';
        }

        $ossUrl = env('OSS_URL');

        if ($ossUrl && self::ossConfigured()) {
            // Encode path segments to handle spaces and special chars
            $encodedPath = implode('/', array_map('rawurlencode', explode('/', ltrim($path, '/'))));
            return rtrim($ossUrl, '/') . '/' . $encodedPath;
        }

        return Storage::disk('public')->url($path);
    }
}
