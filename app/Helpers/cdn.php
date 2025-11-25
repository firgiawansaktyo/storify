<?php

if (! function_exists('cdn_sweetvows')) {
    function cdn_sweetvows(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $base = rtrim(config('cdn.sweetvows'), '/');
        $path = ltrim($path, '/');

        return $base . '/' . $path;
    }
}
