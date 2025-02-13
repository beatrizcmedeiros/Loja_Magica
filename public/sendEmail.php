<?php

require_once __DIR__ . '/api/ListClientOrderHistory.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/assets/js/script.js"></script>
</head>
<body class="body-edit-order">
    <nav class="navbar">
        <a href="index.php">Home</a>
    </nav>
    <h2 class="edit-order-title">Emails</h2>
    <form action="" class="form-edit-order" enctype="multipart/form-data">
        <div class="container-input">
            <label for="email_subject">Assunto do email:</label>
            <input id="email_subject" type="text" placeholder="Insira o assunto do email">
        </div>
        <div class="container-input">
            <label for="email_body">Corpo do email:</label>
            <textarea id="email_body" placeholder="Insira o corpo do email" rows="4"></textarea>
        </div>

        <div class="container-buttons">
            <button class="send-button" type="submit">Enviar</button>
        </div>
    </form>


    <div id="email-popup" style="display: none;">
        <div class="popup-content">
            <h2>Selecione os e-mails</h2>
            <button id="select-all">Selecionar Todos</button>
            <ul id="email-list">
            </ul>
            <button id="cancel-selection">Cancelar</button>
            <button id="confirm-selection">Confirmar</button>
        </div>
    </div>

    <script>

        $(document).ready(function() {
            $('.send-button').on('click', function(e) {
                e.preventDefault(); 
                $('#email-popup').show();
                
                const emails = <?php echo json_encode(ClientOrderHistory::getAllClientEmails($conn)); ?>;

                const unique_emails = [...new Set(emails
                    .map(item => item.client_email) 
                    .filter(email => email.trim() !== "") 
                )];

                $('#email-list').empty();
                
                unique_emails.forEach(email => {
                    $('#email-list').append(`
                        <li>
                            <label>
                                <input type="checkbox" class="email-checkbox" value="${email}"> ${email}
                            </label>
                        </li>
                    `);
                });
            });
        });


        $('#select-all').on('click', function() {
            $('.email-checkbox').prop('checked', true);
        });

        $('#cancel-selection').on('click', function() {
            $('#email-popup').hide();
        });

        $('#confirm-selection').on('click', function() {
            const selected_emails = [];
            $('.email-checkbox:checked').each(function() {
                selected_emails.push($(this).val());
            });

            if (selected_emails.length === 0) {
                alert('Por favor, selecione pelo menos um email.');
                return;
            }

            const form_data = new FormData();
            form_data.append('email_subject', $('#email_subject').val());
            form_data.append('email_body', $('#email_body').val());


            form_data.append('emails', JSON.stringify(selected_emails));

            fetch('api/SendEmail.php', {
                method: 'POST',
                body: form_data
            })
            .then(response => {
                response.text()
                if(response.status === 200)
                    alert('Email enviado com sucesso!');
                else 
                    alert('Erro ao enviar o email.');
            })
            .catch(error => {
                alert('Erro ao enviar o email.');
            });
        });

    </script>
</body>
</html>