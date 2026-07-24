<?php require 'views/partials/header.php'; ?>

<section class="book_form_page">
    <div class="container book_form_container">

        <a href="<?= BASE_URL ?>index.php?page=account" class="back_link">← retour</a>

        <h1>Ajouter un livre</h1>

        <form method="POST" enctype="multipart/form-data" class="book_form">

            <div class="form_group">
                <label>Photo</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form_group">
                <label>Titre</label>
                <input type="text" name="title" required>
            </div>

            <div class="form_group">
                <label>Auteur</label>
                <input type="text" name="author" required>
            </div>

            <div class="form_group">
                <label>Commentaire</label>
                <textarea name="description" required></textarea>
            </div>

            <div class="form_group">
                <label>Disponibilité</label>
                <select name="status" required>
                    <option value="available">disponible</option>
                    <option value="unavailable">non dispo.</option>
                </select>
            </div>

            <button class="btn book_form_btn">Valider</button>

        </form>
    </div>
</section>

<?php require 'views/partials/footer.php'; ?>