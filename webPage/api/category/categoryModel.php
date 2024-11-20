<?php
require __DIR__ . '/../bin/db.php';

class CategoryModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new DB())->connect();
    }


    public function getCategory(string $id): array|string
    {
        $query = 'SELECT * FROM categoria WHERE id = ' . $id;

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

    public function getCategories(): array|string
    {
        $query = 'SELECT * FROM categoria';

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