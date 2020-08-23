<?php

declare(strict_types=1);

namespace Core\Utility;

/**
 * Url
 *
 * For url handling.
 */
class Url
{
    /**
     * Get base url.
     */
    public static function base(): string
    {
        $config = require '../config/main.php';

        return $config['base_url'];
    }

    /**
     * Redirect url.
     */
    public static function redirect(?string $path = null): void
    {
        $path = self::base() . $path;

        echo '<meta http-equiv="refresh" content="0; url=' . $path . '">';

        exit;
    }
}
