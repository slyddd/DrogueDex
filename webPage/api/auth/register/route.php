<?php
require __DIR__ . '/../authController.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$loginController = new LoginController();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $loginController->login(file_get_contents('php://input'));
        break;
    default:
        echo json_encode(['message' => 'Metodo no soportado']);
        break;
}
