<?php
class apresCursosIndex
{
    private $titulo;
    private $urlJs;
    private $listaBiologicas;
    private $listaExatas;
    private $listaHumanas;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setListaBiologicas(array $param)
    {
        $this->listaBiologicas = $param;
    }
    function setListaExatas(array $param)
    {
        $this->listaExatas = $param;
    }
    function setListaHumanas(array $param)
    {
        $this->listaHumanas = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>