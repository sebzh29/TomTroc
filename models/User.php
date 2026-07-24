<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);

        return $result->fetch();
    }

    public function create(string $username, string $email, string $password)
    {
        $sql = "INSERT INTO users (username, email, password, created_at)
                VALUES (:username, :email, :password, NOW())";

        return $this->db->query($sql, [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        return $this->db->query($sql, ['id' => $id])->fetch();
    }

    public function update(int $id, string $username, string $email)
    {
        $sql = "UPDATE users 
                SET username = :username, email = :email 
                WHERE id = :id";

        return $this->db->query($sql, [
            'username' => $username,
            'email' => $email,
            'id' => $id
        ]);
    }

    public function updateAvatar(int $id, string $avatar): void
    {
        $stmt = $this->db->query("UPDATE users SET avatar = ? WHERE id = ?", [$avatar, $id]);
    }
}