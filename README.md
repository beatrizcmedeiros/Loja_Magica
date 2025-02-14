# Desafio Técnico: A Missão da Loja Mágica

## Contexto
Esse foi um desafio proposto no processo seletivo da P21, que consistia na criação de um sistema capaz de gerenciar os pedidos de uma loja mágica.

O sistema deveria ser capaz de importar os dados dos pedidos de uma planilha excel, salvar no banco de dados e apresenta-los em uma tela, assim como possibilitar a edição e exclusão dos pedidos. 

Também foi solicitado a implementação de um sistema de envio de emails e uma integração para fornecedores terceiros integrarem com a plataforma enviando os pedidos via XML.

## Resumo do projeto
O projeto possui uma página principal onde o arquivo excel pode ser importado e as informações salvas no banco de dados são listadas. Os pedidos que foram carregados com algum erro (dados faltantes) são mostrados com uma cor vermelha na tabela. 

Ao clicar sobre a linha do pedido uma nova tela é aberta, nessa tela, é feita uma nova busca no banco de dados, pelo id do pedido para carregar os dados referentes a ele no formulário, possibilitando editar e salvar as alterações no banco ou excluir o pedido. 

Além disso, existe um tela de envio de emails, nela é possível escrever um assunto e o corpo do email, ao clicar em 'Enviar' um modal é aberto listando todos os emails de clientes existentes no banco dando a possíbilidade de escolher um ou mais remetentes. 

Existe também uma simulação de tela de um fornecedor terceiro, fazendo a integração com a API disponibilizada pelo sistema que recebe um XML com os pedidos e salva as informações no banco de dados.

## Considerações sobre o projeto
Para simplificar, não salvei os clientes e produtos em tabelas separadas e não fiz demasiadas validações, apenas algumas mais simples, mas em um sistema real isso deveria ser feito para ter um controle melhor das informações inseridas.

Não foi feito um sistema de login ou autentticação tanto para acessar o sistema quanto para a integração com terceiros, o que em um sistema real seria de extrema importancia, assim como a existencia de diferentes tipos de permissões, como de inserção de dados, exclusão ou edição das infomações.

Referente ao envio dos emails, optei por usar um servidor SMTP gratuito, porém apesar de validar a lógica implementada ele não chega a enviar efetivamente os emails, eles ficam 'presos' dentro do servidor. Para isso configurei uma conta genérica no google e utilizei ela no [Mailosaur](https://mailosaur.com/) e fiz os ajustes para gerar as informações necessarias e vinculei elas ao código no arquivo `public/api/SendEmail.php`.

## Tecologias utilizadas
- PHP
- HTML
- CSS
- Javascript
- JQuery

Para o envio de emails foi utilizado o PHPMailer e foi configurado um servidor SMTP utilizando o [MailSaur](https://mailosaur.com/app)

Para a construção da tabela de pedidos foi usado o [DataTables](https://datatables.net/)

## Como rodar o projeto
1. Caso ainda não tenha o XAMPP instalado é necessário faze-lo.
2. Ligar o servidor apache e mySQL no painel do XAMPP.
3. Baixar a biblioteca para leitura do arquivo excel.
    ```bash
    [composer require phpoffice/phpspreadsheet]
    ```
4. Caso gere algum erro será necessário ajustar o arquvivo 'php.ini' dentro da pasta 'xampp/php' tirando o ';' (comentário) das seguintes extensões:

    extension=gd

    extension=zip
5. Baixar a biblioteca referente ao PHPMailer
    ```bash
    [composer require phpmailer/phpmailer]
    ```
6. Importar o arquivo `loja_magica_db.sql` no seu gerenciador de banco, seja phpMyAdmin ou Dbeaver

## Screenshots

Tela principal de listagem de pedidos:
![image](https://github.com/user-attachments/assets/0b70d549-fe0d-40e0-99b7-f09f3458239f)
![image](https://github.com/user-attachments/assets/39b9a295-c116-411f-8ef5-5dafe843d50e)


Edição de pedido:
![image](https://github.com/user-attachments/assets/f2270dc2-385a-4ae9-9119-937842638542)
![image](https://github.com/user-attachments/assets/c953177d-626a-4f42-8db6-2fc51d9e5e5d)

Integração de terceiros:
![image](https://github.com/user-attachments/assets/8ce54454-0725-4585-9bb1-26101462bef4)

Envio de emails:
![image](https://github.com/user-attachments/assets/dc602084-7273-45e0-87c6-2cb94c09019c)
![image](https://github.com/user-attachments/assets/0342b8d6-b97b-4c81-b643-011d6482eee8)

Email enviado no MailSaur:
![image](https://github.com/user-attachments/assets/b81c84de-e3d4-43b1-9ebc-ab6749ac10dc)

   
