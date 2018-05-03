<?php
class Conexao
{
    private $host;
    private $usuario;
    private $senha;
    private $nome;
    public $status;

    function __construct()
    {
        $this->host = Bd_Host;
        $this->usuario = Bd_Usuario;
        $this->senha = Bd_Senha;
        $this->nome = Bd_Nome;
        $this->status = false;
    }

    //Abre conexão com o banco de dados
    function AbrirBd()
    {
        try
        {
            @$conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->nome);
            $conexao->set_charset('utf8');

            if(!$conexao->connect_error)
            {
                $this->status = true;
                $_SESSION['erro'] = '';
                return $conexao;
            }
            else
                throw new Exception('Erro ao instanciar mysqli.');
        }
        catch (Exception $e)
        {
            $_SESSION['erro'] = 'Não foi possivel abrir uma conexão com o banco de dados.';
            return null;
        }
    }

    //Fecha conexão com o banco de dados
    function FecharBd($conexao) : bool
    {
        try
        {
            $fechar = mysqli_close($conexao);

            if($fechar)
            {
                $this->status = false;
                $_SESSION['erro'] = '';
                return true;
            }
            else
                throw new Exception('Erro ao fechar a instância mysqli.');
        }
        catch (Exception $e)
        {
            $_SESSION['erro'] = 'Não foi possivel fechar a conexão com o banco de dados.';
            return false;
        }
    }

    //Get
    function __get($name)
    {
        return $this->$name;
    }
}
?>