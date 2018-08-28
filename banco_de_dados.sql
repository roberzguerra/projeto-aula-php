/* TABELA UF */
CREATE TABLE uf (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    sigla varchar(2) NOT NULL,
    PRIMARY KEY (id)
);

/* TABELA CIDADE */
CREATE TABLE cidade (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    uf_id int NOT NULL,
    PRIMARY KEY (id)
);

insert into uf (nome, sigla) values('Acre', 'AC');
insert into uf (nome, sigla) values('Alagoas', 'AL');
insert into uf (nome, sigla) values('Amapá', 'AP');
insert into uf (nome, sigla) values('Amazonas', 'AM');
insert into uf (nome, sigla) values('Bahia', 'BA');
insert into uf (nome, sigla) values('Ceará', 'CE');
insert into uf (nome, sigla) values('Distrito Federal', 'DF');
insert into uf (nome, sigla) values('Espírito Santo', 'ES');
insert into uf (nome, sigla) values('Goias', 'GO');
insert into uf (nome, sigla) values('Maranhão', 'MA');
insert into uf (nome, sigla) values('Mato Grosso', 'MT');
insert into uf (nome, sigla) values('Mato Grosso do Sul', 'MS');
insert into uf (nome, sigla) values('Minas Gerais', 'MG');
insert into uf (nome, sigla) values('Pará', 'PA');
insert into uf (nome, sigla) values('Paraíba', 'PB');
insert into uf (nome, sigla) values('Paraná', 'PR');
insert into uf (nome, sigla) values('Pernambuco', 'PE');
insert into uf (nome, sigla) values('Piauí', 'PI');
insert into uf (nome, sigla) values('Rio de Janeiro', 'RJ');
insert into uf (nome, sigla) values('Rio Grande do Norte', 'RN');
insert into uf (nome, sigla) values('Rio Grande do Sul', 'RS');
insert into uf (nome, sigla) values('Rondônia', 'RO');
insert into uf (nome, sigla) values('Roraima', 'RR');
insert into uf (nome, sigla) values('Santa Catarina', 'SC');
insert into uf (nome, sigla) values('São Paulo', 'SP');
insert into uf (nome, sigla) values('Sergipe', 'SE');
insert into uf (nome, sigla) values('Tocantins', 'TO');


/* Adiciona coluna uf_id como inteiro NAO NULLO na tabela cidade */
/* ALTER TABLE cidade ADD COLUMN uf_id int NOT NULL; */

/* Adiciona uma chave estrangeira (com o nome cidade_uf_id) 
referenciando a coluna uf_id da tabela cidade, 
com a coluna id da tabela UF.
 */
ALTER TABLE cidade ADD FOREIGN KEY cidade_uf_id (uf_id) 
    REFERENCES uf(id);

/* APAGAR CHAVE ESTRANGEIRA */
/* ALTER TABLE cidade DROP FOREIGN KEY cidade_uf_id; */

/* REMOVER COLUNAS */
/* ALTER TABLE cidade DROP COLUMN uf_id; */


INSERT INTO cidade (nome, uf_id)
values("Caxias do Sul", 21);



/*

CREATE TABLE cidade (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(2),
    uf_id int not null,
    PRIMARY KEY (id),
    FOREIGN KEY (uf_id) REFERENCES uf(id)
)


Criar a coluna cidade_id em pessoa para ser nossa chave estrangeira para a tabela cidade:
ALTER TABLE pessoa ADD COLUMN cidade_id int;
Criar a chave estrangeira:
ALTER TABLE pessoa ADD FOREIGN KEY (cidade_id) REFERENCES cidade(id);
*/



/* TABELA PESSOA */
CREATE TABLE pessoa (
  id int(11) NOT NULL AUTO_INCREMENT,
  primeiro_nome varchar(255) NOT NULL,
  segundo_nome varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  cpf varchar(11) NOT NULL,
  endereco varchar(255) NOT NULL,
  bairro varchar(255) NOT NULL,
  numero varchar(255) NOT NULL,
  cep varchar(9) NOT NULL,
  cidade_id int NOT NULL,
  data_nascimento timestamp NOT NULL, /* timestamp= '1990-12-30 00:00:00' */
  tipo int(1) NOT NULL, /* 1=Professor, 2=Aluno */
  data_criacao timestamp NOT NULL DEFAULT NOW(),
  data_alteracao timestamp NOT NULL DEFAULT NOW(),
  
  PRIMARY KEY (id),
  UNIQUE KEY (email),
  UNIQUE KEY (cpf),
  FOREIGN KEY pessoa_cidade_id (cidade_id) REFERENCES cidade(id)
);


/* Adiciona coluna SEXO na tabela pessoa com valor padrão 'M' */
ALTER TABLE pessoa ADD COLUMN sexo varchar(1) NOT NULL DEFAULT 'M';

/* TABELA usuario */
CREATE TABLE usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    nome varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    senha varchar(255) NOT NULL,
    recuperar_senha varchar(255) NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

/* CRIA O USUARIO rober como teste com a senha 1234 
 o hash: 81dc9bdb52d04dc20036dbd8313ed055 equivale a senha 1234.
*/
INSERT INTO usuario (nome, email, senha, recuperar_senha)
VALUES(
    'Rober', 
    'roberzguerra@gmail.com', 
    '81dc9bdb52d04dc20036dbd8313ed055', 
    null
);
