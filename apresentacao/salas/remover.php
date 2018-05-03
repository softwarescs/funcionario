<?php
require_once('../_require.php');

$salasControle = new SalasControle();

if($_GET)
{
    $modelo = $salasControle->RemoverGet($_GET['nome']);
}
elseif($_POST)
{
    $modelo = new apresSalasAdicionarAlterarRemover();
    $modelo->setNome($_POST['nome']);
    
    $post = $salasControle->RemoverPost($modelo);
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
                        <label>Nome da sala</label>
                        <input type="text" name="nome"
                            value="<?=$modelo->__get('nome')?>"
                            class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Prédio</label>
                        <input type="text" name="predio" 
                               value="<?=$modelo->__get('predio')?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Bloco</label>
                        <input type="text" name="bloco" 
                               value="<?=$modelo->__get('bloco')?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Pavimento</label>
                        <input type="text" name="pavimento"
                            value="<?=$modelo->__get('pavimento')?>"
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