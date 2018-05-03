<?php
class apresContaIndex
{
    private $titulo;
    private $urlJs;
    private $usuario;
    private $senha;
    private $novaSenha;
    private $novaSenhaNovamente;
    private $nome;
    private $email;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setUsuario(string $param)
    {
        $this->usuario = $param;
    }
    function setSenha(string $param)
    {
        $this->senha = $param;
    }
    function setNovaSenha(string $param)
    {
        $this->novaSenha = $param;
    }
    function setNovaSenhaNovamente(string $param)
    {
        $this->novaSenhaNovamente = $param;
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