<?php

class CategoryView
{
    public function render(array|string $message, int $status): void
    {
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                unset($message[$key]['id']);
                unset($message[$key]['fecha_creacion']);
                unset($message[$key]['estado']);
            }
        }

        $response = [
            'status' => $status,
            'response' => $message
        ];

        echo json_encode($response);
    }
}