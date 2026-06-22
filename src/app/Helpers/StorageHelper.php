<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Generate public URL for a file.
     * Uses OSS URL if configured, otherwise falls back to local public storage.
     */
    public static function url(?string $path): string
    {
        if (!$path) {
            return '';
        }

        $ossUrl = env('OSS_URL');

        if ($ossUrl) {
            return rtrim($ossUrl, '/') . '/' . ltrim($path, '/');
        }

        return Storage::disk('public')->url($path);
    }
}
