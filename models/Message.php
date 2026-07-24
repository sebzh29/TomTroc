<?php

class Message
{
    private $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance()->getPDO();
    }

    public function create(int $senderId, int $receiverId, string $content): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO messages (sender_id, receiver_id, content, created_at)
            VALUES (?, ?, ?, NOW())
        ");

        return $stmt->execute([$senderId, $receiverId, $content]);
    }

    public function getConversation(int $userId, int $otherUserId): array
{
    $stmt = $this->db->prepare("
        SELECT 
            messages.*,
            sender.username AS sender_username,
            sender.avatar AS sender_avatar,
            receiver.username AS receiver_username,
            receiver.avatar AS receiver_avatar
        FROM messages
        JOIN users AS sender ON sender.id = messages.sender_id
        JOIN users AS receiver ON receiver.id = messages.receiver_id
        WHERE 
            (messages.sender_id = ? AND messages.receiver_id = ?)
            OR
            (messages.sender_id = ? AND messages.receiver_id = ?)
        ORDER BY messages.created_at ASC
    ");

    $stmt->execute([
        $userId,
        $otherUserId,
        $otherUserId,
        $userId
    ]);

    return $stmt->fetchAll();
}

public function getConversations(int $userId): array
{
    $stmt = $this->db->prepare("
        SELECT 
            u.id AS user_id,
            u.username,
            u.avatar,
            last_msg.content AS last_message,
            last_msg.created_at AS last_message_date
        FROM (
            SELECT 
                m.*,
                CASE 
                    WHEN m.sender_id = :user_id_1 THEN m.receiver_id
                    ELSE m.sender_id
                END AS other_user_id
            FROM messages m
            INNER JOIN (
                SELECT 
                    MAX(id) AS last_id
                FROM messages
                WHERE sender_id = :user_id_2 OR receiver_id = :user_id_3
                GROUP BY 
                    CASE 
                        WHEN sender_id = :user_id_4 THEN receiver_id
                        ELSE sender_id
                    END
            ) grouped_messages ON grouped_messages.last_id = m.id
        ) last_msg
        JOIN users u ON u.id = last_msg.other_user_id
        ORDER BY last_msg.created_at DESC
    ");

    $stmt->execute([
        'user_id_1' => $userId,
        'user_id_2' => $userId,
        'user_id_3' => $userId,
        'user_id_4' => $userId
    ]);

    return $stmt->fetchAll();
}
}