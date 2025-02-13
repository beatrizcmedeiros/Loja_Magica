<?php

require __DIR__ . '/ListClientOrderHistory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $order_id = $_POST['id'] ?? null;

    if ($order_id !== null) {
        $result = ClientOrderHistory::deleteClientOrderHistory($conn, $order_id);

        if ($result > 0) {
            echo json_encode(['success' => true, 'message' => 'Pedido excluido com sucesso']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir o pedido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID do cliente é obrigatório']);
    }
}
