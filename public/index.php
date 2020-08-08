<?php

/**
 * Front Controller
 * 
 * Titik mulai semuanya.
 */

/** Setting error mode. */
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

/** Point to bootstrap */
require '../core/Bootstrap.php';