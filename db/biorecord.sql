create database biorecord;
use biorecord;

create table tipo_usuario(
	id_tipo int primary key auto_increment,
    descricao varchar(50)
);

CREATE TABLE usuario (
  id_usuario int primary key NOT NULL auto_increment,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(40) NOT NULL,
  lattes varchar(200) NOT NULL,
  tipo_usuario int,
  foreign key(tipo_usuario) references tipo_usuario(id_tipo)
);

select * from usuario;

create table estado_conservacao(
	id_estado int primary key not null auto_increment,
    descricao varchar(100)
);

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

insert into tipo_usuario values (1, 'Administrador');
insert into tipo_usuario values (2, 'Especialista');
insert into tipo_usuario values (3, 'Usuário comum');