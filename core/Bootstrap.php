<?php

/**
 * Bootstrap
 * 
 * Bootstrapping dependencies.
 */

/** Require dependencies */
require 'Router.php';

use Core\Router;

$router = new Router;

include '../routes/main.php';

$router->run();