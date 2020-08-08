<?php

/**
 * Bootstrap
 * 
 * Bootstrapping dependencies.
 * 
 * @author Gemblue
 */

/** Requirements  */
require 'Router.php';

/** Run Router */
use Core\Router;

$router = new Router;

require '../routes/main.php';

$router->run();