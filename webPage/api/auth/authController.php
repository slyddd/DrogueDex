<?php

require 'authModel.php';
require 'authView.php';

class AuthController
{
    private AuthModel $model;
    private AuthView $view;

    public function __construct()
    {
        $this->model = new AuthModel();
        $this->view = new AuthView();
    }

    public function login(mixed $body): void
    {
        try {
            $data = json_decode($body, true);
            $email = $data['email'];
            $password = $data['password'];

            if (empty($email) | empty($password)) {
                throw new Exception(ERRORS::_NO_INFO_);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception(ERRORS::_INVALID_EMAIL_);
            }

            $user = $this->model->getUser($email);

            if (is_string($user)) {
                throw new Exception($user);
            }

            if (empty($user)) {
                throw new Exception(ERRORS::_INFO_NOT_FOUND_);
            }

            if (!password_verify($password, $user[0]['contraseña'])) {
                throw new Exception(ERRORS::_WRONG_PASSWORD_);
            }

            setcookie('user', json_encode($user[0]), time() + (86400 * 30), "/");
            setcookie('session_id', session_id(), time() + (86400 * 30), "/");

            $this->view->render(message: RESPONSES::_SUCCESS_, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }

    public function register(mixed $body): void
    {
        try {
            $data = json_decode($body, true);
            $name = $data['nombre'];
            $lastName = $data['apellido'];
            $email = $data['correo'];
            $password = $data['contraseña'];
            $role = $data['id_rol'];

            if (empty($name) | empty($lastName) | empty($email) | empty($password) | empty($role)) {
                throw new Exception(ERRORS::_NO_INFO_);
            }

            if (!is_numeric($role)) {
                throw new Exception(ERRORS::_INVALID_INFO_);
            }

            if (count($data) > 5) {
                throw new Exception(ERRORS::_NO_INFO_);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception(ERRORS::_INVALID_EMAIL_);
            }

            if (strlen($password) < 8) {
                throw new Exception(ERRORS::_SHORT_PASSWORD_);
            }

            $user = $this->model->getUser($email);

            if (is_string($user)) {
                throw new Exception($user);
            }

            if (!empty($user)) {
                throw new Exception(ERRORS::_DUPLICATED_INFO_);
            }

            $data['contraseña'] = password_hash($password, PASSWORD_DEFAULT);

            $response = $this->model->addUser($data);

            if (!$response['ok']) {
                throw new Exception($response['response']);
            }

            $this->view->render(message: $response['response'], status: 200);
        } catch (Exception $e) {
            $this->view->render(message: RESPONSES::_ERROR_ . $e->getMessage(), status: 500);
        }
    }
}