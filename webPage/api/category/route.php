<?php
require 'categoryController.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$categoryController = new CategoryController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $categoryController->getCategory($_GET['id']);
        } else {
            $categoryController->getAllCategories();
        }
        break;
    default:
        echo json_encode(['message' => ERRORS::_METHOD_NOT_SUPPORTED_]);
        break;
}
