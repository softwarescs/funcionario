<?php
require_once('../_require.php');

$config = new Configuracoes();
$turmasControle = new TurmasControle();

if($_POST)
{
    $modelo = new apresTurmasAdicionarAlterarRemoverConsultar();
    $modelo->curso = $_POST['curso'];
    $modelo->periodo = $_POST['periodo'];
    $modelo->semestre = $_POST['semestre'];
    $modelo->sala = $_POST['sala'];

    $post = $turmasControle->AdicionarPost($modelo);
    
    $modelo = $turmasControle->AdicionarGet();
}

$modelo = $turmasControle->AdicionarGet();

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
<?php
                if(isset($post) && $post)
                {
?>
                    <p class="text-success">
                        <i class="fas fa-check mr-2"></i>
                        Adicionado com sucesso.
                    </p>
<?php
                }
                elseif(isset($post) && !$post)
                {
?>
                    <p class="text-danger"><?=$turmasControle->getMensagem()?></p>
<?php
                }
?>
                <h2>Turmas <small>/ Adicionar</small></h2>
                <p>Adicionar uma nova turma:</p>
                <form method="post" action="adicionar.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso" class="form-control">
                            <option selected>Selecione o curso...</option>
<?php
                            foreach($modelo->cursos as $cursos)
                            {
                                foreach($cursos as $curso)
                                {
?>
                                    <option><?=$curso['nome']?></option>
<?php
                                }
                            }
?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Período</label>
                        <select name="periodo" class="form-control">
                            <option selected>Selecione o período...</option>
                            <option>Manhã</option>
                            <option>Noite</option>
                            <option>Integral</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semestre</label>
                        <select name="semestre" class="form-control">
                            <option selected>Selecione o semestre...</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sala</label>
                        <select name="sala" class="form-control">
                            <option selected>Selecione a sala...</option>
<?php
                            foreach($modelo->salas as $salas)
                            {
                                foreach($salas as $sala)
                                {
?>
                                    <option><?=$sala['nome']?></option>
<?php
                                }
                            }
?>
                        </select>
                    </div>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Salvar</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>