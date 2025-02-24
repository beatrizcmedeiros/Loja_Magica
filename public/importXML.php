<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar XML</title>
    <link rel="stylesheet" href="../public/assets/css/style.css"> 
</head>
<body class="body-import-xml">
    <script src="../public/assets/js/script.js"></script>
    <nav class="navbar">
        <a href="index.php">Home</a>
    </nav>
    <h2 id="h2-import-xml">Simulação de Interface de Lojas Parceiras</h2>

    <br><br>

    <form id="upload_xml_form" enctype="multipart/form-data">
        <label for="xml_input" class="custom-xml-upload">
            Selecionar arquivo
        </label>
        <input type="file" id="xml_input" name="xml" class="input-xml" accept=".xml"/>
        <strong id="xml_name"></strong> 
        <button type="button" onclick="importXML()" class="import-button">Importar</button>
    </form>
    <script>
        document.getElementById('xml_input').addEventListener('change', function(event) {
            const fileName = event.target.files.length > 0 ? event.target.files[0].name : "Nenhum arquivo selecionado";
            document.getElementById('xml_name').textContent = fileName;
        });
    </script>
</body>
</html>
