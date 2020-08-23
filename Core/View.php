<?php

declare(strict_types=1);

namespace Core;

use Exception;

use function extract;
use function file_exists;
use function ob_get_clean;
use function ob_start;

/**
 * View
 *
 * Simple stupid view.
 */
class View
{
    /** @var string View folder path */
    public $path = '../Views/';

    /**
     * View::render
     */
    public function render(string $file, mixed $args): string
    {
        $path = $this->path . $file . '.php';

        if (! file_exists($path)) {
            return new Exception('Missing view file : ' . $path);
        }

        // Start
        ob_start();

        /** Pakai extract dulu sampai nemu cara terbaik. Punteun ya cs. */
        // phpcs:disable
        extract($args);
        // phpcs:enable

        // Masukan content template.
        include $path;

        // Get Clean
        $content = ob_get_clean();

        // Show output.
        echo $content;
    }
}
