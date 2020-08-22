<?php

/**
 * Bootstrap
 * 
 * The bootstrapper, everything start from here.
 * 
 * @author Gemblue
 */

/**
 * Setup dependencies
 */
use Core\Router;

/** Class Dependencies  */
spl_autoload_register(function ($namespace) {

    $segment = explode('\\', $namespace);
    
    if (count($segment) > 2) {
        require '../' . $segment[0] . '/' . $segment[1] . '/' . $segment[2] . '.php';
    } else {
        require '../' . $segment[0] . '/' . $segment[1] . '.php';
    }
});

/**
 * Run router
 */
$router = new Router;

/** Load userland route config */
require '../routes/main.php';

/** Run Router */
$router->run();