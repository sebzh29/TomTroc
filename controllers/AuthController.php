<?php

class AuthController
{
    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {

                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ];

                header('Location: ' . BASE_URL . 'index.php?page=home');
                exit;

            } else {
                $error = "Email ou mot de passe incorrect";
            }
        }

        require 'views/auth/login.php';
    }

    public function register()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userModel = new User();

            // Vérifier si email existe déjà
            if ($userModel->findByEmail($email)) {
                $error = "Email déjà utilisé";
            } else {

                $userModel->create($username, $email, $password);

                header('Location: ' . BASE_URL . 'index.php?page=login');
                exit;
            }
        }

        require 'views/auth/register.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit;
    }
}