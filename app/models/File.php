<?php

require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class File {
     /**
     * Lê um arquivo Excel enviado via $_FILES e retorna os dados como um array.
     *
     * @param array $file Arquivo inserido no input ($_FILES).
     * @return array|false Dados da planilha ou FALSE em caso de erro.
     */
    public function readFile(array $file): array|false {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $spread_sheet = IOFactory::load($file['tmp_name']);
        $sheet = $spread_sheet->getActiveSheet();
        $data = $sheet->toArray();

        $spread_sheet->disconnectWorksheets();
        unset($spread_sheet);

        return $data;
    }
}

?>