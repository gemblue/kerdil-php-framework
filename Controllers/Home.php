<?php

namespace Controllers;

use Core\Controller;
use Core\View;

class Home extends Controller {

    public $view;

    public function __construct() {
        
        parent::__construct();

        $this->view = new View;
    }

    public function index() {

        $this->view->render('index', [
            'name' => 'Jhonny'
        ]);
    }
}