<?php

require_once __DIR__ . '/api/ListClientOrderHistory.php';

$order_id = isset($_GET['id']) ? $_GET['id'] : null;

$order_data = [];
if ($order_id !== null) 
    $order_data = ClientOrderHistory::getSpecificClientOrderHistory($conn, $order_id);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/assets/js/script.js"></script>
</head>
<body class="body-edit-order">
    <nav class="navbar">
        <a href="index.php">Home</a>
    </nav>
    <h2 class="edit-order-title">Edição do pedido</h2>
    <form action="" class="form-edit-order" enctype="multipart/form-data">
        <div class="container-input">
            <label for="client_id">ID do cliente:</label>
            <input id="client_id" type="text" placeholder="Insira o ID do cliente">
        </div>
        <div class="container-input">
            <label for="client_name">Nome do cliente:</label>
            <input id="client_name" type="text" placeholder="Insira o nome do cliente">
        </div>
        <div class="container-input">
            <label for="client_email">Email do cliente:</label>
            <input id="client_email" type="text" placeholder="Insira o email do cliente">
        </div>
        <div class="container-input">
            <label for="history">Histórico do pedido:</label>
            <input id="history" type="text" placeholder="Insira o histórico do pedido">
        </div>
        <div class="container-input">
            <label for="last_order_date">Data do último pedido:</label>
            <input id="last_order_date" type="text" placeholder="Insira a data do último pedido">
        </div>
        <div class="container-input">
            <label for="last_order_value">Valor do último pedido:</label>
            <input id="last_order_value" type="text" placeholder="Insira o valor do último pedido">
        </div>
        <div class="container-buttons">
            <button class="delete-button" type="button">Excluir</button>
            <button class="save-button" type="submit">Salvar</button>
        </div>
    </form>

    <script>
        var tabela;

        $(document).ready(function() {
            const order_data = <?php echo json_encode($order_data); ?>;

            if (order_data) {
                $('#client_id').val(order_data.client_id);
                $('#client_name').val(order_data.client_name);
                $('#client_email').val(order_data.client_email);
                $('#history').val(order_data.description);
                $('#last_order_date').val(formatDateToDDMMYYYY(order_data.last_order_date));
                $('#last_order_value').val(order_data.last_order_value);
            }


            $('.save-button').on('click', function(e) {
                e.preventDefault(); 
                const url_params = new URLSearchParams(window.location.search);
                const order_id = url_params.get('id');

                const form_data = new FormData();

                form_data.append('id', order_id);
                form_data.append('client_id', $('#client_id').val());
                form_data.append('client_name', $('#client_name').val());
                form_data.append('client_email', $('#client_email').val());
                form_data.append('description', $('#history').val());
                appendFormattedDate(form_data, 'last_order_date', $('#last_order_date').val());
                form_data.append('last_order_value', $('#last_order_value').val());

                fetch('api/UpdateOrder.php', {
                    method: 'POST',
                    body: form_data
                })
                .then(response => response.text())
                .then(data => {
                    const response = JSON.parse(data)

                    if (response.success) 
                        alert('Pedido atualizado com sucesso!');
                    else
                        alert('Erro ao atualizar o pedido.');
                })
                .catch(error => {
                    alert('Erro ao atualizar o pedido.');
                });
            });

            $('.delete-button').on('click', function(e) {
                e.preventDefault(); 
                const url_params = new URLSearchParams(window.location.search);
                const order_id = url_params.get('id');

                const form_data = new FormData();
                form_data.append('id', order_id);

                fetch('api/DeleteOrder.php', {
                    method: 'POST',
                    body: form_data
                })
                .then(response => response.text())
                .then(data => {
                    const response = JSON.parse(data)

                    if(response.success){
                        alert('Pedido excluido com sucesso!');
                        window.location.href = "index.php";
                    }else
                        alert('Erro ao excluir o pedido.');
                })
                .catch(error => {
                    alert('Erro ao excluir o pedido.');
                });
            });
        });
    </script>
</body>
</html>