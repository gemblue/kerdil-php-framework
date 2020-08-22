<?php

namespace Controllers;

use Core\Controller;
use Core\Utility\Debug;
use Core\Request;
use Core\View;
use Models\User as UserModel;

class User extends Controller {

    public $view;
    public $request;
    
    public function __construct() {
        
        parent::__construct();

        $this->request = new Request;
        $this->view = new View;
    }

    public function index() {
        
        $UserModel = new UserModel;
        
        $users = $UserModel->all();

        $this->view->render('users/index', ['users' => $users]);
    }

    public function add() {
        $this->view->render('users/add', []);
    }

    public function register() {
        
        $post = $this->request->post();

        $UserModel = new UserModel;

        $UserModel->register($post['name'], $post['email']);
        
        echo '<meta http-equiv="refresh" content="0; url=http://localhost/lab/Framework/public/users">';
    }

    public function update() {
        
        $UserModel = new UserModel;

        $UserModel->update();
        
        echo 'Sip, sudah update pak!';
    }

    public function delete() {
        
        $UserModel = new UserModel;
        
        $id = $this->request->get('id');
        $UserModel->delete($id);
        
        echo '<meta http-equiv="refresh" content="0; url=http://localhost/lab/Framework/public/users">';
    }
}