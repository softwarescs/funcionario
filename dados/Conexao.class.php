<?php
class Conexao extends abstrErroPropriedades
{
    private $host;
    private $usuario;
    private $senha;
    protected $bancoDados;

    public function __construct()
    {
        $config = new Configuracoes();
        $this->host = $config->getBdHost();
        $this->usuario = $config->getBdUsuario();
        $this->senha = $config->getBdSenha();
        $this->bancoDados = $config->getBdNome();
    }

    public function AbrirConexao()
    {
        try
        {
            @$conexao = new mysqli($this->host, $this->usuario, $this->senha);
            $conexao->set_charset('utf8');

            if($conexao->connect_error)
            {
                throw new Exception('Erro ao instanciar mysqli.');
            }
            
            return $conexao;
        }
        catch (Exception $e)
        {
            $this->mensagem = 'Não foi possível abrir uma conexão.';
            return null;
        }
    }
    
    //Abre conexão com o banco de dados
    public function AbrirBd()
    {
        try
        {
            if(!$conexao = $this->AbrirConexao())
            {
                throw new Exception('Não foi possivel abrir uma conexão.');
            }
            
            if(!$conexao->select_db($this->bancoDados))
            {
                throw new Exception('Erro ao selecionar o banco de dados.');
            }
            
            return $conexao;
        }
        catch (Exception $e)
        {
            $this->mensagem = 'Não foi possível abrir uma conexão com o banco de dados.';
            return null;
        }
    }

    //Fecha conexão com o banco de dados
    public function FecharConexao($conexao) : bool
    {
        try
        {
            if(!mysqli_close($conexao))
            {
                throw new Exception('Erro ao fechar a instância mysqli.');
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = 'Não foi possível fechar a conexão.';
            return false;
        }
    }
}