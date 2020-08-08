<?php

namespace Controllers;

use Core\Controller;
use Core\Request;

class Home extends Controller {

    private $request;

    public function __construct() {
    
        parent::__construct();
        
        $this->request = new Request;
    }

    public function index() {
        
        $name = $this->request->get('name');
        
        echo $name;
    }
    
    public function about() {
        echo 'Halaman about ..';
    }
}