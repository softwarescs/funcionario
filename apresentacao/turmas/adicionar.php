<?php
require_once('../_require.php');

$turmasControle = new TurmasControle();

if($_POST)
{
    $modelo = new apresTurmasAdicionarAlterarRemover();
    $modelo->setCurso($_POST['curso']);
    $modelo->setPeriodo($_POST['periodo']);
    $modelo->setSemestre($_POST['semestre']);
    $modelo->setSala($_POST['sala']);

    $post = $turmasControle->AdicionarPost($modelo);
}
else
{
    $modelo = $turmasControle->AdicionarGet();
}

include_once(App_CabecalhoModelo);
include_once(App_MenuModelo);
?>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col col-lg-6 p-4 bg-white">
                <?php
                if(isset($post) && $post)
                    echo 'Adicionado com sucesso.';
                elseif(isset($_SESSION['erro']))
                    echo $_SESSION['erro'];
                ?>
                <h2>Turmas <small>/ Adicionar</small></h2>
                <p>Adicionar uma nova turma:</p>
                <form method="post" action="adicionar.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso" class="form-control">
                            <option selected>Selecione o curso...</option>
<?php
                            foreach($modelo->__get('cursos') as $model)
                            {
                                foreach($model as $m)
                                {
?>
                                    <option><?=$m['nome']?></option>
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
                            foreach($modelo->__get('salas') as $model)
                            {
                                foreach($model as $m)
                                {
?>
                                    <option><?=$m['nome']?></option>
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
<?php include_once(App_RodapeModelo); ?>