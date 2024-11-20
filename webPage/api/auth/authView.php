<?php

class AuthView
{
    public function render(array|string $message, int $status): void
    {
        if (is_array($message)) {
            $message['contraseña'] = null;
            $message['id'] = null;
            $message['id_rol'] = null;
        }

        $response = [
            'status' => $status,
            'response' => $message
        ];

        echo json_encode($response);
    }
}