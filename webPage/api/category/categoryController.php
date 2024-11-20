<?php

require 'categoryModel.php';
require 'categoryView.php';

class CategoryController
{
    private CategoryModel $model;
    private CategoryView $view;

    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
    }

    public function getAllCategories(): void
    {
        try {
            $categories = $this->model->getCategories();

            if (is_string($categories)) {
                throw new Exception($categories);
            }

            if (empty($categories)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $categories, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    public function getCategory(string $id): void
    {
        try {
            $category = $this->model->getCategory($id);

            if (is_string($category)) {
                throw new Exception($category);
            }

            if (empty($category)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $category, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }
}