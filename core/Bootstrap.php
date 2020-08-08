<?php

/**
 * Bootstrap
 * 
 * Bootstrapping dependencies.
 * 
 * @author Gemblue
 */

/** Dependencies  */
spl_autoload_register(function ($param) {

    $class = explode('\\', $param);
    
    require '../' . strtolower($class[0]) . '/' . $class[1] . '.php';

});

use Core\Router;

$router = new Router;

/** Load userland route config */
require '../routes/main.php';

/** Run Router */
$router->run();