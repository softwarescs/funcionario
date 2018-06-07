<?php
require_once('_require.php');


function Json($dados = array())
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
	exit;
}

if(!$_GET)
{
	echo 'Método de requisição não aceito.';
}

if(isset($_GET['turmas']))
{
	$turma = new Turma();
	$consultarTurmas = $turma->ConsultarTurmas();
	
	if(!empty($consultarTurmas))
        {
            Json($consultarTurmas);
        }
}

if(isset($_GET['cursos']))
{
	$curso = new Curso();
	$consultarCursos = $curso->ConsultarCursos();
	
	if(!empty($consultarCursos))
        {
            Json($consultarCursos);
        }
}

if(isset($_GET['salas']))
{
	$sala = new Sala();
	$consultarSalas = $sala->ConsultarSalas();
	
	if (!empty($consultarSalas))
        {
            Json($consultarSalas);
        }
}