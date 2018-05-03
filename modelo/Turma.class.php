<?php
class Turma
{
    private $curso;
    private $periodo;
    private $semestre;
    private $sala;

    function ConsultarTurmas($cursos_nome = null, $periodo = null)
    {
        $crud = new Crud();

        if(empty($cursos_nome) && empty($periodo))
            $consultarBd = $crud->ConsultarBd('turmas');
        else
            $consultarBd = $crud->ConsultarBd('turmas', 'cursos_nome', $cursos_nome, 'periodo', $periodo);

        if($consultarBd)
        {
            return $consultarBd;
        }
        else
            return null;
    }

    function ConsultarTurma($curso, $periodo, $semestre) : bool
    {
        $crud = new Crud();

        $consultarBd = $crud->ConsultarBd('turmas', 'cursos_nome', $curso, 'periodo', $periodo, 'semestre', $semestre);

        if($consultarBd)
        {
            $this->id = $consultarBd[0]['id'];
            $this->curso = $consultarBd[0]['cursos_nome'];
            $this->periodo = $consultarBd[0]['periodo'];
            $this->semestre = $consultarBd[0]['semestre'];
            $this->sala = $consultarBd[0]['salas_nome'];

            return true;
        }
        else
            return false;
    }

    function AdicionarTurma() : bool
    {
        $consultarTurma = $this->ConsultarTurma($this->curso, $this->periodo, $this->semestre);

        if(!$consultarTurma)
        {
            $crud = new Crud();

            $adicionarBd = $crud->AdicionarBd('turmas', 'cursos_nome', 'salas_nome', 'periodo', 'semestre', $this->curso, $this->sala, $this->periodo, $this->semestre);

            if($adicionarBd)
                return true;
            else
                return false;
        }
        else
            $_SESSION['erro'] = 'Jс existe uma turma com essa configuraчуo.';
            return false;
    }

    function AlterarTurma($curso, $periodo, $semestre) : bool
    {
        $crud = new Crud();
        $coluna = array('cursos_nome', 'periodo', 'semestre');
        $filtro = array($curso, $periodo, $semestre);

        $alterarBd = $crud->AlterarBd('turmas', $coluna, $filtro, 'salas_nome', $this->sala);

        if($alterarBd)
            return true;
        else
            return false;
    }

    function RemoverTurma($curso, $periodo, $semestre) : bool
    {
        $crud = new Crud();

        $removerBd = $crud->RemoverBd('turmas', 'cursos_nome', $curso, 'periodo', $periodo, 'semestre', $semestre);

        if($removerBd)
            return true;
        else
            return false;
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

    function __get($name)
    {
        return $this->$name;
    }
}
?>