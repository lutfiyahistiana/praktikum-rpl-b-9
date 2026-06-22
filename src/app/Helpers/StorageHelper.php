<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public static function disk(): string
    {
        return (env('OSS_ACCESS_KEY_ID') && env('OSS_BUCKET')) ? 'oss' : 'public';
    }

    public static function store(\Illuminate\Http\UploadedFile $file, string $directory): string
    {
        return $file->store($directory, self::disk());
    }

    public static function storeAs(\Illuminate\Http\UploadedFile $file, string $directory, string $fileName): string
    {
        return $file->storeAs($directory, $fileName, self::disk());
    }

    public static function delete(string $path): void
    {
        try {
            Storage::disk(self::disk())->delete($path);
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

        if ($ossUrl && env('OSS_ACCESS_KEY_ID')) {
            return rtrim($ossUrl, '/') . '/' . ltrim($path, '/');
        }

        return Storage::disk('public')->url($path);
    }
}
