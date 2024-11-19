<?php
require '../bin/db.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$conn = (new DB())->connect();

// Def crud functions
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getAllData($conn);
        break;
    default:
        echo json_encode(['message' => 'Metodo no soportado']);
        break;
}

// Get all
function getAllData($conn)
{
    try {
        $stmt = $conn->prepare('SHOW TABLES');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
