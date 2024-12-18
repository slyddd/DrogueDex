<?php
require __DIR__ . '/../bin/db.php';

class AuthModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new DB())->connect();
    }


    public function getUser(string $email): array|string
    {
        $query = 'SELECT usuarios.nombre, apellido, correo, contraseña, rol.nombre AS rol
                    FROM usuarios
                    JOIN rol
                    ON usuarios.id_rol = rol.id
                    WHERE correo = "' . $email . '"';

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

    public function addUser(array $data): array
    {
        $query = "INSERT INTO usuarios (nombre, apellido, correo, contraseña, id_rol) VALUES (:nombre, :apellido, :correo, :password, :id_rol)";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':correo', $data['correo']);
            $stmt->bindParam(':password', $data['contraseña']);
            $stmt->bindParam(':id_rol', $data['id_rol']);
            $stmt->execute();

            return ['ok' => true, 'response' => RESPONSES::_SUCCESS_];
        } catch (PDOException $e) {
            return ['ok' => false, 'response' => $e->getMessage()];
        }
    }
}