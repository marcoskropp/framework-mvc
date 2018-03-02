create database framework;
use framework;

create table estoque(
	id int not null primary key auto_increment,
    produto varchar(100),
    quantidade double,
    valor double
);

create table animal(
	id int not null primary key auto_increment,
	tipo int,
    especie varchar(100),
    nome varchar(100)
);