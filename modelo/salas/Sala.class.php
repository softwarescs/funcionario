<?php
class Sala extends abstrErroPropriedades
{
    private $nome;
    private $predio;
    private $bloco;
    private $pavimento;

    function ConsultarSalas(string $bloco = null)
    {
        $crud = new Crud();

        if(empty($bloco))
        {
            $consultarBd = $crud->ConsultarBd('salas');
        }
        else
        {
            $consultarBd = $crud->ConsultarBd('salas', 'bloco', $bloco);
        }

        if(!empty($consultarBd))
        {
            return $consultarBd;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return null;
        }
    }

    function ConsultarSala(string $nome) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('salas', 'nome', $nome);

        if(!empty($consultarBd))
        {
            $this->nome = $consultarBd[0]['nome'];
            $this->predio = $consultarBd[0]['predio'];
            $this->bloco = $consultarBd[0]['bloco'];
            $this->pavimento = $consultarBd[0]['pavimento'];
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    function AdicionarSala() : bool
    {
        $consultarSala = $this->ConsultarSala($this->nome);

        if(empty($consultarSala))
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('salas', 'nome', 'predio', 'bloco', 'pavimento', $this->nome, $this->predio, $this->bloco, $this->pavimento);

            if($adicionarBd)
            {
                return true;
            }
            else
            {
                $this->mensagem = $crud->getMensagem();
                return false;
            }
        }
        else
        {
            $this->mensagem = 'Já existe uma sala com esse nome.';
            return false;
        }
    }

    function AlterarSala(string $nome) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('salas', 'nome', $nome, 'predio', 'bloco', 'pavimento', $this->predio, $this->bloco, $this->pavimento);

        if($alterarBd)
        {
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    function RemoverSala(string $nome) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('salas', 'nome', $nome);

        if($removerBd)
        {
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    //Get
    function __get($name)
    {
        return $this->$name;
    }
    
    //Set
    function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    function setPredio(int $predio)
    {
        $this->predio = $predio;
    }
    function setBloco(string $bloco)
    {
        $this->bloco = $bloco;
    }
    function setPavimento(int $pavimento)
    {
        $this->pavimento = $pavimento;
    }
}