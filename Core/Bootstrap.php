<?php

declare(strict_types=1);

use Core\Router;

/**
 * Bootstrap
 *
 * The bootstrapper, everything start from here.
 */
spl_autoload_register(static function ($namespace): void {
    $segment = explode('\\', $namespace);

    if (count($segment) > 2) {
        require '../' . $segment[0] . '/' . $segment[1] . '/' . $segment[2] . '.php';
    } else {
        require '../' . $segment[0] . '/' . $segment[1] . '.php';
    }
});

/** Run router */
$router = new Router();

/** Load userland route config */
require '../routes/main.php';

/** Run Router */
$router->run();
