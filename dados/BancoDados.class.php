<?php
class BancoDados extends Conexao
{
    private $nome;
    protected $conexao;
    protected $sql;
    
    public function __construct()
    {
        parent::__construct();
        $this->nome = $this->bancoDados;
    }
    
    public function AdicionarBd() : bool
    {
        try
        {
            $this->sql = 'CREATE DATABASE IF NOT EXISTS '.$this->nome;
            
            if(!$this->conexao = $this->AbrirConexao())
            {
                throw new Exception('Erro no AbrirBd.');
            }
            
            if(!$this->conexao->query($this->sql))
            {
                throw new Exception('Erro no conexao->query.');
            }
            
            $this->FecharConexao($this->conexao);
            return true;
        }
        catch(Exception $e)
        {
            $this->mensagem = 'Não foi possível adicionar o BD.';
            return false;
        }
    }
    
    public function RemoverBd() : bool
    {
        try
        {
            $this->sql = 'DROP DATABASE '.$this->nome;
            
            if(!$this->conexao = $this->AbrirConexao())
            {
                throw new Exception('Erro no conexao->AbrirBd.');
            }
            
            if(!$this->conexao->query($this->sql))
            {
                throw new Exception('Erro no bd->query.');
            }
            
            $this->FecharConexao($this->conexao);
            return true;
        }
        catch(Exception $e)
        {
            $this->mensagem = 'Não foi possível remover o BD.';
            return false;
        }
    }
    
    public function AdicionarTabela(string $nome, array $colunas, $chavesPrimaria = null, $chavesEstrangeira = null)
    {
        try
        {
            $this->sql = 'CREATE TABLE `'.$nome.'` (';
            
            foreach($colunas as $coluna)
            {
                $this->sql .= '`'.$coluna['nome'].'` '.$coluna['tipo'].' '.$coluna['opcoes'].',';
            }
            
            $this->sql = substr($this->sql, 0, -1);
            $this->sql .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8;';
            
            if(!empty($chavesPrimaria))
            {
                if(is_array($chavesPrimaria))
                {
                    $this->sql .= ' ALTER TABLE '.$nome.' ADD CONSTRAINT PK_'.$nome.' PRIMARY KEY (';

                    foreach($chavesPrimaria as $chavePrimaria)
                    {
                        $this->sql .= $chavePrimaria.',';
                    }

                    $this->sql = substr($this->sql, 0, -1);
                    $this->sql .= ');';
                }
                else
                {
                    $this->sql .= ' ALTER TABLE '.$nome.' ADD PRIMARY KEY ('.$chavesPrimaria.');';
                }
            }
            
            if(!empty($chavesEstrangeira))
            {
                if(is_array($chavesEstrangeira))
                {
                    foreach($chavesEstrangeira as $chaveEstrangeira)
                    {
                        $referencia = explode('_', $chaveEstrangeira);                        
                        $this->sql .= ' ALTER TABLE '.$nome.' ADD CONSTRAINT FK_'.$referencia[0].$nome.' FOREIGN KEY ('.$chaveEstrangeira.') REFERENCES '.$referencia[0].'('.$referencia[1].');';
                    }
                }
                else
                {
                    $referencia = explode('_', $chavesEstrangeira);
                    $this->sql .= ' ALTER TABLE '.$nome.' ADD CONSTRAINT FK_'.$referencia[0].$nome.' FOREIGN KEY ('.$chavesEstrangeira.') REFERENCES '.$referencia[0].'('.$referencia[1].');';
                }
            }
            
            if(!$this->conexao = $this->AbrirBd())
            {
                throw new Exception('Erro no AbrirBd.');
            }
            
            if(!$this->conexao->multi_query($this->sql))
            {
                throw new Exception('Erro no conexao->multi_query.');
            }
            
            return true;
        }
        catch(Exception $e)
        {
            $this->mensagem = 'Não foi possível adicionar a tabela no BD.';
            return false;
        }
    }
    
    public function RestaurarBd()
    {
        try
        {
            $crud = new Crud();
            $this->RemoverBd();
            $this->AdicionarBd();

            $c_colunas = array();
            $c_colunas[] = array(
                'nome' => 'nome',
                'tipo' => 'varchar(45)',
                'opcoes' => 'NOT NULL'
            );
            $c_colunas[] = array(
                'nome' => 'areaAtuacao',
                'tipo' => 'varchar(10)',
                'opcoes' => 'NOT NULL'
            );
            $this->AdicionarTabela('cursos', $c_colunas, 'nome');

            $s_colunas = array();
            $s_colunas[] = array(
                'nome' => 'nome',
                'tipo' => 'varchar(10)',
                'opcoes' => 'NOT NULL'
            );
            $s_colunas[] = array(
                'nome' => 'predio',
                'tipo' => 'int(11)',
                'opcoes' => 'NOT NULL'
            );
            $s_colunas[] = array(
                'nome' => 'bloco',
                'tipo' => 'varchar(1)',
                'opcoes' => 'NOT NULL'
            );
            $s_colunas[] = array(
                'nome' => 'pavimento',
                'tipo' => 'int(11)',
                'opcoes' => 'NOT NULL'
            );
            $this->AdicionarTabela('salas', $s_colunas, 'nome');

            $t_colunas = array();
            $t_colunas[] = array(
                'nome' => 'cursos_nome',
                'tipo' => 'varchar(45)',
                'opcoes' => 'NOT NULL'
            );
            $t_colunas[] = array(
                'nome' => 'periodo',
                'tipo' => 'varchar(10)',
                'opcoes' => 'NOT NULL'
            );
            $t_colunas[] = array(
                'nome' => 'semestre',
                'tipo' => 'int(11)',
                'opcoes' => 'NOT NULL'
            );
            $t_colunas[] = array(
                'nome' => 'salas_nome',
                'tipo' => 'varchar(10)',
                'opcoes' => 'NOT NULL'
            );
            $this->AdicionarTabela('turmas', $t_colunas, array('cursos_nome', 'periodo', 'semestre'), array('cursos_nome', 'salas_nome'));

            $u_colunas = array();
            $u_colunas[] = array(
                'nome' => 'usuario',
                'tipo' => 'varchar(16)',
                'opcoes' => 'NOT NULL'
            );
            $u_colunas[] = array(
                'nome' => 'senha',
                'tipo' => 'varchar(16)',
                'opcoes' => 'NOT NULL'
            );
            $u_colunas[] = array(
                'nome' => 'nome',
                'tipo' => 'varchar(45)',
                'opcoes' => 'NOT NULL'
            );
            $u_colunas[] = array(
                'nome' => 'email',
                'tipo' => 'varchar(45)',
                'opcoes' => 'NOT NULL'
            );
            $this->AdicionarTabela('usuarios', $u_colunas, 'usuario');

            $crud->AdicionarBd('usuarios', 'usuario', 'senha', 'nome', 'email', 'admin', 'admin', 'Administrador', 'admin@unip.br');
            
            $abrirBd = $this->AbrirBd();
            
            if(empty($abrirBd))
            {
                throw new Exception('BD inacessível após restauração.');
            }
            
            return true;
        }
        catch(Exception $e) {
            $this->mensagem = 'Não foi possível restaurar o BD.';
            return false;
        }
    }


    public function ConsultarTabelas()
    {
        $tabelas = array();
        
        $sala = new Sala();
        $consultarSalas = $sala->ConsultarSalas();
        
        if($consultarSalas)
        {
            $tabelas['salas'] = $consultarSalas;
        }
        
        $curso = new Curso();
        $consultarCursos = $curso->ConsultarCursos();
        
        if($consultarCursos)
        {
            $tabelas['cursos'] = $consultarCursos;
        }
        
        $turma = new Turma();
        $consultarTurmas = $turma->ConsultarTurmas();
        
        if($consultarTurmas)
        {
            $tabelas['turmas'] = $consultarTurmas;
        }
        
        if($tabelas)
        {
            return $tabelas;
        }
        else
        {
            $this->mensagem = 'Não existem dados nas tabelas.';
            return null;
        }
    }
}