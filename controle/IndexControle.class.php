<?php
class IndexControle
{
    function IndexGet()
    {
        $turma = new Turma();
        $consultarTurmas = $turma->ConsultarTurmas();

        $curso = new Curso();
        $consultarCursos = array();
        $consultarCursos['biologicas'] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos['exatas'] = $curso->ConsultarCursos('Exatas');
        $consultarCursos['humanas'] = $curso->ConsultarCursos('Humanas');

        $sala = new Sala();
        $consultarSalas = $sala->ConsultarSalas();

        $modelo = new apresIndex();
        $modelo->setTitulo('Área do administrador - Sistema consulta de sala');
        $modelo->setUrlJs('index');

        if($consultarTurmas)
        {
            $modelo->setTurmas($consultarTurmas);
            $modelo->setQtdeTurmas(count($consultarTurmas));
        }

        if($consultarCursos)
        {
            $modelo->setCursos($consultarCursos);
            $modelo->setQtdeCursos(count($consultarCursos['biologicas']) + count($consultarCursos['exatas']) + count($consultarCursos['humanas']));
        }

        if($consultarSalas)
        {
            $modelo->setSalas($consultarSalas);
            $modelo->setQtdeSalas(count($consultarCursos));
        }

        return $modelo;
    }
}
?>