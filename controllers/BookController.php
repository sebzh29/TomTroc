<?php

class BookController
{
    /**
     * Liste des livres de l'utilisateur (déjà utilisé dans profile)
     */
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        $bookModel = new Book();
        $books = $bookModel->findByUser($_SESSION['user']['id']);

        require 'views/book/index.php';
    }

    /**
     * Ajouter un livre
     */
    public function create()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'title' => trim($_POST['title']),
                'author' => trim($_POST['author']),
                'description' => trim($_POST['description']),
                'status' => $_POST['status'],
                'user_id' => $_SESSION['user']['id'],
                'image' => null
            ];

            // 📸 upload image
            if (!empty($_FILES['image']['name'])) {
                $filename = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/books/' . $filename);
                $data['image'] = $filename;
            }

            $bookModel = new Book();
            $bookModel->create($data);

            header('Location: ' . BASE_URL . 'index.php?page=account');
            exit;
        }

        require 'views/book/create.php';
    }

    /**
     * Modifier un livre
     */
    public function edit()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->findById($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'title' => trim($_POST['title']),
                'author' => trim($_POST['author']),
                'description' => trim($_POST['description']),
                'status' => $_POST['status'],
                'image' => $book['image']
            ];

            // upload nouvelle image
            if (!empty($_FILES['image']['name'])) {
                $filename = time() . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/books/' . $filename);
                $data['image'] = $filename;
            }

            $bookModel->update($book['id'], $data);

            header('Location: ' . BASE_URL . 'index.php?page=account');
            exit;
        }

        require 'views/book/edit.php';
    }

  /**
 * Supprimer avec confirmation
 */
public function delete()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit;
    }

    if (empty($_GET['id'])) {
        header('Location: ' . BASE_URL . 'index.php?page=account');
        exit;
    }

    $bookModel = new Book();
    $book = $bookModel->findById((int) $_GET['id']);

    if (!$book) {
        header('Location: ' . BASE_URL . 'index.php?page=account');
        exit;
    }

    // Sécurité : empêcher de supprimer le livre d’un autre utilisateur
    if ((int) $book['user_id'] !== (int) $_SESSION['user']['id']) {
        header('Location: ' . BASE_URL . 'index.php?page=account');
        exit;
    }

    // Si POST => suppression réelle
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookModel->delete((int) $book['id']);

        header('Location: ' . BASE_URL . 'index.php?page=account');
        exit;
    }

    // Si GET => page de confirmation
    require 'views/book/delete.php';
}

    /**
     * Détail d'un livre
     */
    public function show()
    {
        if (empty($_GET['id'])) {
            header('Location: ' . BASE_URL . 'index.php?page=books');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->findById((int) $_GET['id']);

        if (!$book) {
            header('Location: ' . BASE_URL . 'index.php?page=books');
            exit;
        }

        require 'views/book/show.php';
    }

    /** 
     * Page d'échange (liste de tous les livres)
     */
    public function exchange()
    {
        $search = $_GET['search'] ?? null;

        $bookModel = new Book();
        $books = $bookModel->findAvailable($search);

        require 'views/book/exchange.php';
    }
}