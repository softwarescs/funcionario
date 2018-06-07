<?php
class ContaControle extends abstrErroPropriedades
{
    function LoginGet()
    {
        $modelo = new apresContaLogin();
        $modelo->titulo = 'Login - Sistema consulta de sala';
        $modelo->urlJs = 'conta';

        return $modelo;
    }
    
    public function LoginPost($modelo) : bool
    {
        $usuario = new Usuario();

        $validarUsuario = $usuario->ValidarUsuario($modelo->usuario, $modelo->senha);

        if($validarUsuario)
        {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['usuario'] = $modelo->usuario;
            return true;
        }
        else
        {
            $this->mensagem = $usuario->getMensagem();
            return false;
        }
    }

    public function IndexGet(string $nome)
    {
        $usuario = new Usuario();
        $modelo = new apresContaIndex();
        
        $consultarUsuario = $usuario->ConsultarUsuario($nome);

        $modelo->titulo = 'Conta - Sistema consulta de sala';
        $modelo->urlJs = 'conta';
        
        if($consultarUsuario)
        {
            $modelo->usuario = $usuario->__get('usuario');
            $modelo->senha = $usuario->__get('senha');
            $modelo->nome = $usuario->__get('nome');
            $modelo->email = $usuario->__get('email');
        }
        else
        {
            $this->mensagem = $usuario->getMensagem();
        }
        
        return $modelo;
    }

    public function IndexPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $usuario = new Usuario();

            $camposString['Nome'] = $modelo->nome;
            $validacao->setEntrada($camposString, 'string');
            
            $camposEmail['E-mail'] = $modelo->email;
            $validacao->setEntrada($camposEmail, 'email');

            if($validacao->VerificarVazioArray() || !$validacao->LimparStringArray() || !$validacao->ValidarEmail())
            {
                throw new Exception($validacao->getMensagem());
            }

            $usuario->setNome($validacao->getSaida()['string']['Nome']);
            $usuario->setEmail($validacao->getSaida()['email']['E-mail']);

            $alterarUsuario = $usuario->AlterarUsuario($modelo->usuario);

            if(!$alterarUsuario)
            {
                throw new Exception($usuario->getMensagem());
            }

            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }
    
    public function IndexSenhaPost($modelo) : bool
    {
        try
        {
            $validacao = new Validacao();
            $usuario = new Usuario();
            
            $camposString['Senha atual'] = $modelo->senha;
            $camposString['Nova senha'] = $modelo->novaSenha;
            $camposString['Nova senha novamente'] = $modelo->novaSenhaNovamente;
            $validacao->setEntrada($camposString, 'string');

            if($validacao->VerificarVazioArray() || !$validacao->LimparStringArray())
            {
                throw new Exception($validacao->getMensagem());
            }
            
            $validarUsuario = $usuario->ValidarUsuario($modelo->usuario, $modelo->senha);
            
            if(!$validarUsuario)
            {
                throw new Exception($usuario->getMensagem());
            }
            
            $validarNovaSenha = $usuario->ValidarNovaSenha($modelo->novaSenha, $modelo->novaSenhaNovamente);
            
            if(!$validarNovaSenha)
            {
                throw new Exception($usuario->getMensagem());
            }
            
            $alterarSenha = $usuario->AlterarSenha($modelo->usuario, $validacao->getSaida()['string']['Nova senha']);

            if(!$alterarSenha)
            {
                throw new Exception($usuario->getMensagem());
            }
            
            return true;
        }
        catch (Exception $e)
        {
            $this->mensagem = $e->getMessage();
            return false;
        }
    }
}