<?php
class Usuario extends abstrErroPropriedades
{
    private $usuario;
    private $senha;
    private $nome;
    private $email;

    public function ConsultarUsuario(string $usuario) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('usuarios', 'usuario', $usuario);

        if(!empty($consultarBd))
        {
            $this->usuario = $consultarBd[0]['usuario'];
            $this->senha = $consultarBd[0]['senha'];
            $this->nome = $consultarBd[0]['nome'];
            $this->email = $consultarBd[0]['email'];
            return true;
        }
        else
        {
            $this->mensagem = 'Usuário não encontrado.';
            return false;
        }
    }

    public function AlterarUsuario(string $usuario) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('usuarios', 'usuario', $usuario, 'nome', 'email', $this->nome, $this->email);

        if($alterarBd)
        {
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    public function AlterarSenha(string $usuario, string $novaSenha) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('usuarios', 'usuario', $usuario, 'senha', $novaSenha);

        if($alterarBd)
        {
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }
    
    public function ValidarUsuario(string $usuario, string $senha) : bool
    {
        try
        {
            $consultarUsuario = $this->ConsultarUsuario($usuario);
        
            if(!$consultarUsuario)
            {
                throw new Exception($this->mensagem);
            }
            
            if($this->senha !== $senha)
            {
                throw new Exception('Senha incorreta.');
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }
    
    public function ValidarNovaSenha(string $novaSenha, string $novaSenhaNovamente) : bool
    {
        if($novaSenha === $novaSenhaNovamente)
        {
            return true;
        }
        else
        {
            $this->mensagem = 'A Nova senha não foi confirmada corretamente.';
            return false;
        }
    }

    //Get
    function __get($name)
    {
        return $this->$name;
    }
    
    //Set
    function setUsuario(string $usuario)
    {
        $this->usuario = $usuario;
    }
    function setSenha(string $senha)
    {
        $this->senha = $senha;
    }
    function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    function setEmail(string $email)
    {
        $this->email = $email;
    }
}