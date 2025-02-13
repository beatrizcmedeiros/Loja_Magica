<?php

require_once __DIR__ . '/api/ListClientOrderHistory.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Mágica de Tecnologia</title>
</head>
<body>
    <nav class="navbar">
        <div class="container-links">
            <a href="SendEmail.php">Enviar emails</a>
            <span>|</span>
            <a href="importXML.php">Importar XML (Lojas Parceiras)</a>
        </div>
    </nav>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="../public/assets/js/script.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <form id="upload_file_form" enctype="multipart/form-data">
        <label for="file_input" class="custom-file-upload">
            Selecionar arquivo
        </label>
        <input type="file" id="file_input" name="file" class="input-file"/>
        <strong id="file_name"></strong>
        <button type="button" onclick="importFile()" class="import-button">Importar</button>
    </form>

    <br><br>
    <table id="info_clients" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
          <tr>
                <th style="font-size: 15px;">ID Cliente</th>
                <th style="font-size: 15px;">Nome</th>
                <th style="font-size: 15px;">Email</th>
                <th style="font-size: 15px;">Histórico de Pedidos</th>
                <th style="font-size: 15px;">Data do Último Pedido</th>
                <th style="font-size: 15px;">Valor do Último Pedido</th>
          </tr>
      </thead>
      <tbody>
       
      </tbody>
    </table>

    <script>
        var tabela;

        $(document).ready(function() {
            const client_data = <?php echo json_encode(ClientOrderHistory::getAllClientOrderHistory($conn)); ?>;

            client = client_data.map(item => {
                if (item.last_order_date) {
                    const date = item.last_order_date.split('-');
                    if (date.length === 3) {
                        item.last_order_date = `${date[2]}/${date[1]}/${date[0]}`; 
                    }
                }

                if (item.last_order_date == '00/00/0000') 
                    item.last_order_date = '';

                return item;
            });

            tabela = $('#info_clients').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json",
                    "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sSearch": "Busca:",
                    "zeroRecords": "Nenhum registro encontrado",
                    "infoEmpty": "Sem registros",
                    "processing": "Carregando...",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                },
                "order": [[0, "asc"]],
                "scrollY": "400px",
                "scrollX": true,
                "processing": true,
                "serverSide": false,
                "data": client_data,  
                "columns": [
                    { "data": "client_id" },
                    { "data": "client_name" },
                    { "data": "client_email" },
                    { "data": "description" },
                    { "data": "last_order_date" },
                    { "data": "last_order_value" },
                ],
                "createdRow": function(row, data, dataIndex) {
                    for (const key in data) {
                        if (data[key] === null || data[key] === '') {
                            $(row).addClass('row-with-error');
                            break;
                        }
                    }
                }
            });
        });

        $('#info_clients tbody').on('click', 'tr', function() {
            var data = tabela.row(this).data();

            if (data && data.id) 
                window.location.href = `editOrder.php?id=${data.id}`;
        });

        document.getElementById('file_input').addEventListener('change', function(event) {
            const fileName = event.target.files.length > 0 ? event.target.files[0].name : "Nenhum arquivo selecionado";
            document.getElementById('file_name').textContent = fileName;
        });
    </script>

</body>
</html>