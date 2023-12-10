# Desafio técnico

Desenvolver uma Aplicação Web, utilizando PHP e uma estrutura básica em MVC (sem a utilização de
frameworks para o backend). A aplicação deve exibir uma listagem de registros de clientes, em formato de
“table”, onde cada um destes, poderão sofrer todas as operações básicas de CRUD.

O layout da aplicação deverá ser responsivo / adaptativo e utilizar o Boostrap para tal. Caso utilize AJAX nas
operações de CRUD, poderá ser utilizado bibliotecas como jQuery e afins.


# Requisitos

1. PHP >= 5;
2. MySQL >= 5.6;
3. Bootstrap >= 3.3;
4. Git / Github.

## Instalação

Clone do repositório:

       git clone https://github.com/Arthur-Souza-Armond/avaliacao-desenvolvedor-grupo-confianca.git
 
 Para o perfeito funcionamento do sistema a pasta do repositório deve ficar dentro da pasta htdocs de modo que possa ser acessada utilizando:
 

> http://localhost/grupo-confianca/

Instalar as dependências do composer e também o autoload do sistema

    composer install

Deve ser criado um banco de dados MySQL para ser utilizado pela aplicação e suas credenciais devem ser fornecidas para o sistema através do arquivo `.env`

    DB_HOST=localhost
    DB_USER=root
    DB_PASS=
    DB_NAME=grupo-confianca

O arquivo `.env` deve ser armazenado no root do diretório para funcionar corretamente.

Migrations - Para configurar o banco de dados deve ser executado o arquivo de `.migrations.php` que fará a configuração das tabelas do banco. O arquivo `.migrations.php` está localizado no root do diretório e deve ser acessado utilizando o comando:

    php migrations.php


## Utilização

Após seguir o passo a passo da instação, o programa já estará disponível para ser acessado e executar suas funcionalidades.

Para acessar o sistema, basta ligar o servidor apache e o servidor MySQL, e então entrar na url da pasta instalada.

