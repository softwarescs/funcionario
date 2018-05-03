<?php
class TurmasControle
{
    function IndexGet($curso, $periodo)
    {
        $turma = new Turma();
        $consultarTurmas = $turma->ConsultarTurmas($curso, $periodo);

        $modelo = new apresTurmasIndex();
        $modelo->setTitulo('Turmas - Sistema consulta de sala');
        $modelo->setUrlJs('turmas');

        if($consultarTurmas)
            $modelo->setTurmas($consultarTurmas);

        return $modelo;
    }

    function ConsultarGet()
    {
        $curso = new Curso();
        $consultarCursosBiologicas = $curso->ConsultarCursos('Biologicas');
        $consultarCursosExatas = $curso->ConsultarCursos('Exatas');
        $consultarCursosHumanas = $curso->ConsultarCursos('Humanas');

        $modelo = new apresTurmasConsultar();
        $modelo->setTitulo('Consultar turmas - Sistema consulta de sala');
        $modelo->setUrlJs('turmas');

        if($consultarCursosBiologicas)
            $modelo->setCursosBiologicas($consultarCursosBiologicas);
        if($consultarCursosExatas)
            $modelo->setCursosExatas($consultarCursosExatas);
        if($consultarCursosHumanas)
            $modelo->setCursosHumanas($consultarCursosHumanas);

        return $modelo;
    }

    function AdicionarGet()
    {
        $curso = new Curso();
        $consultarCursos = array();
        $consultarCursos[] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos[] = $curso->ConsultarCursos('Exatas');
        $consultarCursos[] = $curso->ConsultarCursos('Humanas');

        $sala = new Sala();
        $consultarSalas = array();

        for($i = 'A'; $i != 'Z'; $i++)
        {
            $consultarSalas[] = $sala->ConsultarSalas($i);
        }

        $modelo = new apresTurmasAdicionarAlterarRemover();
        $modelo->setTitulo('Adicionar turma - Sistema consulta de sala');
        $modelo->setUrlJs('turmas');
        $modelo->setCursos($consultarCursos);
        $modelo->setSalas($consultarSalas);

        return $modelo;
    }

    function AdicionarPost(object $modelo)
    {
        $turma = new Turma();
        $turma->setCurso($modelo->__get('curso'));
        $turma->setPeriodo($modelo->__get('periodo'));
        $turma->setSemestre($modelo->__get('semestre'));
        $turma->setSala($modelo->__get('sala'));

        $adicionarTurma = $turma->AdicionarTurma();

        if($adicionarTurma)
            return true;
        else
            return false;
    }

    function AlterarGet($curso, $periodo, $semestre)
    {
        $turma = new Turma();
        $consultarTurma = $turma->ConsultarTurma($curso, $periodo, $semestre);

        $sala = new Sala();
        $consultarSalas = array();

        for($i = 'A'; $i != 'Z'; $i++)
        {
            $consultarSalas[] = $sala->ConsultarSalas($i);
        }

        if($consultarTurma)
        {
            $modelo= new apresTurmasAdicionarAlterarRemover();
            $modelo->setTitulo('Alterar turma - Sistema consulta de sala');
            $modelo->setUrlJs('turmas');
            $modelo->setCurso($turma->__get('curso'));
            $modelo->setPeriodo($turma->__get('periodo'));
            $modelo->setSemestre($turma->__get('semestre'));
            $modelo->setSala($turma->__get('sala'));
            $modelo->setSalas($consultarSalas);

            return $modelo;
        }
    }

    function AlterarPost(object $modelo)
    {
        $turma = new Turma();
        $turma->setSala($modelo->__get('sala'));

        $alterarTurma = $turma->AlterarTurma($modelo->__get('curso'), $modelo->__get('periodo'), $modelo->__get('semestre'));

        if($alterarTurma)
            return true;
        else
            return false;
    }

    function RemoverGet($curso, $periodo, $semestre)
    {
        $turma = new Turma();
        $consultarTurma = $turma->ConsultarTurma($curso, $periodo, $semestre);

        if($consultarTurma)
        {
            $modelo= new apresTurmasAdicionarAlterarRemover();
            $modelo->setTitulo('Remover turma - Sistema consulta de sala');
            $modelo->setUrlJs('turmas');
            $modelo->setCurso($turma->__get('curso'));
            $modelo->setPeriodo($turma->__get('periodo'));
            $modelo->setSemestre($turma->__get('semestre'));
            $modelo->setSala($turma->__get('sala'));

            return $modelo;
        }
    }

    function RemoverPost(object $modelo)
    {
        $turma = new Turma();
        $removerTurma = $turma->RemoverTurma($modelo->__get('curso'), $modelo->__get('periodo'), $modelo->__get('semestre'));

        if($removerTurma)
            return true;
        else
            return false;
    }
}
?>