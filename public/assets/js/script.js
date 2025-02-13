document.addEventListener("DOMContentLoaded", function () {
    const file_input = document.getElementById("file_input");

    if (file_input) {
        file_input.addEventListener("change", onSelectFile);
    }
});

function importFile() {
    const form_data = new FormData();
    const file_input = document.getElementById('file_input');
    if (file_input.files.length > 0) {
        form_data.append('file', file_input.files[0]);
        
        fetch('../app/controllers/ProcessExcelFile.php', {
            method: 'POST',
            body: form_data
        })
        .then(response => response.text())
        .then(data => {
            const response = JSON.parse(data)

            if(response.success)
                alert('Arquivo importado com sucesso! \n' + response.message);
            else
                alert(response.message);
        })
        .catch(error => {
            alert('Erro ao importar o arquivo!');
        });
    } else {
        alert('Por favor, selecione um arquivo.');
    }
}

function importXML() {
    const form_data = new FormData();
    const xml_input = document.getElementById('xml_input');
    if (xml_input.files.length > 0) {
        form_data.append('xml', xml_input.files[0]);

        fetch('../app/controllers/ProcessXMLFile.php', {
            method: 'POST',
            body: form_data
        })
        .then(response => response.text())
        .then(data => {
            const response = JSON.parse(data)

            if(response.success)
                alert(response.message);
            else
                alert(response.message);
        })
        .catch(error => {
            alert('Erro ao importar o XML!');
        });
    } else {
        alert('Por favor, selecione um XML.');
    }
}



function onSelectFile(){
    // console.log('PASSOU')
    // const fileInput = document.getElementById('fileInput');
    // console.log('PASSOU 2', fileInput)
    // if (fileInput.files.length > 0) {
    //     const fileName = document.getElementById('file-name')
    //     fileName.textContent = fileInput.files[0].name;
    // } 
}


