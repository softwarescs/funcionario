<?php
require_once('../_require.php');

$salasControle = new SalasControle();

if($_GET)
{
    $modelo = $salasControle->AlterarGet($_GET['nome']);
}
elseif($_POST)
{
    $modelo = new apresSalasAdicionarAlterarRemover();
    $modelo->setNome($_POST['nome']);
    $modelo->setPredio($_POST['predio']);
    $modelo->setBloco($_POST['bloco']);
    $modelo->setPavimento($_POST['pavimento']);

    $post = $salasControle->AlterarPost($modelo);
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
                <h2>Salas <small>/ Alterar</small></h2>
                <?php
                if($_GET)
                {
                ?>
                <p>Alterar a seguinte sala:</p>
                <form method="post" action="alterar.php">
                    <div class="form-group">
                        <label>Nome da sala</label>
                        <input type="text" name="nome"
                               value="<?=$modelo->__get('nome')?>"
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Prédio</label>
                        <select name="predio" class="form-control">
                            <option selected><?=$modelo->__get('predio')?></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bloco</label>
                        <select name="bloco" class="form-control">
                            <option selected><?=$modelo->__get('bloco')?></option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pavimento</label>
                        <select name="pavimento" class="form-control">
                            <option selected><?=$modelo->__get('pavimento')?></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
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