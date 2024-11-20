<?php

require 'productModel.php';
require 'productView.php';

class ProductController
{
    private ProductModel $model;
    private ProductView $view;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->view = new ProductView();
    }

    public function getAllProducts(): void
    {
        try {
            $products = $this->model->getProducts();

            if (is_string($products)) {
                throw new Exception($products);
            }

            if (empty($products)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $products, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    public function createProduct(mixed $product): void
    {
        try {
            $data = json_decode($product, true);
            $id_provider = $data['id_proveedor'];

            $is_error = $this->validateReqBody($data);

            if ($is_error) {
                throw new Exception($is_error->getMessage());
            }

            $product = $this->model->getProductById($id_provider);

            if (is_string($product)) {
                throw new Exception($product);
            }

            if (!empty($product)) {
                throw new Exception(ERRORS::_DUPLICATED_INFO_);
            }

            $response = $this->model->addProduct($data);

            $this->view->render(message: $response, status: 201);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    public function updateProduct(mixed $product): void
    {
        try {
            $data = json_decode($product, true);
            $id = $data['id'];

            if (empty($id)) {
                throw new Exception(ERRORS::_NO_INFO_);
            }

            if (!is_numeric($id)) {
                throw new Exception(ERRORS::_INVALID_INFO_);
            }

            $is_error = $this->validateReqBody($data);

            if ($is_error) {
                throw new Exception($is_error->getMessage());
            }

            $this->view->render(message: $product, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    private function validateReqBody(mixed $data) : ?Exception
    {
        $name = $data['nombre'];
        $description = $data['descripcion'];
        $price = $data['precio'];
        $stock = $data['stock'];
        $id_provider = $data['id_proveedor'];
        $id_category = $data['id_categoria'];

        if (empty($name) | empty($description) | empty($price) | empty($stock) | empty($id_provider) | empty($id_category)) {
            return new Exception(ERRORS::_NO_INFO_);
        }

        if (!is_numeric($price) | !is_numeric($stock) | !is_numeric($id_provider) | !is_numeric($id_category)) {
            return new Exception(ERRORS::_INVALID_INFO_);
        }

        if (count($data) > 6) {
            return new Exception(ERRORS::_EXTRA_INFO_);
        }

        return null;
    }

    public function deleteProduct(string $id): void
    {
        try {
            if (empty($id)) {
                throw new Exception(ERRORS::_NO_INFO_);
            }

            if (!is_numeric($id)) {
                throw new Exception(ERRORS::_INVALID_INFO_);
            }

            $response = $this->model->deleteProduct($id);

            $this->view->render(message: $response, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }
}