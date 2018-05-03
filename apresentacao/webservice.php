<?php
require_once('_require.php');

$dados = array();
$mensagem = '';

function Json($sucesso = false, $mensagem = null, $dados = array())
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(
        array(
            'sucesso' => $sucesso,
            'mensagem' => $mensagem,
            'dados'   => $dados
        ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
	exit;
}

if(!$_GET)
{
	$mensagem = 'Método de requisição não aceito.';
	Json(false, $mensagem, null);
}

if(isset($_GET['turmas']) && $_GET['turmas'] == 'true')
{
	$turma = new Turma();
	$consultarTurmas = $turma->ConsultarTurmas();
	
	if($consultarTurmas)
		$dados['turmas'] = $consultarTurmas;
	else
		$mensagem .= 'Não foi possível consultar as turmas no banco de dados. ';
}
else
	$mensagem .= '[turmas = false]';

if(isset($_GET['cursos']) && $_GET['cursos'] == 'true')
{
	$curso = new Curso();
	$consultarCursos = $curso->ConsultarCursos();
	
	if($consultarCursos)
		$dados['cursos'] = $consultarCursos;
	else
		$mensagem .= 'Não foi possível consultar os cursos no banco de dados. ';
}
else
	$mensagem .= '[cursos = false]';

if(isset($_GET['salas']) && $_GET['salas'] == 'true')
{
	$sala = new Sala();
	$consultarSalas = $sala->ConsultarSalas();
	
	if($consultarSalas)
		$dados['salas'] = $consultarSalas;
	else
		$mensagem .= 'Não foi possível consultar as salas no banco de dados. ';
}
else
	$mensagem .= '[salas = false]';

if($dados)
	Json(true, $mensagem, $dados);
else
	Json(false, $mensagem, null);
?>