INSERT INTO `salas` (`nome`, `predio`, `bloco`, `pavimento`) VALUES
('A21', 3, 'A', 2),
('a61', 3, 'A', 3),
('a67', 3, 'A', 2),
('b11', 2, 'B', 1),
('b21', 2, 'B', 1);

INSERT INTO `cursos` (`nome`, `areaAtuacao`) VALUES
('Análise e Desenvolvimento de Sistemas', 'Exatas'),
('Gestão da Qualidade', 'Humanas'),
('Odontologia', 'Biológicas');

INSERT INTO `turmas` (`cursos_nome`, `salas_nome`, `periodo`, `semestre`) VALUES
('Gestão da Qualidade', 'A21', 'Noite', 2),
('Odontologia', 'A21', 'Manhã', 1),
('Análise e Desenvolvimento de Sistemas', 'b11', 'Manhã', 2);

