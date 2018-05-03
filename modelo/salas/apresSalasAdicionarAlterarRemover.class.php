<?php
class apresSalasAdicionarAlterarRemover
{
    private $titulo;
    private $urlJs;
    private $nome;
    private $predio;
    private $bloco;
    private $pavimento;

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
    function setPredio(int $param)
    {
        $this->predio = $param;
    }
    function setBloco(string $param)
    {
        $this->bloco = $param;
    }
    function setPavimento(int $param)
    {
        $this->pavimento = $param;
    }

    function __get($name)
    {
        return $this->$name;
    }
}
?>