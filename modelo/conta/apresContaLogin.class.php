<?php
class apresContaLogin
{
    private $titulo;
    private $urlJs;
    private $usuario;
    private $senha;

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

    function __get($name)
    {
        return $this->$name;
    }
}
?>