<?php require 'views/partials/header.php'; ?>

<section class="account page">

<div class="container">
        <h1 class="account_title">Mon compte</h1>

    <div class="account_top">

        <!-- LEFT CARD -->
        <div class="account_card profile_card">

            <div class="profile_avatar">
                <img src="<?= !empty($user['avatar']) 
                    ? BASE_URL . 'assets/images/avatar/' . $user['avatar'] 
                    : BASE_URL . 'assets/images/default.png' ?>">
                <a href="#" class="profile_edit">modifier</a>
                <form action="<?= BASE_URL ?>index.php?page=edit-account" method="POST" enctype="multipart/form-data">
                    <input type="file" name="avatar">
                    <button type="submit">Modifier</button>
                </form>
            </div>

            <hr>

            <h2 class="profile_name">
                <?= htmlspecialchars($user['username']) ?>
            </h2>

            <p class="profile_sub">
                Membre depuis 1 an
            </p>

            <p class="profile_books">
                📚 <?= !empty($books) ? count($books) : 0 ?> livres
            </p>

        </div>

        <!-- RIGHT CARD -->
        <div class="account_card">

            <h3 class="account_subtitle">Vos informations personnelles</h3>

            <form method="POST" action="<?= BASE_URL ?>index.php?page=edit-account">

                <div class="form_group">
                    <label>Adresse email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                </div>

                <div class="form_group">
                    <label>Mot de passe</label>
                    <input type="password" value="********" disabled>
                </div>

                <div class="form_group">
                    <label>Pseudo</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                </div>

                <button class="btn_outline">Enregistrer</button>

            </form>

        </div>

    </div>

    <div class="account_books_header">
        <h2>Bibliothèque</h2>

        <a href="<?= BASE_URL ?>index.php?page=book-create" class="btn">
            Ajouter un livre
        </a>
    </div>

    <!-- TABLE BOOKS -->
    <div class="account_books">

        <table>

            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td>
                                <img
                                    src="<?= !empty($book['image'])
                                        ? BASE_URL . 'assets/images/books/' . htmlspecialchars($book['image'])
                                        : BASE_URL . 'assets/images/default-book.png' ?>"
                                    class="book_img"
                                    alt="<?= htmlspecialchars($book['title']) ?>"
                                >
                            </td>

                            <td><?= htmlspecialchars($book['title']) ?></td>

                            <td><?= htmlspecialchars($book['author']) ?></td>

                            <td>
                                <?= nl2br(htmlspecialchars(mb_strimwidth($book['description'], 0, 150, '...'))) ?>
                            </td>

                            <td>
                                <span class="badge <?= htmlspecialchars($book['status']) ?>">
                                    <?= $book['status'] === 'available' ? 'disponible' : 'non dispo.' ?>
                                </span>
                            </td>

                            <td>
                                <a href="<?= BASE_URL ?>index.php?page=book-edit&id=<?= $book['id'] ?>">Éditer</a>
                                <a href="<?= BASE_URL ?>index.php?page=book-delete&id=<?= $book['id'] ?>" class="danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Vous n’avez pas encore ajouté de livre.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
</div>

</section>

<?php require 'views/partials/footer.php'; ?>