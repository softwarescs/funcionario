<?php
class CursosControle
{
    function IndexGet()
    {
        $curso = new Curso();
        $consultarCursosBiologicas = $curso->ConsultarCursos('Biologicas');
        $consultarCursosExatas = $curso->ConsultarCursos('Exatas');
        $consultarCursosHumanas = $curso->ConsultarCursos('Humanas');

        $modelo = new apresCursosIndex();
        $modelo->setTitulo('Cursos - Sistema consulta de sala');
        $modelo->setUrlJs('cursos');

        if($consultarCursosBiologicas)
            $modelo->setListaBiologicas($consultarCursosBiologicas);
        if($consultarCursosExatas)
            $modelo->setListaExatas($consultarCursosExatas);
        if($consultarCursosHumanas)
            $modelo->setListaHumanas($consultarCursosHumanas);

        return $modelo;
    }

    function AdicionarGet()
    {
        $modelo = new apresCursosAdicionarAlterarRemover();
        $modelo->setTitulo('Adicionar curso - Sistema consulta de sala');
        $modelo->setUrlJs('cursos');

        return $modelo;
    }

    function AdicionarPost(object $modelo)
    {
        $curso = new Curso();
        $curso->setNome($modelo->__get('nome'));
        $curso->setAreaAtuacao($modelo->__get('areaAtuacao'));

        $adicionarCurso = $curso->AdicionarCurso();

        if($adicionarCurso)
            return true;
        else
            return false;
    }

    function AlterarGet($nome)
    {
        $curso = new Curso();
        $consultarCurso = $curso->ConsultarCurso($nome);

        if($consultarCurso)
        {
            $modelo = new apresCursosAdicionarAlterarRemover();
            $modelo->setTitulo('Alterar curso - Sistema consulta de sala');
            $modelo->setUrlJs('cursos');
            $modelo->setNome($curso->__get('nome'));
            $modelo->setAreaAtuacao($curso->__get('areaAtuacao'));

            return $modelo;
        }
    }

    function AlterarPost(object $modelo)
    {
        $curso = new Curso();
        $curso->setAreaAtuacao($modelo->__get('areaAtuacao'));

        $alterarCurso = $curso->AlterarCurso($modelo->__get('nome'));

        if($alterarCurso)
            return true;
        else
            return false;
    }

    function RemoverGet($nome)
    {
        $curso = new Curso();
        $consultarCurso = $curso->ConsultarCurso($nome);

        if($consultarCurso)
        {
            $modelo = new apresCursosAdicionarAlterarRemover();
            $modelo->setTitulo('Remover curso - Sistema consulta de sala');
            $modelo->setUrlJs('cursos');
            $modelo->setNome($curso->__get('nome'));
            $modelo->setAreaAtuacao($curso->__get('areaAtuacao'));

            return $modelo;
        }
    }

    function RemoverPost(object $modelo)
    {
        $curso = new Curso();
        $removerCurso = $curso->RemoverCurso($modelo->__get('nome'));

        if($removerCurso)
            return true;
        else
            return false;
    }
}
?>