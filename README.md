# Desafio Técnico: A Missão da Loja Mágica

## Contexto
Esse foi um desafio proposto no processo seletivo da P21, que consistia na criação de um sistema capaz de gerenciar os pedidos de uma loja mágica.

O sistema deveria ser capaz de importar os dados dos pedidos de uma planilha, salvar no banco de dados e apresentar esses dados em tela. Também deveria possibilitar a edição e exclusão de pedidos. 

Também deveria ser implementado um sistema de envio de emails e disponibilizar uma integração para fornecedores terceiros integrarem com a plataforma enviando os pedidos via XML

## Resumo do projeto
O projeto possui uma página principal onde são listados todos os pedidos salvos no banco de dados. Os pedidos que foram carregados com algum erro (dados faltantes) são mostados com uma cor vermelha na tabela. 

Ao clicar sobre a linha do pedido é possível editar o mesmo, abrindo uma nova tela. 

Nessa tela, é feita uma nova busca no banco de dados pelo id do pedido para carregar os dados no formulário. Após o preenchimento é possível salvar as informações. Também é possível excluir um pedido nessa tela

Também existe um tela de envio de emails, onde é possível escrever um assunto e o corpo do email, após isso um modal se abre com os emails dos clientes salvos no banco. É possível selecionar um ou vários emails. 

Também existe uma tela que simula uma tela do fornecedor terceiro, fazendo a integração com a API disponibilizada pelo sistema que recebe um XML com os pedidos e salva no banco de dados.

## Considerações sobre o projeto
Para simplificar, não salvei os clientes e produtos em tabelas separadas, mas em um sistema real isso deveria ser feito para ter um controle melhor das informações.

Não foi feito um sistema de login ou autentticação tanto para acessar o sistema quanto para a integração com terceiros, mas em um sistema real isso também deveria ser feito.

## Tecologias utilizadas
- PHP
- HTML
- CSS
- Javascript
- JQuery

Para o envio de emails foi utilizado o PHPMailer e foi configurado um servidor SMTP utilizando o [MailSaur](https://mailosaur.com/app)

Para a construção da tabela de pedidos foi usado o [DataTables](https://datatables.net/)

## Instruções de instalação
1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/yourproject.git
    ```
2. Navigate to the project directory:
    ```bash
    cd yourproject
    ```
3. Install the dependencies:
    ```bash
    [command to install dependencies]
    ```

## Como rodar o projeto
1. Ligar o servidor apache e mySQL no painel do XAMPP

## Screenshots

Tela principal de listagem de pedidos
![image](https://github.com/user-attachments/assets/0b70d549-fe0d-40e0-99b7-f09f3458239f)
![image](https://github.com/user-attachments/assets/39b9a295-c116-411f-8ef5-5dafe843d50e)


Edição de pedido
![image](https://github.com/user-attachments/assets/f2270dc2-385a-4ae9-9119-937842638542)
![image](https://github.com/user-attachments/assets/c953177d-626a-4f42-8db6-2fc51d9e5e5d)

Integração de terceiros 
![image](https://github.com/user-attachments/assets/8ce54454-0725-4585-9bb1-26101462bef4)

Envio de emails
![image](https://github.com/user-attachments/assets/dc602084-7273-45e0-87c6-2cb94c09019c)
![image](https://github.com/user-attachments/assets/0342b8d6-b97b-4c81-b643-011d6482eee8)

Email enviado no MailSaur
![image](https://github.com/user-attachments/assets/b81c84de-e3d4-43b1-9ebc-ab6749ac10dc)

   
