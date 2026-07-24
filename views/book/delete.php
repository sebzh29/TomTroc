<?php require 'views/partials/header.php'; ?>

<section class="delete_page">
    <div class="delete_card">

        <h1>Supprimer ce livre ?</h1>

        <p>
            Es-tu sûr de vouloir supprimer
            <strong><?= htmlspecialchars($book['title']) ?></strong> ?
        </p>

        <div class="delete_actions">
            <a class="btn_outline" href="<?= BASE_URL ?>index.php?page=account">Annuler</a>

            <form method="POST" action="<?= BASE_URL ?>index.php?page=book-delete&id=<?= $book['id'] ?>">
              <button class="btn delete_btn" type="submit">Supprimer</button>
          </form>
        </div>

    </div>
</section>

<?php require 'views/partials/footer.php'; ?>