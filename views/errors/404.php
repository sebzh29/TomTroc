<?php require 'views/partials/header.php'; ?>

<section class="error404">
    <div class="container error404_container">

        <p class="error404_code">404</p>

        <h1>Oups... cette page n'existe pas.</h1>

        <p class="error404_text">
            La page demandée est introuvable ou a été supprimée.
        </p>

        <a href="<?= BASE_URL ?>index.php?page=home" class="btn error404_btn">
            Retour à l'accueil
        </a>

    </div>
</section>

<?php require 'views/partials/footer.php'; ?>