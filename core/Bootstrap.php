<?php

/**
 * Bootstrap
 * 
 * Bootstrapping dependencies.
 * 
 * @author Gemblue
 */

/** Dependencies  */
require 'Router.php';
require 'Controller.php';
require 'Request.php';

use Core\Router;

$router = new Router;

/** Load userland route config */
require '../routes/main.php';

/** Run Router */
$router->run();