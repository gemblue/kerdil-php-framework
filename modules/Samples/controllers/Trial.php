<?php

namespace Samples\Controllers;

class Trial {

    public function __construct() {
        echo 'Trial was instantiated .. <br/>';
    }

    public function index() {
        echo 'Trial index ..';
    }
    
    public function about() {
        echo 'Trial about ..';
    }
}