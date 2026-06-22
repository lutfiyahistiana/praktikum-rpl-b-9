<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Determine which disk to use — OSS if configured, otherwise public.
     */
    public static function disk(): string
    {
        return env('OSS_ACCESS_KEY_ID') ? 'oss' : 'public';
    }

    /**
     * Store a file using the appropriate disk.
     */
    public static function store(\Illuminate\Http\UploadedFile $file, string $directory): string
    {
        return $file->store($directory, self::disk());
    }

    /**
     * Store a file with a specific name using the appropriate disk.
     */
    public static function storeAs(\Illuminate\Http\UploadedFile $file, string $directory, string $fileName): string
    {
        return $file->storeAs($directory, $fileName, self::disk());
    }

    /**
     * Delete a file from the appropriate disk.
     */
    public static function delete(string $path): void
    {
        try {
            Storage::disk(self::disk())->delete($path);
        } catch (\Exception $e) {
            // Fail silently — file deletion should not block the app
        }
    }

    /**
     * Generate public URL for a file.
     */
    public static function url(?string $path): string
    {
        if (!$path) {
            return '';
        }

        $ossUrl = env('OSS_URL');

        if ($ossUrl && env('OSS_ACCESS_KEY_ID')) {
            return rtrim($ossUrl, '/') . '/' . ltrim($path, '/');
        }

        return Storage::disk('public')->url($path);
    }
}
