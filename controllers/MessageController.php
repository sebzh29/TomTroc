<?php

class MessageController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        $messageModel = new Message();
        $userModel = new User();

        $currentUserId = (int) $_SESSION['user']['id'];

        $conversations = $messageModel->getConversations($currentUserId);

        $selectedUser = null;
        $messages = [];

        if (!empty($_GET['to'])) {
            $selectedUser = $userModel->findById((int) $_GET['to']);

            if ($selectedUser) {
                $messages = $messageModel->getConversation(
                    $currentUserId,
                    (int) $selectedUser['id']
                );
            }
        }

        require 'views/messages/index.php';
    }

    public function send()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'index.php?page=messages');
            exit;
        }

        $receiverId = (int) $_POST['receiver_id'];
        $content = trim($_POST['content']);

        if ($receiverId > 0 && $content !== '') {
            $messageModel = new Message();
            $messageModel->create(
                (int) $_SESSION['user']['id'],// debug avant envoie voir diff variable
                $receiverId,
                $content
            );
        }

        header('Location: ' . BASE_URL . 'index.php?page=messages&to=' . $receiverId);
        exit;
    }
}