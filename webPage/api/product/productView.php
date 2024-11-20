<?php

class ProductView
{
    public function render(array|string $message, int $status): void
    {
        $response = [
            'status' => $status,
            'response' => $message
        ];

        echo json_encode($response);
    }
}