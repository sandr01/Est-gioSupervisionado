create database sgie;

use sgie;

create table setor (
	setor_id int primary key,
    nome_setor varchar(255) not null,
    responsavel_setor varchar(255) not null,
    prioridade_id int not null
);

create table profissional (
	profissional_id int primary key,
    nome_profissional varchar(255) not null,
    profissional_tipo_usuario varchar(255) not null,
    profissional_cargo varchar(255),
    profissional_setor_id int not null,
    profissional_tel varchar(255),
    profissional_email varchar(255),
    profissional_data_nasc date,
    profissional_cpf varchar(11),
    foreign key (profissional_setor_id) references setor(setor_id)
);

create table equipamento (
	equipamento_id int primary key,
    nome_equipamento varchar(255) not null,
    tipo_equipamento varchar(255),
    caracteristicas_equip varchar(255),
    status_equip varchar(255),
    nome_profissional_recebidor varchar(255),
    id_profissional_recebidor int,
    data_saida date,
    foreign key (id_profissional_recebidor) references profissional(profissional_id)
);

create table aluguel (
	aluguel_id int primary key,
    data_aluguel date not null,
    data_devolucao date,
    nome_equipamento varchar(255),
	alu_equipamento_id int,
    alu_profissional_id int,
    nome_profissional_solicitante varchar(255),
    nome_setor varchar(255),
    setor_profissional_id int,
    foreign key (alu_equipamento_id) references equipamento(equipamento_id),
    foreign key (alu_profissional_id) references profissional(profissional_id),
    foreign key (setor_profissional_id) references setor(setor_id)
);

