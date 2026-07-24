<?php require 'views/partials/header.php'; ?>

<section class="book_form_page">
    <div class="container book_form_container">

        <a href="<?= BASE_URL ?>index.php?page=account" class="back_link">← retour</a>

        <h1>Modifier les informations</h1>

        <form method="POST" enctype="multipart/form-data" class="book_form">

            <div class="form_group">
                <label>Photo actuelle</label>

                <img
                    src="<?= !empty($book['image'])
                        ? BASE_URL . 'assets/images/books/' . htmlspecialchars($book['image'])
                        : BASE_URL . 'assets/images/default-book.png' ?>"
                    class="book_form_preview"
                    alt="<?= htmlspecialchars($book['title']) ?>"
                >

                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form_group">
                <label>Titre</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>

            <div class="form_group">
                <label>Auteur</label>
                <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>

            <div class="form_group">
                <label>Commentaire</label>
                <textarea name="description" required><?= htmlspecialchars($book['description']) ?></textarea>
            </div>

            <div class="form_group">
                <label>Disponibilité</label>
                <select name="status" required>
                    <option value="available" <?= $book['status'] === 'available' ? 'selected' : '' ?>>
                        disponible
                    </option>
                    <option value="unavailable" <?= $book['status'] === 'unavailable' ? 'selected' : '' ?>>
                        non dispo.
                    </option>
                </select>
            </div>

            <button class="btn book_form_btn">Valider</button>

        </form>
    </div>
</section>

<?php require 'views/partials/footer.php'; ?>