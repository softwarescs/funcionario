<?php
class Turma extends abstrErroPropriedades
{
    private $curso;
    private $periodo;
    private $semestre;
    private $sala;

    function ConsultarTurmas(string $curso = null, string $periodo = null)
    {
        $crud = new Crud();

        if(empty($curso) && empty($periodo))
        {
            $consultarBd = $crud->ConsultarBd('turmas');
        }
        else
        {
            $consultarBd = $crud->ConsultarBd('turmas', 'cursos_nome', $curso, 'periodo', $periodo);
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

    function ConsultarTurma(string $curso, string $periodo, $semestre) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('turmas', 'cursos_nome', $curso, 'periodo', $periodo, 'semestre', $semestre);

        if(!empty($consultarBd))
        {
            $this->curso = $consultarBd[0]['cursos_nome'];
            $this->periodo = $consultarBd[0]['periodo'];
            $this->semestre = $consultarBd[0]['semestre'];
            $this->sala = $consultarBd[0]['salas_nome'];
            return true;
        }
        else
        {
            $this->mensagem = $crud->getMensagem();
            return false;
        }
    }

    function AdicionarTurma() : bool
    {
        $consultarTurma = $this->ConsultarTurma($this->curso, $this->periodo, $this->semestre);

        if(empty($consultarTurma))
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('turmas', 'cursos_nome', 'salas_nome', 'periodo', 'semestre', $this->curso, $this->sala, $this->periodo, $this->semestre);

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
            $this->mensagem = 'Já existe uma turma com essa configuração.';
            return false;
        }
    }

    function AlterarTurma(string $curso, string $periodo, $semestre) : bool
    {
        $crud = new Crud();
        $coluna = array('cursos_nome', 'periodo', 'semestre');
        $filtro = array($curso, $periodo, $semestre);

        $alterarBd = $crud->AlterarBd('turmas', $coluna, $filtro, 'salas_nome', $this->sala);

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

    function RemoverTurma(string $curso, string $periodo, $semestre) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('turmas', 'cursos_nome', $curso, 'periodo', $periodo, 'semestre', $semestre);

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
    function setCurso(string $curso)
    {
        $this->curso = $curso;
    }
    function setPeriodo(string $periodo)
    {
        $this->periodo = $periodo;
    }
    function setSemestre(int $semestre)
    {
        $this->semestre = $semestre;
    }
    function setSala(string $sala)
    {
        $this->sala = $sala;
    }
}