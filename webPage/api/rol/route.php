<?php
require 'rolController.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$rolController = new RolController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $rolController->getAllRoles();
        break;
    default:
        echo json_encode(['message' => ERRORS::_METHOD_NOT_SUPPORTED_]);
        break;
}
