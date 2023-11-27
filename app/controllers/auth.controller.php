<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helpers.php';

class AuthController
{
    private $view;
    private $model; 

    function __construct(){
        $this->view = new AuthView();
        $this->model = new UserModel();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth(){
        $username = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        if (empty($username) || empty($contraseña)) {
            $this->view->showLogin('Faltan datos');
            return;
        }
        $user = $this->model->getByUser($username);
        if ($user && password_verify($contraseña, $user->password)) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . 'home');
        } else {
            $this->view->showLogin("User invalido");
        }
    }

    public function logout(){
        AuthHelper::init();
        if (isset($_SESSION['USER_ID'])) {
            // procede con la desconexión
            AuthHelper::logout();
        }

        header('Location: ' . BASE_URL);
    }

    
}