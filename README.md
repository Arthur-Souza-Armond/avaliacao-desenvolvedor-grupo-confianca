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

## Funcionamento

O projeto foi construído utilizando arquitetura MVC, em que possui classes responsáveis por controlar a execução desses módulos que são:

- ControllerCore - Responsável por criar as funcionalidades do container e usar o Twig
- MigrationsCore - Responsável por criar as tabelas do banco de dados quando chamado
- ModelCore - Responsável por criar as funções de modelos para serem usadas nos controladores
- RouterCore - Responsável por criar as funcionalidades das rotas que são chamadas no index.php para gerenciar o sistema

Além disso, foi utilizado o Twig para construir a parte do front-end para reaproveitar código e tornar o desenvolvimento mais ágil.

.htaccess - Existem 2 arquivos .htaccess no projeto que são responsáveis por "proteger" as rotas e redirecionar acessos para o controlador de rotas. Dessa forma, protegendo o acesso malicioso

Pasta config - Essa pasta contém dois arquivos `config.php` e `Router.php`, o arquivo config guarda algumas informações importantes para execução do sistema e constantes globais. Já o arquivo de Router é responsável por definir as rotas que serão usadas pelo core.

