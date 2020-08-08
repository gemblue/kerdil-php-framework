<?php

namespace Controllers;

use Core\Controller;
use Core\Response;

class Rest extends Controller {

    private $response;

    public function __construct() {
    
        parent::__construct();
        
        $this->response = new Response;
    }

    public function index() {
        
        $this->response->setHeader('HTTP/1.1 200 OK')
                       ->setHeader('Content-type: application/json; charset=utf-8')
                       ->showJSON(['Foo' => 'Bar']);
    }
}