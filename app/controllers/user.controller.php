<?php
require_once './app/views/user.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/user.helpers.php';


class AuthController{
private $model;
private $view;
    public function __construct(){
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if (empty($usuario) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByUser($usuario);
        if ($user && password_verify($password, $user->contraseña)) {
            // ACA LO AUTENTIQUE
            
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
}
