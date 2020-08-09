<?php

namespace Controllers;

use Core\Controller;
use Models\User as UserModel;

class User extends Controller {
    
    public function __construct() {
        
        parent::__construct();
    }

    public function index() {
        
        $UserModel = new UserModel;

        $users = $UserModel->all();
        
        print_r($users);
    }

    public function register() {
        
        $UserModel = new UserModel;

        $UserModel->register('sample@mailinator.com');
        
        echo 'Sip, masuk pak!';
    }
}