<?php
class Curso extends abstrErroPropriedades
{
    private $nome;
    private $areaAtuacao;

    function ConsultarCursos(string $areaAtuacao = null)
    {
        $crud = new Crud();

        if(empty($areaAtuacao))
        {
            $consultarBd = $crud->ConsultarBd('cursos');
        }
        else
        {
            $consultarBd = $crud->ConsultarBd('cursos', 'areaAtuacao', $areaAtuacao);
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

    function ConsultarCurso(string $nome) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('cursos', 'nome', $nome);
        
        if(!empty($consultarBd))
        {
            $this->nome = $consultarBd[0]['nome'];
            $this->areaAtuacao = $consultarBd[0]['areaAtuacao'];
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    function AdicionarCurso() : bool
    {
        $consultarCurso = $this->ConsultarCurso($this->nome);

        if(empty($consultarCurso))
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('cursos', 'nome', 'areaAtuacao', $this->nome, $this->areaAtuacao);
            
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
            $this->mensagem = 'Já existe um curso com esse nome.';
            return false;
        }
    }

    function AlterarCurso(string $nome) : bool
    {
        $crud = new Crud();

        $alterarBd = $crud->AlterarBd('cursos', 'nome', $nome, 'areaAtuacao', $this->areaAtuacao);
        
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

    function RemoverCurso(string $nome) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('cursos', 'nome', $nome);
        
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
    function __get(string $name)
    {
        return $this->$name;
    }
    
    //Set
    function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    function setAreaAtuacao(string $areaAtuacao)
    {
        $this->areaAtuacao = $areaAtuacao;
    }
}