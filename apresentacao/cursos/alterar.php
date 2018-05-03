<?php
require_once('../_require.php');

$cursosControle = new CursosControle();

if($_GET)
{
    $modelo = $cursosControle->AlterarGet($_GET['nome']);
}
elseif($_POST)
{
    $modelo = new apresCursosAdicionarAlterarRemover();
    $modelo->setNome($_POST['nome']);
    $modelo->setAreaAtuacao($_POST['areaAtuacao']);

    $post = $cursosControle->AlterarPost($modelo);
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
                    echo 'Alterado com sucesso.';
                elseif(isset($_SESSION['erro']))
                    echo $_SESSION['erro'];
                ?>
                <h2>Cursos <small>/ Alterar</small></h2>
                <?php
                if($_GET)
                {
                ?>
                <p>Alterar o seguinte curso:</p>
                <form method="post" action="alterar.php">
                    <div class="form-group">
                        <label>Nome do curso</label>
                        <input type="text" name="nome"
                               value="<?=$modelo->__get('nome')?>"
                               class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Área de atuação</label>
                        <select name="areaAtuacao" class="form-control">
                            <option selected><?=$modelo->__get('areaAtuacao')?></option>
                            <option>Biológicas</option>
                            <option>Exatas</option>
                            <option>Humanas</option>
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
<?php include_once(App_RodapeModelo); ?>