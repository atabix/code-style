<?php

const CONFIG_FILE = '.php-cs-fixer.config';
const CONFIG_URL = 'https://raw.githubusercontent.com/atabix/code-style/main/php-cs-fixer.config.php';
const CACHE_MINUTES_TTL = 60;

if (Cache::expired(CONFIG_FILE, CACHE_MINUTES_TTL)) {
    Cache::download(CONFIG_URL, CONFIG_FILE);
}

if (! class_exists(PhpCsFixer\Finder::class)) {
    return null;
}

return require CONFIG_FILE;

class Cache
{
    public static function expired($file, $minutes = 5)
    {
        $isValid = file_exists(rtrim(__DIR__, '/') . '/'. $file) && (filemtime(rtrim(__DIR__, '/') . '/'. $file) > (time() - 60 * $minutes));

        return ! $isValid;
    }

    public static function download($url, $file)
    {
        $context = [
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
        ];
        $contents = file_get_contents($url, false, stream_context_create($context));

        if (strlen($contents) < 100) {
            throw new Exception('Empty source');
        }

        file_put_contents(rtrim(__DIR__, '/') .'/'. $file, $contents, LOCK_EX);

        return 0;
    }
}
