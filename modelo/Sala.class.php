<?php
class Sala
{
    private $nome;
    private $predio;
    private $bloco;
    private $pavimento;

    function __construct($nome = null, $predio = null, $bloco = null, $pavimento = null)
    {
        if(!empty($nome))
            $this->nome = $nome;
        if(!empty($predio))
            $this->predio = $predio;
        if(!empty($bloco))
            $this->bloco = $bloco;
        if(!empty($pavimento))
            $this->pavimento = $pavimento;
    }

    function ConsultarSalas($bloco = null)
    {
        $crud = new Crud();

        if(empty($bloco))
            $consultarBd = $crud->ConsultarBd('salas');
        else
            $consultarBd = $crud->ConsultarBd('salas', 'bloco', $bloco);

        if($consultarBd)
        {
            return $consultarBd;
        }
        else
            return null;
    }

    function ConsultarSala($nome) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('salas', 'nome', $nome);

        if($consultarBd)
        {
            $this->nome = $consultarBd[0]['nome'];
            $this->predio = $consultarBd[0]['predio'];
            $this->bloco = $consultarBd[0]['bloco'];
            $this->pavimento = $consultarBd[0]['pavimento'];

            return true;
        }
        else
            return false;
    }

    function AdicionarSala() : bool
    {
        $consultarSala = $this->ConsultarSala($this->nome);

        if(!$consultarSala)
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('salas', 'nome', 'predio', 'bloco', 'pavimento', $this->nome, $this->predio, $this->bloco, $this->pavimento);

            if($adicionarBd)
                return true;
            else
                return false;
        }
        else
        {
            $_SESSION['erro'] = 'Já existe uma sala com esse nome.';
            return false;
        }
    }

    function AlterarSala($nome) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('salas', 'nome', $nome, 'predio', 'bloco', 'pavimento', $this->predio, $this->bloco, $this->pavimento);

        if($alterarBd)
            return true;
        else
            return false;
    }

    function RemoverSala($nome) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('salas', 'nome', $nome);

        if($removerBd)
            return true;
        else
            return false;
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