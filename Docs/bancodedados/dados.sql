insert into setor (setor_id, nome_setor, responsavel_setor, prioridade_id) VALUES
(1, 'Tecnologia da Informação', 'Sussuarana', 1),
(2, 'Recursos Humanos', 'Igor gayrdiny', 2),
(3, 'Administrativo', 'Alessandro', 3);


insert into profissional (profissional_id, nome_profissional, profissional_tipo_usuario, profissional_cargo, profissional_setor_id, profissional_tel, profissional_email, profissional_data_nasc, profissional_cpf) VALUES
(1, 'Alessandro', 'Admin', 'Gerente de TI', 1, '11987654321', 'alessandro@ufac.com', '1985-05-15', '12345678901'),
(2, 'Igor Rocha', 'Usuário', 'Analista de RH', 2, '11987654322', 'rocha@ufac.com', '1990-03-22', '23456789012'),
(3, 'Lucas Sussugarana', 'Admin', 'Diretor Financeiro', 3, '11987654323', 'lucas@ufac.com', '1978-11-30', '34567890123');

insert into equipamento (equipamento_id, nome_equipamento, tipo_equipamento, caracteristicas_equip, status_equip, nome_profissional_recebidor, id_profissional_recebidor, data_saida) VALUES
(1, 'Notebook Dell', 'Laptop', '16GB RAM, 512GB SSD', 'Disponível', 'Alessandro', 1, '2024-08-01'),
(2, 'Impressora HP', 'Periférico', 'Multifuncional', 'Em Uso', 'Igor Rocha', 2, '2024-08-05'),
(3, 'Projetor Epson', 'Áudio e Vídeo', 'Full HD', 'Disponível', 'Lucas Sussugarana', 3, '2024-08-10');

insert into aluguel (aluguel_id, data_aluguel, data_devolucao, nome_equipamento, alu_equipamento_id, alu_profissional_id, nome_profissional_solicitante, nome_setor, setor_profissional_id) VALUES
(1, '2024-08-15', '2024-08-20', 'Notebook Dell', 1, 2, 'Igor gardiny', 'Recursos Humanos', 2),
(2, '2024-08-18', '2024-08-21', 'Projetor Epson', 3, 1, 'Sussuarana', 'Tecnologia da Informação', 1),
(3, '2024-08-19', '2024-08-25', 'Impressora HP', 2, 3, 'Alessandro', 'Administrativo', 3);

