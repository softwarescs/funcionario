<?php
require_once('../_require.php');

$turmasControle = new TurmasControle();

if($_GET)
{
    $modelo = $turmasControle->RemoverGet($_GET['c'], $_GET['p'], $_GET['s']);
}
elseif($_POST)
{
    $modelo = new apresTurmasAdicionarAlterarRemover();
    $modelo->setCurso($_POST['curso']);
    $modelo->setPeriodo($_POST['periodo']);
    $modelo->setSemestre($_POST['semestre']);

    $post = $turmasControle->RemoverPost($modelo);
}
else
    header('location: index.php');

include_once(App_CabecalhoModelo);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
                <?php
                if(isset($post) && $post)
                    echo 'Removido com sucesso.';
                elseif(isset($_SESSION['erro']))
                    echo $_SESSION['erro'];
                ?>
                <h2>Salas <small>/ Remover</small></h2>
                <?php if($_GET) { ?>
                <p>Remover a seguinte sala:</p>
                <form method="post" action="remover.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" name="curso"
                            value="<?=$modelo->__get('curso')?>"
                            class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Período</label>
                        <input type="text" name="periodo" 
                               value="<?=$modelo->__get('periodo')?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Semestre</label>
                        <input type="text" name="semestre" 
                               value="<?=$modelo->__get('semestre')?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Sala</label>
                        <input type="text" name="sala"
                            value="<?=$modelo->__get('sala')?>"
                            class="form-control" readonly />
                    </div>
                    <a class="col-3 btn btn-outline-secondary" href="#" onclick="javascript: window.close()">Cancelar</a>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Confirmar</button>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
<?php include_once(App_RodapeModelo); ?>