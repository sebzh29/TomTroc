<!DOCTYPE html>
<html lang="fr">

<?php
$currentPage = $_GET['page'] ?? 'home';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>

    <!-- Google Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>

<body>

<header class="header">
    <div class="container header_container">
        
         <!-- LOGO & NAV LEFT -->
        <div class="header_left">
            <img src="<?= BASE_URL ?>assets/images/logo.png" alt="logo" class="header_logo_img">            

            <nav class="header_nav_left">
                <a class="<?= $currentPage === 'home' ? 'active' : '' ?>" href="index.php?page=home">Accueil</a>
                <a class="<?= $currentPage === 'books' ? 'active' : '' ?>" href="index.php?page=books">Nos livres à l’échange</a>
            </nav>
        </div>

       <!-- NAV RIGHT -->
        <nav class="header_nav_right">

            <?php if (isset($_SESSION['user'])): ?>

                <a
                    class="<?= $currentPage === 'messages' ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>index.php?page=messages"
                >
                    Messagerie <span class="badge">1</span>
                </a>

                <a
                    class="<?= $currentPage === 'account' ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>index.php?page=account"
                >
                    Mon compte
                </a>

                <a href="<?= BASE_URL ?>index.php?page=logout">
                    Déconnexion
                </a>

            <?php else: ?>

                <a
                    class="<?= $currentPage === 'login' ? 'active' : '' ?>"
                    href="<?= BASE_URL ?>index.php?page=login"
                >
                    Connexion
                </a>

            <?php endif; ?>

        </nav>
    </div>
</header>

<main class="main-content">