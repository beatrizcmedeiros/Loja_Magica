<?php
require_once __DIR__ . '/../models/ClientOrderHistory.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $conn = $database->connect();

    $client_data = ClientOrderHistory::getAllClientOrderHistory($conn);

    if (!empty($client_data)) {
        foreach ($client_data as &$item) {
            if (!empty($item['last_order_date'])) {
                $date_parts = explode('-', $item['last_order_date']);
                if (count($date_parts) === 3) 
                    $item['last_order_date'] = "{$date_parts[2]}/{$date_parts[1]}/{$date_parts[0]}";
            }
            if ($item['last_order_date'] == '00/00/0000') 
                $item['last_order_date'] = '';

            if (empty($item['last_order_value']) || $item['last_order_value'] == 0 || $item['last_order_value'] < 0)
                $item['last_order_value'] = "";
              
        }
        echo json_encode(["data" => $client_data], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["data" => []]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Erro ao buscar os dados: " . $e->getMessage()]);
}
?>
