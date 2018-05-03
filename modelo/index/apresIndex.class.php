<?php
class apresIndex
{
    private $titulo;
    private $urlJs;
    private $turmas;
    private $qtdeTurmas;
    private $cursos;
    private $qtdeCursos;
    private $salas;
    private $qtdeSalas;

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
    function setQtdeTurmas(int $param)
    {
        $this->qtdeTurmas = $param;
    }
    function setCursos(array $param)
    {
        $this->cursos = $param;
    }
    function setQtdeCursos(int $param)
    {
        $this->qtdeCursos = $param;
    }
    function setSalas(array $param)
    {
        $this->salas = $param;
    }
    function setQtdeSalas(int $param)
    {
        $this->qtdeSalas = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>