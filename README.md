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



