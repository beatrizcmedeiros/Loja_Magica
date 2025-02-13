<?php

require __DIR__ . '/ListClientOrderHistory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $order_id = $_POST['id'] ?? null;
    $client_id = $_POST['client_id'] ?? null;
    $client_name = $_POST['client_name'] ?? null;
    $client_email = $_POST['client_email'] ?? null;
    $description = $_POST['description'] ?? null;
    $last_order_date = $_POST['last_order_date'] ?? null;
    $last_order_value = $_POST['last_order_value'] ?? null;

    if ($order_id !== null) {
        $result = ClientOrderHistory::updateClientOrderHistory(
            $conn,
            $order_id,
            $client_id,
            $client_name,
            $client_email,
            $description,
            $last_order_date,
            $last_order_value
        );

        if ($result > 0) {
            echo json_encode(['success' => true, 'message' => 'Pedido atualizado com sucesso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o pedido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID do cliente é obrigatório']);
    }
}
