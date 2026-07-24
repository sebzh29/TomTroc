<?php require 'views/partials/header.php'; ?>

<section class="messages_page">

    <div class="messages_layout">

        <aside class="messages_sidebar">

            <h1>Messagerie</h1>

            <?php if (!empty($conversations)): ?>
                <?php foreach ($conversations as $conversation): ?>
                    <a
                        href="<?= BASE_URL ?>index.php?page=messages&to=<?= $conversation['user_id'] ?>"
                        class="conversation_item <?= !empty($selectedUser) && (int)$selectedUser['id'] === (int)$conversation['user_id'] ? 'active_conversation' : '' ?>"
                    >
                        <img
                            src="<?= !empty($conversation['avatar'])
                                ? BASE_URL . 'assets/images/avatar/' . htmlspecialchars($conversation['avatar'])
                                : BASE_URL . 'assets/images/default-avatar.png' ?>"
                            alt="<?= htmlspecialchars($conversation['username']) ?>"
                        >

                        <div class="conversation_content">
                            <div class="conversation_top">
                                <strong><?= htmlspecialchars($conversation['username']) ?></strong>
                                <span><?= !empty($conversation['last_message_date']) ? date('d.m', strtotime($conversation['last_message_date'])) : '' ?></span>
                            </div>

                            <p><?= htmlspecialchars(mb_strimwidth($conversation['last_message'] ?? '', 0, 45, '...')) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="messages_empty">Aucune conversation.</p>
            <?php endif; ?>

        </aside>

        <section class="messages_thread">

            <?php if (!empty($selectedUser)): ?>

                <div class="thread_header">
                    <img
                        src="<?= !empty($selectedUser['avatar'])
                            ? BASE_URL . 'assets/images/avatar/' . htmlspecialchars($selectedUser['avatar'])
                            : BASE_URL . 'assets/images/default-avatar.png' ?>"
                        alt="<?= htmlspecialchars($selectedUser['username']) ?>"
                    >
                    <h2><?= htmlspecialchars($selectedUser['username']) ?></h2>
                </div>

                <div class="thread_messages">

                    <?php foreach ($messages as $message): ?>
    <?php $isMine = (int)$message['sender_id'] === (int)$_SESSION['user']['id']; ?>

    <div class="message_line <?= $isMine ? 'message_line_sent' : 'message_line_received' ?>">

        <img
            src="<?= !empty($message['sender_avatar'])
                ? BASE_URL . 'assets/images/avatar/' . htmlspecialchars($message['sender_avatar'])
                : BASE_URL . 'assets/images/default-avatar.png' ?>"
            alt="<?= htmlspecialchars($message['sender_username']) ?>"
        >

        <div>
            <span class="message_date">
                <?= date('d.m H:i', strtotime($message['created_at'])) ?>
            </span>

            <p class="message_bubble <?= $isMine ? 'message_sent' : 'message_received' ?>">
                <?= nl2br(htmlspecialchars($message['content'])) ?>
            </p>
        </div>

    </div>
<?php endforeach; ?>

                </div>
                <!--check qui est connecté et qui est le destinataire pour debug
                 <pre>
                    Connecté : <?= $_SESSION['user']['id'] . ' - ' . $_SESSION['user']['username'] ?>

                    SelectedUser : <?= $selectedUser['id'] . ' - ' . $selectedUser['username'] ?>
                </pre> -->

                <form method="POST" action="<?= BASE_URL ?>index.php?page=message-send" class="message_form">
                    <input type="hidden" name="receiver_id" value="<?= $selectedUser['id'] ?>">

                    <textarea name="content" placeholder="Tapez votre message ici" required></textarea>

                    <button class="btn" type="submit">Envoyer</button>
                </form>

            <?php else: ?>

                <div class="thread_placeholder">
                    <p>Sélectionnez une conversation.</p>
                </div>

            <?php endif; ?>

        </section>

    </div>

</section>

<?php require 'views/partials/footer.php'; ?>