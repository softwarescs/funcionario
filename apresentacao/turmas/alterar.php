<?php
require_once('../_require.php');

$config = new Configuracoes();
$turmasControle = new TurmasControle();

if($_GET)
{
    $modelo = $turmasControle->AlterarGet($_GET['c'], $_GET['p'], $_GET['s']);
}
elseif($_POST)
{
    $modelo = new apresTurmasAdicionarAlterarRemoverConsultar();
    $modelo->curso = $_POST['curso'];
    $modelo->periodo = $_POST['periodo'];
    $modelo->semestre = $_POST['semestre'];
    $modelo->sala = $_POST['sala'];

    $post = $turmasControle->AlterarPost($modelo);
}
else
{
    header('location: index.php');
}

include_once($config->getCabecalho());
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
<?php
                if(isset($post) && $post)
                {
?>
                    <p class="text-success">
                        <i class="fas fa-check mr-2"></i>
                        Alterado com sucesso.
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
                <h2>Turmas <small>/ Alterar</small></h2>
                <?php
                if($_GET)
                {
                ?>
                <p>Alterar a seguinte turma:</p>
                <form method="post" action="alterar.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso"
                               value="<?=$modelo->curso?>"
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Período</label>
                        <input type="text" name="periodo"
                               value="<?=$modelo->periodo?>"
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Semestre</label>
                        <input type="text" name="semestre"
                               value="<?=$modelo->semestre?>"
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Sala</label>
                        <select name="sala" class="form-control">
                            <option selected><?=$modelo->sala?></option>
<?php
                            foreach($modelo->salas as $model)
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
                    <a class="col-3 btn btn-outline-secondary" href="#" onclick="javascript: window.close()">Cancelar</a>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Confirmar</button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>