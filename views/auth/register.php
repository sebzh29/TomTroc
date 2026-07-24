<?php require_once 'views/partials/header.php'; ?>

<div class="auth_layout">

    <!-- LEFT -->
    <div class="auth_left">
        <div class="auth_card">

            <h1 class="auth_title">Inscription</h1>

            <?php if (!empty($error)): ?>
                <p class="auth_error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="index.php?page=register" method="POST">
                <div class="form_group">
                    <label>Pseudo</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form_group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form_group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required>
                </div>

                <button class="btn auth_btn">S'inscrire</button>

                <p class="auth_link">
                    Déjà inscrit ?
                    <a href="index.php?page=login">Connectez-vous</a>
                </p>

            </form>

        </div>
    </div>

    <!-- RIGHT -->
    <div class="auth_right">
        <img src="<?= BASE_URL ?>assets/images/auth.png" alt="livres">
    </div>

</div>

<?php require_once 'views/partials/footer.php'; ?>