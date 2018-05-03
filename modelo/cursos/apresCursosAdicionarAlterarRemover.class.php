<?php
class apresCursosAdicionarAlterarRemover
{
    private $titulo;
    private $urlJs;
    private $nome;
    private $areaAtuacao;

    function setTitulo(string $param)
    {
        $this->titulo = $param;
    }
    function setUrlJs(string $param)
    {
        $this->urlJs = $param;
    }
    function setNome(string $param)
    {
        $this->nome = $param;
    }
    function setAreaAtuacao(string $param)
    {
        $this->areaAtuacao = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>