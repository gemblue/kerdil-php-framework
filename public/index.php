<?php

/**
 * Front Controller
 * 
 * The front controller. Main entry point.
 * 
 * @author Gemblue
 */

/** Environment mode. */
$config = require '../config/main.php';

switch ($config['environment']) {
    case 'development':
        
        ini_set('display_errors', 1); 
        ini_set('display_startup_errors', 1); 
        error_reporting(E_ALL);
        
        break;
        
    case 'staging':
        
        break;

    case 'production':
        
        break;
}

/** Point to bootstrap */
require '../Core/Bootstrap.php';