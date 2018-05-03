<?php
class Usuario
{
    private $usuario;
    private $senha;
    private $nome;
    private $email;

    function ConsultarUsuario($usuario) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('usuarios', 'usuario', $usuario);

        if($consultarBd)
        {
            $this->usuario = $consultarBd[0]['usuario'];
            $this->senha = $consultarBd[0]['senha'];
            $this->nome = $consultarBd[0]['nome'];
            $this->email = $consultarBd[0]['email'];

            return true;
        }
        else
            return false;
    }

    function AlterarUsuario($usuario) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('usuarios', 'usuario', $usuario, 'nome', 'email', $this->nome, $this->email);

        if($alterarBd)
            return true;
        else
            return false;
    }

    function AlterarSenha($usuario, $senha, $novaSenha, $novaSenhaNovamente) : bool
    {
        $consultarUsuario = $this->ConsultarUsuario($usuario);

        if($this->senha == $senha)
        {
            if($novaSenha == $novaSenhaNovamente)
            {
                $crud = new Crud();

                $alterarBd = $crud->AlterarBd('usuarios', 'usuario', $usuario, 'senha', $novaSenha);

                if($alterarBd)
                    return true;
                else
                    return false;
            }
            else
            {
                $_SESSION['erro'] = 'A nova senha não foi confirmada corretamente.';
                return false;
            }
        }
        else
        {
            $_SESSION['erro'] = 'A senha atual está incorreta.';
            return false;
        }
    }

    function setUsuario(string $param)
    {
        $this->usuario = $param;
    }
    function setSenha(string $param)
    {
        $this->senha = $param;
    }
    function setNome(string $param)
    {
        $this->nome = $param;
    }
    function setEmail(string $param)
    {
        $this->email = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>