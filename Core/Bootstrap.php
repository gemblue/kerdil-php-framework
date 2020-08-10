<?php

/**
 * Bootstrap
 * 
 * Bootstrapping dependencies.
 * 
 * @author Gemblue
 */

/** Dependencies  */
spl_autoload_register(function ($namespace) {

    $segment = explode('\\', $namespace);
    
    if (count($segment) > 2) {
        require '../' . $segment[0] . '/' . $segment[1] . '/' . $segment[2] . '.php';
    } else {
        require '../' . $segment[0] . '/' . $segment[1] . '.php';
    }
});

use Core\Router;

$router = new Router;

/** Load userland route config */
require '../routes/main.php';

/** Run Router */
$router->run();