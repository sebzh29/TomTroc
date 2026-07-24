<?php require_once 'views/partials/header.php'; ?>

<div class="auth_layout">

    <!-- LEFT -->
    <div class="auth_left">
        <div class="auth_card">

            <h1 class="auth_title">Connexion</h1>

            <?php if (!empty($error)): ?>
                <p class="auth_error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="index.php?page=login" method="POST">

                <div class="form_group">
                    <label>Adresse email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form_group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required>
                </div>

                <button class="btn auth_btn">Se connecter</button>

                <p class="auth_link">
                    Pas de compte ?
                    <a href="index.php?page=register">Inscrivez-vous</a>
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