create database uberdatamanager;

use uberdatamanager;

CREATE TABLE perfil (
	idPerfil int primary key auto_increment,
    nome varchar(64) not null,
    cpf varchar(20) not null unique,
    rg varchar(20) not null unique,
    cnh varchar(30) unique,
	email varchar(128) not null unique,
    
    id_Veiculo int,
    foreign key(id_Veiculo)
    references veiculo(idVeiculo)
    
);

create table usuario (
	idUsuario int primary key auto_increment,
    username varchar(64) not null,
    userpass varchar(128) not null,
    tipo enum('ADMIN','CLIENTE','MOTORISTA'),
    
    id_Perfil int not null,
    foreign key(id_Perfil) references perfil(idPerfil)
    
);

create table telefone (
	idTelefone int primary key auto_increment,
    tipo enum('COM','RES','CEL'),
    numero varchar(10),
    
    id_Perfil int not null,
    foreign key(id_Perfil)
    references perfil(idPerfil)
    
);

create table endereco (
	idEndereco int primary key auto_increment,
    rua varchar(64),
    bairro varchar(64),
    cidade varchar(64),
    estado varchar(2),
    
    id_Perfil int not null,
    foreign key(id_Perfil)
    references perfil(idPerfil)
    
);

create table veiculo(
	idVeiculo int primary key auto_increment,
    modelo varchar(64) not null,
    placa varchar(10) not null unique,
    ano int not null,
    cor varchar(32) not null,
    km int not null
);

create table manutencao (
	idManutencao int primary key auto_increment,
    dataManutencao datetime not null,
    nome varchar(64) not null,
    detalhes varchar(256)    
);

alter table manutencao
add foreign key(id_Veiculo) references veiculo(idVeiculo);

create table servico (
	idServico int primary key auto_increment,
    nome varchar(64) not null,
    nota enum('A','B','C','D','E'),
    
    id_Manutencao int,
    foreign key(id_Manutencao) references manutencao(idManutencao)
    
);





