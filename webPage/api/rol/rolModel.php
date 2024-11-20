<?php
require __DIR__ . '/../bin/db.php';

class RolModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new DB())->connect();
    }


    public function getRol(string $id): array|string
    {
        $query = 'SELECT * FROM rol WHERE id = ' . $id;

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($data === false) {
                throw new PDOException(ERRORS::_GENERIC_);
            }

            return $data;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getRoles(): array|string
    {
        $query = 'SELECT * FROM rol';

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($data === false) {
                throw new PDOException(ERRORS::_GENERIC_);
            }

            return $data;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}