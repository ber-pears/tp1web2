<?php
require_once './app/views/user.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/user.helper.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new UserView();
    }

    public function login() {
        $this->view->login();
    }

    public function auth() {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if (empty($usuario) || empty($password)) {
            $this->view->login('Faltan completar campos de datos');
            return;
        }

        
        $user = $this->model->getByUser($usuario);
        if ($user && password_verify($password,$user->contraseña)) {
            AuthHelper::login($user); 
            header('Location: ' . BASE_URL .'home');
        } else {
            $this->view->login('Usuario no válido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
}
