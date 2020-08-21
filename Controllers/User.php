<?php

namespace Controllers;

use Core\Controller;
use Core\Utility\Debug;
use Core\Request;
use Models\User as UserModel;

class User extends Controller {
    
    public function __construct() {
        
        parent::__construct();
    }

    public function index() {
        
        $UserModel = new UserModel;
        
        $users = $UserModel->all();
        
        Debug::dump($users);
    }

    public function register() {
        
        $UserModel = new UserModel;

        $UserModel->register('sample@mailinator.com');
        
        echo 'Sip, masuk pak!';
    }

    public function update() {
        
        $UserModel = new UserModel;

        $UserModel->update();
        
        echo 'Sip, sudah update pak!';
    }

    public function delete() {
        
        $Request = new Request();
        $UserModel = new UserModel;

        $id = $Request->get('id');
        $UserModel->delete($id);
        
        echo 'Sip, sudah dihapus pak!';
    }
}