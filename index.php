<?php
require_once 'config/config.php';
require_once 'config/autoload.php';

require_once 'controllers/AuthController.php';

$page = $_GET['page'] ?? 'home';

$controller = new AuthController();

switch ($page) {
    case 'home':
        $bookModel = new Book();
        $latestBooks = $bookModel->findLatest(4);
        require 'views/home.php';
        break;
        
    case 'register':
        $controller->register();
        break;

    case 'login':
        $controller->login();
        break;
    case 'account':
        (new UserController())->profile();
        break;
    case 'user-profile':
    (new UserController())->publicProfile();
    break;
    case 'edit-account':
        (new UserController())->edit();
        break;
    case 'book-create':
    (new BookController())->create();
    break;

    case 'book-edit':
        (new BookController())->edit();
        break;

    case 'book-delete':
        (new BookController())->delete();
        break;

    case 'book-show':
        (new BookController())->show();
        break;
    case 'books':
    (new BookController())->exchange();
    break;
    case 'messages':
    (new MessageController())->index();
    break;

    case 'message-send':
        (new MessageController())->send();
        break;
        case 'logout':
            $controller->logout();
            break;
  
    default:
        http_response_code(404);
        require 'views/errors/404.php';
        exit;
        
}