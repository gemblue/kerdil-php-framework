<?php

/**
 * Routes
 * 
 * Routes config, will be read and pointed to the controller method.
 */

$router->get('/home', 'Home', 'index');
$router->get('/about', 'Home', 'about');
$router->get('/callback', function(){
    echo 'It works!';
});

// Modular test.
$router->get('/samples/trial', 'Samples/Trial', 'index');