<?php
require __DIR__ . '/../bin/db.php';

class LoginModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new DB())->connect();
    }


    public function getUser(string $email): bool|array
    {
        $query = 'SELECT * FROM usuarios WHERE correo = "' . $email.'"';

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['Error: ' . $e->getMessage()];
        }
    }

    public function addUser(array $data): string
    {
        $query = "INSERT INTO usuarios (nombre, apellido, correo, contraseña, id_rol) VALUES (:nombre, :apellido, :correo, :contraseña, :id_rol)";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':contraseña', $data['contraseña']);
            $stmt->bindParam(':id_rol', $data['id_rol']);
            $stmt->execute();

            return "Usuario agregado";
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}