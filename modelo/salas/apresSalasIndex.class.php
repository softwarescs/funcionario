<?php
class apresSalasIndex
{
    private $titulo;
    private $urlJs;
    private $salas;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setSalas(array $param)
    {
        $this->salas = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>