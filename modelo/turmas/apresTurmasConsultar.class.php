<?php
class apresTurmasConsultar
{
    private $titulo;
    private $urlJs;
    private $cursosBiologicas;
    private $cursosExatas;
    private $cursosHumanas;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setCursosBiologicas(array $param)
    {
        $this->cursosBiologicas = $param;
    }
    function setCursosExatas(array $param)
    {
        $this->cursosExatas = $param;
    }
    function setCursosHumanas(array $param)
    {
        $this->cursosHumanas = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>