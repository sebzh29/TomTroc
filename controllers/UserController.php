<?php

class UserController
{
    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        $userModel = new User();
        $bookModel = new Book();

        $user = $userModel->findById($_SESSION['user']['id']);
        $books = $bookModel->findByUser($_SESSION['user']['id']);

        require 'views/user/profile.php';
    }

    public function publicProfile()
    {
        if (empty($_GET['id'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $userModel = new User();
        $bookModel = new Book();

        $user = $userModel->findById((int) $_GET['id']);

        if (!$user) {
            header('Location: ' . BASE_URL);
            exit;
        }

        // 🔥 uniquement livres disponibles (logique plateforme)
        $books = $bookModel->findAvailableByUser($user['id']);

        require 'views/user/public-profile.php';
    }
    
    public function edit()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findById($_SESSION['user']['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);

            if ($username && $email) {
                $userModel->update($user['id'], $username, $email);

                // update session
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;
            } 

            // upload avatar
            if (!empty($_FILES['avatar']['name'])) {
                $filename = time() . '_' . $_FILES['avatar']['name'];
                move_uploaded_file($_FILES['avatar']['tmp_name'], 'assets/images/avatar/' . $filename);
                $userModel->updateAvatar($user['id'], $filename);

                $_SESSION['user']['avatar'] = $filename;
}

            header('Location: ' . BASE_URL . 'index.php?page=account');
            exit;
        }

        require 'views/user/edit.php';
    }
}