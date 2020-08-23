<?php

declare(strict_types=1);

namespace Core\Utility;

use function print_r;

/**
 * Debug
 *
 * For debug purpose.
 */
class Debug
{
    /**
     * Debug::dump
     */
    public static function dump(mixed $data, int $exit = 0): void
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if ($exit) {
            exit;
        }
    }
}
