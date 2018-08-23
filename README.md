# projeto-aula-php
Projeto da aula de PHP na Flexxo.


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



