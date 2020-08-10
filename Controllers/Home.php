<?php

namespace Controllers;

use Core\Controller;

class Home extends Controller {
    
    public function __construct() {
        
        parent::__construct();
    }

    public function index() {
        echo 'Welcome home ..';
    }
}