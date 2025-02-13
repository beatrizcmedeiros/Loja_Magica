<?php

require_once __DIR__ . '/../models/File.php';
require_once __DIR__ . '/../models/ClientOrderHistory.php';

$json  = array();
$count_lines_with_blank_fields = 0;

function hasBlankFields ($content){
    return ($content[0] == '' || $content[1] == '' || $content[2] == '' || $content[3] == '' || $content[4] == '' || $content[5] == '') ? TRUE : FALSE;
}

if (isset($_FILES['file'])) {
    
    $file = $_FILES['file'];
    
    $new_file = new File();

    $file_contents = array();
    $file_contents = $new_file->readFile($file);

    foreach($file_contents as $content){
        if($content[1] == 'Nome')
            continue;

        if(!is_numeric($content[5]))
            $content[5] = '';
        
        $new_client_order_history = new ClientOrderHistory($content[0], $content[1], $content[2], $content[3], $content[4], $content[5]);

        if($new_client_order_history->createClientOrderHistory()){
            if(hasBlankFields($content))
                $count_lines_with_blank_fields++;
        }else{
            echo json_encode(['success' => false, 'error_location' => 'line', 'message' => "Erro ao inserir a seguinte linha: {$content[0]} | {$content[1]} | {$content[2]} | {$content[3]} | {$content[4]} | {$content[5]}"]);
            die();
        }
    }
} else {
    echo json_encode(['success' => false, 'error_location' => 'file', 'message' => 'Nenhum arquivo foi importado.']);
    die();
}

echo json_encode(['success' => true, 'error_location' => '', 'message' => "Quantidade de linhas com campo em branco: {$count_lines_with_blank_fields}"]);
die();

?>
