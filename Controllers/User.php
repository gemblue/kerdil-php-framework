<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Core\Request;
use Core\Utility\Url;
use Core\View;
use Models\User as UserModel;

class User extends Controller
{
    public $view;
    public $request;

    public function __construct()
    {
        parent::__construct();

        $this->request = new Request();
        $this->view    = new View();
    }

    public function index(): void
    {
        $UserModel = new UserModel();

        $users = $UserModel->all();

        $this->view->render('users/index', ['users' => $users]);
    }

    public function add(): void
    {
        $this->view->render('users/add', []);
    }

    public function register(): void
    {
        $post = $this->request->post();

        $UserModel = new UserModel();

        $UserModel->register($post['name'], $post['email']);

        Url::redirect('users');
    }

    public function update(): void
    {
        $UserModel = new UserModel();

        $UserModel->update();

        echo 'Sip, sudah update pak!';
    }

    public function delete(): void
    {
        $UserModel = new UserModel();

        $id = $this->request->get('id');
        $UserModel->delete($id);

        Url::redirect('users');
    }
}
