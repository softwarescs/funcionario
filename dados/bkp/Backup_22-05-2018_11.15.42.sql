INSERT INTO `salas` (`nome`, `predio`, `bloco`, `pavimento`) VALUES
('A21', 3, 'A', 2),
('a61', 3, 'A', 3),
('a67', 3, 'A', 2),
('b11', 2, 'B', 1),
('b21', 2, 'B', 1);

INSERT INTO `cursos` (`nome`, `areaAtuacao`) VALUES
('Análise e Desenvolvimento de Sistemas', 'Exatas'),
('Biologia', 'Biológicas'),
('Enfermagem', 'Biológicas'),
('Fisioterapia', 'Biológicas'),
('Gestão da Qualidade', 'Humanas'),
('Nutrição', 'Biológicas'),
('Odontologia', 'Biológicas'),
('zootecnia', 'Biológicas');

INSERT INTO `turmas` (`cursos_nome`, `salas_nome`, `periodo`, `semestre`) VALUES
('Gestão da Qualidade', 'A21', 'Noite', 2),
('Odontologia', 'A21', 'Manhã', 1),
('Biologia', 'a67', 'Manhã', 1),
('Análise e Desenvolvimento de Sistemas', 'b11', 'Manhã', 2);

