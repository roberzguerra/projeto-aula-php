# projeto-aula-php
Projeto da aula de PHP na Flexxo.

## Tema bootstrap utilizado
https://startbootstrap.com/template-overviews/sb-admin/



## Criar o modulo-pessoa
* Primeiro: apague a tabela pessoa caso exista:
```SQL
DROP TABLE pessoa
```
* Quando não especificado o tamanho da coluna em string, utilizar o padrão 255.
* Crie uma nova tabela chamda "pessoa" com as seguintes colunas:

  * id - chave primaira, com autoincremento;
  * primeiro_nome - string para armazenar o primeiro nome da pessoa;
  * segundo_nome - string para armazenar os demais nomes da pessoa;
  * email - string;
  * endereco - string;
  * Bairro - string;
  * numero - string;
  * cep - string;
  * cidade_id - chave estrangeira para a tabela cidade;
  * data_nascimento - (tipo timestam);
  * tipo - valor int (1 para professor, 2 para aluno);
  * data_criacao - (tipo timestamp) armazenar a data e hora no momento em que o registro for criado (data e hora atual como valor padrão);
  * data_alteracao - (tipo timestamp) armazenar a data e hora SEMPRE que o registro for alterado (data e hora atual como valor padrão);


* após criar a tabela, inicie o CRUD do módulo modulo-pessoa, que deve conter:
  * listagem de todas as pessoas;
  * cadastro;
  * edição;
  * deletar;


# Como executar o projeto em outro PC (Windows)?
* Instalar VS Code
* Instalar GIT
* Instalar Xampp
* abrir o terminal do git no vs code e navegar para o htdocs:
    cd /c/xampp/htdocs
* Executar o git clone para baixar seu repositorio no git hub
    git clone https://url-do-seu-repositorio
* o git clone irá criar automaticamente a pasta do seu projeto.
* Abra o VS code na pasta do seu projeto.
* Atualize o httpd.conf do Apache adicionando as configurações do
    nosso projeto aula.com
* Atualize o hosts do windows adicionando a linha aula.com 
    127.0.0.1 aula.com
* Criar Banco de dados aula_php_db
* Criar usuario do banco aula_php_user
* Executar o SQL do banco de dados para criar todas as tabelas.

* Extensões para o VS Code:
  * Code Spell Checker
  * Git History
  * HTML CSS Support
  * MySQL
  * MySQL Syntax
  &nbsp;

# Utilizando o composer no windows:
* Instalando o composer:
```bash
$ /c/xampp/php/php.exe -r "copy('https://getcomposer.org/installer
', 'composer-setup.php');"

$ /c/xampp/php/php.exe -r "copy('https://getcomposer.org/installer', 'composer-setu
p.php');"

$ /c/xampp/php/php.exe -r "if (hash_file('SHA384', 'composer-setup.php') === '544e0
9ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9
b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('
composer-setup.php'); } echo PHP_EOL;"

$ /c/xampp/php/php.exe -r "unlink('composer-setup.php');"
```
* Após a instalação será criado o arquivo composer.phar;
* Agora execute o init e tecle ENTER para todas as opções solicitadas:
```bash
$ /c/xampp/php/php.exe composer.phar init
```

* Execute o composer install, para criar a pasta vendor do projeto:
```bash
$ /c/xampp/php/php.exe composer.phar install
```

* Será criado um arquivo chamado composer.json, dentro deste arquivo, em "require" adicione suas bibliotecas/pacotes desejados, como no exemplo abaixo:
```json
    "require": {
        "phpmailer/phpmailer": "~6.0"
    }
```
* Após adicionar os pacotes desejados, execute o composer update:
```bash
$ /c/xampp/php/php.exe composer.phar update
```
* Caso ocorra qualquer problema com os pacotes, você sempre pode remover completamente a pasta "vendor" e o arquivo "composer.lock" e executar novamente o composer update para baixar todos os pacotes do projeto.





