<?php

/**
 * Routes
 * 
 * Routes config, will be read and pointed to the controller method.
 */

// Get sample
$router->get('/home', 'Home', 'index');
$router->get('/callback', function(){
    echo 'It works!';
});

// Trial controller with model.
$router->get('/users', 'User', 'index');
$router->get('/users/register', 'User', 'register');

// Rest response
$router->get('/rest', 'Rest', 'index');

// Modular test.
$router->get('/samples/trial', 'Samples/Trial', 'index');