<?php
require_once('../_require.php');

$config = new Configuracoes();
$salasControle = new SalasControle();

if($_GET)
{
    $modelo = $salasControle->RemoverGet($_GET['nome']);
}
elseif($_POST)
{
    $modelo = new apresSalasAdicionarAlterarRemover();
    $modelo->nome = $_POST['nome'];
    
    $post = $salasControle->RemoverPost($modelo);
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
                        Removido com sucesso.
                    </p>
<?php
                }
                elseif(isset($post) && !$post)
                {
?>
                    <p class="text-danger"><?=$salasControle->getMensagem()?></p>
<?php
                }
?>
                <h2>Salas <small>/ Remover</small></h2>
                <?php
                if($_GET)
                {
                ?>
                <p>Remover a seguinte sala:</p>
                <form method="post" action="remover.php">
                    <div class="form-group">
                        <label>Nome da sala</label>
                        <input type="text" name="nome"
                            value="<?=$modelo->nome?>"
                            class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Prédio</label>
                        <input type="text" name="predio" 
                               value="<?=$modelo->predio?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Bloco</label>
                        <input type="text" name="bloco" 
                               value="<?=$modelo->bloco?>" 
                               class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Pavimento</label>
                        <input type="text" name="pavimento"
                            value="<?=$modelo->pavimento?>"
                            class="form-control" readonly />
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