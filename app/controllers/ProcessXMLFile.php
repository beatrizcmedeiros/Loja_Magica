<?php

require_once __DIR__ . '/../models/StoreOrder.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido. Use POST.']);
    die();
}

if (isset($_FILES['xml']) && $_FILES['xml']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['xml']['tmp_name'];
    $xml = simplexml_load_file($file);

    if (!$xml) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Erro ao carregar o XML']);
        die();
    }

    $response = [];

    foreach ($xml->pedido as $content) {
        $id_loja = (string) $content->id_loja;
        $nome_loja = (string) $content->nome_loja;
        $localizacao = (string) $content->localizacao;
        $produto = (string) $content->produto;
        $quantidade = (int) $content->quantidade;

        $new_store_order = new StoreOrder($id_loja, $nome_loja, $localizacao, $produto, $quantidade);

        if (!$new_store_order->createStoreOrder()){
            echo json_encode(['success' => false, 'message' => "Erro ao importar os dados da loja: $nome_loja"]);
            die();
        }
    }
    echo json_encode(['success' => true, 'message' => 'XML importado com sucesso.']);
    die();
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Nenhum arquivo XML encontrado.']);
    die();
}
