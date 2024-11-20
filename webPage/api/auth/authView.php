<?php

class LoginView
{
    public function render($message, int $status): void
    {
        $response = [
            'status' => $status,
            'response' => $message
        ];

        echo json_encode($response);
    }
}