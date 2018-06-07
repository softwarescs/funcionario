<?php
class InicioControle extends abstrErroPropriedades
{
    function IndexGet()
    {
        $turma = new Turma();
        $curso = new Curso();
        $sala = new Sala();
        $modelo = new apresInicio();
        
        $consultarTurmas = $turma->ConsultarTurmas();
        
        $consultarCursos['Biologicas'] = $curso->ConsultarCursos('Biologicas');
        $consultarCursos['Exatas'] = $curso->ConsultarCursos('Exatas');
        $consultarCursos['Humanas'] = $curso->ConsultarCursos('Humanas');

        $consultarSalas = $sala->ConsultarSalas();

        
        $modelo->titulo = 'Área do administrador - Sistema consulta de sala';
        $modelo->urlJs = 'index';

        if(!empty($consultarTurmas))
        {
            $modelo->turmas = $consultarTurmas;
        }

        if(!empty($consultarCursos))
        {
            $modelo->cursos = $consultarCursos;
        }

        if(!empty($consultarSalas))
        {
            $modelo->salas = $consultarSalas;
        }

        return $modelo;
    }
}