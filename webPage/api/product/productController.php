<?php

require 'productModel.php';
require 'providerView.php';

class ProviderController
{
    private ProductModel $model;
    private ProviderView $view;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->view = new ProviderView();
    }

    public function getAllProviders(): void
    {
        try {
            $providers = $this->model->getProviders();

            if (is_string($providers)) {
                throw new Exception($providers);
            }

            if (empty($providers)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $providers, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }
}