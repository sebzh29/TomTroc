<?php require 'views/partials/header.php'; ?>

<section class="book_detail">

    <div class="book_detail_image">
        <img
            src="<?= !empty($book['image'])
                ? BASE_URL . 'assets/images/books/' . htmlspecialchars($book['image'])
                : BASE_URL . 'assets/images/default-book.png' ?>"
            alt="<?= htmlspecialchars($book['title']) ?>"
        >
    </div>

    <div class="book_detail_content">

        <p class="book_detail_breadcrumb">
            Nos livres &gt; <?= htmlspecialchars($book['title']) ?>
        </p>

        <h1><?= htmlspecialchars($book['title']) ?></h1>

        <p class="book_detail_author">
            par <?= htmlspecialchars($book['author']) ?>
        </p>

        <div class="book_detail_separator"></div>

        <h2>Description</h2>

        <p class="book_detail_description">
            <?= nl2br(htmlspecialchars($book['description'])) ?>
        </p>

        <h2>Propriétaire</h2>

        <a
  href="<?= BASE_URL ?>index.php?page=user-profile&id=<?= $book['user_id'] ?>"
  class="book_owner_card"
>
  <img
    src="<?= !empty($book['owner_avatar'])
      ? BASE_URL . 'assets/images/avatar/' . htmlspecialchars($book['owner_avatar'])
      : BASE_URL . 'assets/images/default-avatar.png' ?>"
    alt="<?= htmlspecialchars($book['owner_username']) ?>"
  >

  <span><?= htmlspecialchars($book['owner_username']) ?></span>
</a>

        <a
    href="<?= BASE_URL ?>index.php?page=messages&to=<?= $book['user_id'] ?>"
    class="btn book_detail_btn"
>
    Envoyer un message
</a>

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>