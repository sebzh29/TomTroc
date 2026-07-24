<?php require_once 'views/partials/header.php'; ?>

<!-- HERO -->
<section class="home_hero">

    <div class="container home_hero_container">
       
        <div class="home_hero_text">
            <h1>Rejoignez nos lecteurs passionnés</h1>

            <p>
                Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture.
                Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
            </p>

            <a href="<?= BASE_URL ?>index.php?page=books" class="btn home_hero_btn">Découvrir</a>
        </div>

        <!-- IMAGE -->
        <div class="home_hero_image">
            <img src="<?= BASE_URL ?>assets/images/hamza.png" alt="lecteur" class="home_hero_img">
            <span class="credit">Hamza</span>
        </div>

    </div>

</section>
<!-- LAST BOOKS -->
<section class="home_latest">
    <div class="container">

        <h2>Les derniers livres ajoutés</h2>

        <div class="home_books_grid">

            <?php foreach ($latestBooks as $book): ?>
                <a href="<?= BASE_URL ?>index.php?page=book-show&id=<?= $book['id'] ?>" class="book_card">

                    <div class="book_card_image">
                        <img
                            src="<?= !empty($book['image'])
                                ? BASE_URL . 'assets/images/books/' . htmlspecialchars($book['image'])
                                : BASE_URL . 'assets/images/default-book.png' ?>"
                            alt="<?= htmlspecialchars($book['title']) ?>"
                        >
                    </div>

                    <div class="book_card_content">
                        <h2><?= htmlspecialchars($book['title']) ?></h2>
                        <p class="book_author"><?= htmlspecialchars($book['author']) ?></p>
                        <p class="book_owner">
                            Vendu par : <?= htmlspecialchars($book['username']) ?>
                        </p>
                    </div>

                </a>
            <?php endforeach; ?>

        </div>

        <div class="home_center">
            <a href="<?= BASE_URL ?>index.php?page=books" class="btn">
                Voir tous les livres
            </a>
        </div>

    </div>
</section>

<!-- HOW IT WORKS -->
<section class="home_steps">
    <div class="container">

        <h2>Comment ça marche ?</h2>

        <p class="home_steps_intro">
            Échanger des livres avec TomTroc c’est simple et amusant !
            Suivez ces étapes pour commencer :
        </p>

        <div class="home_steps_grid">

            <div class="home_step_card">
                Inscrivez-vous gratuitement sur notre plateforme.
            </div>

            <div class="home_step_card">
                Ajoutez les livres que vous souhaitez échanger à votre profil.
            </div>

            <div class="home_step_card">
                Parcourez les livres disponibles chez d'autres membres.
            </div>

            <div class="home_step_card">
                Proposez un échange et discutez avec d'autres passionnés de lecture.
            </div>

        </div>

        <div class="home_center">
            <a href="<?= BASE_URL ?>index.php?page=books" class="btn_outline home_outline_btn">
                Voir tous les livres
            </a>
        </div>

    </div>
</section>

<!-- BANNER IMAGE -->
<section class="home_banner">
    <img src="<?= BASE_URL ?>assets/images/library-banner.png" alt="Bibliothèque">
</section>

<!-- VALUES -->
<section class="home_values">
    <div class="home_values_content">

        <h2>Nos valeurs</h2>

        <p>
            Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté.
            Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens
            entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et
            inspirer des conversations enrichissantes.
        </p>

        <p>
            Notre association a été fondée avec une conviction profonde :
            chaque livre mérite d'être lu et partagé.
        </p>

        <p>
            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs
            de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent
            patiemment sur les étagères.
        </p>

        <div class="home_values_signature">
            <span>L’équipe Tom Troc</span>
            <img src="<?= BASE_URL ?>assets/images/vector.svg" alt="coeur vert">
        </div>

    </div>
</section>

<?php require_once 'views/partials/footer.php'; ?>