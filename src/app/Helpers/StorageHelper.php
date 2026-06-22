<?php

namespace App\Helpers;

class StorageHelper
{
    /**
     * Generate public URL for a file stored in OSS or fallback to local storage.
     */
    public static function url(?string $path): string
    {
        if (!$path) {
            return '';
        }

        $ossUrl = config('filesystems.disks.oss.url');

        if ($ossUrl) {
            return rtrim($ossUrl, '/') . '/' . ltrim($path, '/');
        }

        // Fallback ke local storage
        return asset('storage/' . $path);
    }
}
