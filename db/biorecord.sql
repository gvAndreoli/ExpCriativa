create database biorecord;
use biorecord;

create table tipo_usuario(
	id_tipo int primary key auto_increment,
    descricao varchar(50)
);

ALTER TABLE tipo_usuario MODIFY descricao VARCHAR(50) NOT NULL;

insert into tipo_usuario values (1, 'Administrador');
insert into tipo_usuario values (2, 'Especialista');
insert into tipo_usuario values (3, 'Usuário comum');

CREATE TABLE usuario (
  id_usuario int primary key NOT NULL auto_increment,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(40) NOT NULL,
  lattes varchar(200) NOT NULL,
  tipo_usuario int,
  foreign key(tipo_usuario) references tipo_usuario(id_tipo)
);
ALTER TABLE usuario MODIFY lattes varchar(200);

select * from usuario;
insert into usuario values (1, "user", "user@gmail.com", "123", null, 1);

create table estado_conservacao(
	id_estado int primary key not null auto_increment,
    descricao varchar(100)
);

ALTER TABLE estado_conservacao MODIFY descricao VARCHAR(100) NOT NULL;

insert into estado_conservacao values (1, "Não ameaçado");

create table publicacao(
	id_publicacao int primary key auto_increment,
    id_autor int,
    estado_conservacao int,
    is_global boolean,
    nivel_trofico varchar(100),
    nome_especie varchar(100),
    nome_cientifico varchar(100),
    image mediumblob,
    foreign key (id_autor) references usuario(id_usuario),
    foreign key (estado_conservacao) references estado_conservacao(id_estado)
);

alter table publicacao drop column is_global;
alter table publicacao drop column image;
ALTER TABLE publicacao ADD COLUMN url_imagem VARCHAR(255);
ALTER TABLE publicacao MODIFY url_imagem VARCHAR(100) NOT NULL;
ALTER TABLE publicacao MODIFY nivel_trofico VARCHAR(100) NOT NULL;
ALTER TABLE publicacao MODIFY nome_especie VARCHAR(100) NOT NULL;
ALTER TABLE publicacao MODIFY nome_cientifico VARCHAR(100) NOT NULL;

select * from publicacao;
insert into publicacao values(1, 1, 1, "Herbívoro", "Capivara", "Hydrochoerus hydrochaeris", "./imgs/capivara.jpg");
select * from publicacao;
select * from usuario;
insert into usuario values (15, "root", "root@admin.com", "root_admin", null, 1); 