<?php
require 'rolController.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$authController = new RolController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $authController->getRol($_GET['id']);
        } else {
            $authController->getAllRoles();
        }
        break;
    default:
        echo json_encode(['message' => ERRORS::_METHOD_NOT_SUPPORTED_]);
        break;
}
