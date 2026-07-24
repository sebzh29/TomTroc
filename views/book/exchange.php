<?php require 'views/partials/header.php'; ?>

<section class="books_exchange page">

    <div class="container books_exchange_container">

        <div class="books_exchange_header">
            <h1>Nos livres à l’échange</h1>

            <form method="GET" class="books_search">
              <input type="hidden" name="page" value="books">
              <input type="text" name="search" placeholder="Rechercher un livre">
          </form>
        </div>

        <div class="books_grid">

            <?php foreach ($books as $book): ?>

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

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>