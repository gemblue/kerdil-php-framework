<?php

/**
 * Routes
 * 
 * Routes config, will be read and pointed to the controller method.
 */

// Get sample
$router->get('/home', 'Home', 'index');
$router->get('/about', 'Home', 'about');
$router->get('/callback', function(){
    echo 'It works!';
});

// Rest response
$router->get('/rest', 'Rest', 'index');

// Modular test.
$router->get('/samples/trial', 'Samples/Trial', 'index');