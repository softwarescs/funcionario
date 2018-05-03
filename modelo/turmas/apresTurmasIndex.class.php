<?php
class apresTurmasIndex
{
    private $titulo;
    private $urlJs;
    private $turmas;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setTurmas(array $param)
    {
        $this->turmas = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>