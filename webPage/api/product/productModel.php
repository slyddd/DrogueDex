<?php
require __DIR__ . '/../bin/db.php';

class ProductModel
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new DB())->connect();
    }

    public function getProducts(): array|string
    {
        $query = "SELECT
                    productos.nombre, productos.descripcion, precio, stock, proveedor.nombre as proveedor, categoria.nombre as categoria
                    FROM `productos`
                    JOIN proveedor
                    ON proveedor.id = productos.id_proveedor
                    JOIN  categoria
                    ON categoria.id = productos.id_categoria
                    WHERE productos.estado = 'activo'";

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

    public function getProductById(int $id): array|string
    {
        $query = "SELECT
                    productos.nombre, productos.descripcion, precio, stock, proveedor.nombre as proveedor, categoria.nombre as categoria
                    FROM `productos`
                    JOIN proveedor
                    ON proveedor.id = productos.id_proveedor
                    JOIN  categoria
                    ON categoria.id = productos.id_categoria
                    WHERE productos.estado = 'activo' AND productos.id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
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

    private function queryAddUpdateProduct(array $product, string $query): string
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $product['nombre']);
            $stmt->bindParam(':descripcion', $product['descripcion']);
            $stmt->bindParam(':precio', $product['precio']);
            $stmt->bindParam(':stock', $product['stock']);
            $stmt->bindParam(':id_proveedor', $product['id_proveedor']);
            $stmt->bindParam(':id_categoria', $product['id_categoria']);
            $stmt->execute();

            return RESPONSES::_SUCCESS_;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function addProduct(array $product): string
    {
        $query = 'INSERT INTO productos (nombre, descripcion, precio, stock, id_proveedor, id_categoria) VALUES (:nombre, :descripcion, :precio, :stock, :id_proveedor, :id_categoria)';

        return $this->queryAddUpdateProduct($product, $query);
    }

    public function updateProduct(array $product): string
    {
        $query = 'UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock, id_proveedor = :id_proveedor, id_categoria = :id_categoria WHERE id = :id';

        return $this->queryAddUpdateProduct($product, $query);
    }

    public function deleteProduct(int $id): string
    {
        $query = "UPDATE productos SET estado = 'inactivo' WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return RESPONSES::_SUCCESS_;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}