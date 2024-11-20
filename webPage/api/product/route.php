<?php
require 'productController.php';

header('Access-Control-Allow-Origin: *');
header('access-Control-Allow-Methods: POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$productController = new ProductController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $productController->getAllProducts();
        break;
    case 'POST':
        $productController->createProduct(file_get_contents('php://input'));
        break;
    case 'PUT':
        $productController->updateProduct(file_get_contents('php://input'));
        break;
    case 'DELETE':
        $productController->deleteProduct($_GET['id']);
        break;
    default:
        echo json_encode(['message' => ERRORS::_METHOD_NOT_SUPPORTED_]);
        break;
}
