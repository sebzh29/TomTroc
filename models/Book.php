<?php

class Book
{
    private $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance()->getPDO();
    }

    /**
     * Récupérer tous les livres d'un utilisateur
     */
    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM books 
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");
        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    /**
     * Récupérer les livres disponibles d'un utilisateur
     */
    public function findAvailableByUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM books
            WHERE user_id = ?
            AND status = 'available'
            ORDER BY created_at DESC
        ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    /**
     * Récupérer un livre par son ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT 
                books.*,
                users.username AS owner_username,
                users.avatar AS owner_avatar
            FROM books
            JOIN users ON users.id = books.user_id
            WHERE books.id = ?
        ");

        $stmt->execute([$id]);

        $book = $stmt->fetch();

        return $book ?: null;
    }

    /**
     * Créer un livre
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO books (title, author, description, image, status, user_id, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");

        return $stmt->execute([
            $data['title'],
            $data['author'],
            $data['description'],
            $data['image'] ?? null,
            $data['status'],
            $data['user_id']
        ]);
    }

    /**
     * Modifier un livre
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE books 
            SET title = ?, author = ?, description = ?, image = ?, status = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['title'],
            $data['author'],
            $data['description'],
            $data['image'] ?? null,
            $data['status'],
            $id
        ]);
    }

    /**
     * Supprimer un livre
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("
            DELETE FROM books 
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }

    /**
     * Récupérer tous les livres disponibles
     */
    public function findAvailable(?string $search = null): array
    {
        if ($search) {
            $stmt = $this->db->prepare("
                SELECT books.*, users.username
                FROM books
                JOIN users ON users.id = books.user_id
                WHERE books.status = 'available'
                AND books.title LIKE ?
                ORDER BY books.created_at DESC
            ");
            $stmt->execute(['%' . $search . '%']);
        } else {
            $stmt = $this->db->prepare("
                SELECT books.*, users.username
                FROM books
                JOIN users ON users.id = books.user_id
                WHERE books.status = 'available'
                ORDER BY books.created_at DESC
            ");
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }

    /*
        * Récupérer les derniers livres disponibles
    */
    public function findLatest(int $limit = 4): array
{
    $stmt = $this->db->prepare("
        SELECT books.*, users.username
        FROM books
        JOIN users ON users.id = books.user_id
        WHERE books.status = 'available'
        ORDER BY books.created_at DESC
        LIMIT ?
    ");

    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}
    
}