<?php

namespace Controllers;

class Home {

    public function __construct() {
        echo 'Home was instantiated .. <br/>';
    }

    public function index() {
        echo 'Home index ..';
    }
    
    public function about() {
        echo 'Halaman about ..';
    }
}