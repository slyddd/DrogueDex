<?php

require 'rolModel.php';
require 'rolView.php';

class RolController
{
    private RolModel $model;
    private RolView $view;

    public function __construct()
    {
        $this->model = new RolModel();
        $this->view = new RolView();
    }

    public function getAllRoles(): void
    {
        try {
            $roles = $this->model->getRoles();

            if (is_string($roles)) {
                throw new Exception($roles);
            }

            if (empty($roles)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $roles, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    public function getRol(string $id): void
    {
        try {
            $rol = $this->model->getRol($id);

            if (is_string($rol)) {
                throw new Exception($rol);
            }

            if (empty($rol)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            $this->view->render(message: $rol, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }
}