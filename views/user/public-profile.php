<?php require 'views/partials/header.php'; ?>

<section class="public_profile">

    <div class="container">

        <div class="public_profile_header">

            <img
                src="<?= !empty($user['avatar'])
                    ? BASE_URL . 'assets/images/avatar/' . $user['avatar']
                    : BASE_URL . 'assets/images/default-avatar.png' ?>"
                class="public_avatar"
            >

            <div>
                <h1><?= htmlspecialchars($user['username']) ?></h1>
                <p><?= count($books) ?> livres disponibles</p>
            </div>

        </div>

        <div class="public_books_grid">

            <?php foreach ($books as $book): ?>

                <a href="<?= BASE_URL ?>index.php?page=book-show&id=<?= $book['id'] ?>" class="book_card">

                    <div class="book_card_image">
                        <img 
                            src="<?= !empty($book['image'])
                                ? BASE_URL . 'assets/images/books/' . $book['image']
                                : BASE_URL . 'assets/images/default-book.png' ?>"
                        >
                    </div>

                    <div class="book_card_content">
                        <h2><?= htmlspecialchars($book['title']) ?></h2>
                        <p class="book_author"><?= htmlspecialchars($book['author']) ?></p>
                    </div>

                </a>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>