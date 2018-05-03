<?php
class ContaControle
{
    function LoginGet()
    {
        $modelo = new apresContaLogin();
        $modelo->setTitulo('Login - Sistema consulta de sala');
        $modelo->setUrlJs('conta');

        return $modelo;
    }
    function LoginPost(object $modelo) : bool
    {
        $usuario = new Usuario();
        $consultarUsuario = $usuario->ConsultarUsuario($modelo->__get('usuario'));

        if($consultarUsuario)
        {
            if($usuario->__get('senha') == $modelo->__get('senha'))
            {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['usuario'] = $usuario->__get('usuario');

                return true;
            }
            else
                return false;
        }
        else
            return false;
    }

    function IndexGet($nome)
    {
        $usuario = new Usuario();
        $consultarUsuario = $usuario->ConsultarUsuario($nome);

        if($consultarUsuario)
        {
            $modelo = new apresContaIndex();
            $modelo->setTitulo('Conta - Sistema consulta de sala');
            $modelo->setUrlJs('conta');
            $modelo->setUsuario($usuario->__get('usuario'));
            $modelo->setSenha($usuario->__get('senha'));
            $modelo->setNome($usuario->__get('nome'));
            $modelo->setEmail($usuario->__get('email'));

            return $modelo;
        }
    }

    function IndexPost(object $modelo)
    {
        $usuario = new Usuario();

        if($modelo->__get('nome'))
        {
            $usuario->setNome($modelo->__get('nome'));
            $usuario->setEmail($modelo->__get('email'));

            $alterarUsuario = $usuario->AlterarUsuario($modelo->__get('usuario'));
        }
        else
        {
            $alterarSenha = $usuario->AlterarSenha($modelo->__get('usuario'), $modelo->__get('senha'), $modelo->__get('novaSenha'), $modelo->__get('novaSenhaNovamente'));
        }

        if(isset($alterarUsuario) && $alterarUsuario || isset($alterarSenha) && $alterarSenha)
            return true;
        else
            return false;
    }
}
?>