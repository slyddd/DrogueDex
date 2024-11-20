<?php

require 'authModel.php';
require 'authView.php';

class LoginController
{
    private LoginModel $model;
    private LoginView $view;

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }

    public function login(mixed $body): void
    {
        try {
            $data = json_decode($body, true);
            $email = $data['email'];
            $password = $data['password'];

            if (empty($email) | empty($password)) {
                throw new Exception('No needed info');
            }

            $user = $this->model->getUser($email);

            if (empty($user)) {
                throw new Exception('User not found');
            }

            $pass = $user[0]['contraseña'];
            $newPass = $password;

            if ($pass != $newPass) {
                throw new Exception('Invalid password');
            }

            $this->view->render(message: md5(json_encode($user)), status: 200);
        } catch (Exception $e) {
            $this->view->render(message: 'Error: ' . $e->getMessage(), status: 500);
        }
    }

    public function register(mixed $body): void
    {
        try {
            $data = json_decode($body, true);
            $name = $data['name'];
            $lastName = $data['lastName'];
            $email = $data['email'];
            $password = $data['password'];
            $role = $data['role'];

            if (empty($name) | empty($lastName) | empty($email) | empty($password) | empty($role)) {
                throw new Exception('No needed info');
            }

            $user = $this->model->getUser($email);

            if (!empty($user)) {
                throw new Exception('User already exists');
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $data['password'] = $password;

            $response = $this->model->addUser($data);
            $this->view->render(message: $response, status: 200);
        } catch (Exception $e) {
            $this->view->render(message: 'Error: ' . $e->getMessage(), status: 500);
        }
    }
}