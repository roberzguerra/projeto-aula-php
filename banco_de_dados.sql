
/* TABELA PESSOA */

CREATE TABLE pessoa (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  sexo varchar(1) DEFAULT NULL,
  data_nascimento timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  uf varchar(255) DEFAULT NULL,
  cidade varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

/* TABELA UF */
CREATE TABLE uf (
    id int NOT NULL AUTO_INCREMENT,
    sigla varchar(2),
    nome varchar(255),
    PRIMARY KEY (id)
);

/* TABELA CIDADE */
CREATE TABLE cidade (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(2),
    uf_id int,
    PRIMARY KEY (id)
);

insert into uf (nome, sigla) values('Acre', 'AC'),
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








/*

CREATE TABLE cidade (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(2),
    uf_id int,
    PRIMARY KEY (id),
    
    FOREIGN KEY (uf_id) REFERENCES uf(id)
)


Criar a coluna cidade_id em pessoa para ser nossa chave estrangeira para a tabela cidade:
ALTER TABLE pessoa ADD COLUMN cidade_id int;
Criar a chave estrangeira:
ALTER TABLE pessoa ADD FOREIGN KEY (cidade_id) REFERENCES cidade(id);
*/

