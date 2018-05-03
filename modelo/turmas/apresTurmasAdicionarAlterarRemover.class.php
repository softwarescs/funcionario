<?php
class apresTurmasAdicionarAlterarRemover
{
    private $titulo;
    private $urlJs;
    private $curso;
    private $periodo;
    private $semestre;
    private $sala;
    private $cursos;
    private $salas;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setCurso(string $param)
    {
        $this->curso = $param;
    }
    function setPeriodo(string $param)
    {
        $this->periodo = $param;
    }
    function setSemestre(int $param)
    {
        $this->semestre = $param;
    }
    function setSala(string $param)
    {
        $this->sala = $param;
    }
    function setCursos(array $param)
    {
        $this->cursos = $param;
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