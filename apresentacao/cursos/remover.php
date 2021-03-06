<?php
require_once('../_require.php');

$config = new Configuracoes();
$cursosControle = new CursosControle();

if($_GET)
{
    $modelo = $cursosControle->RemoverGet($_GET['nome']);
}
elseif($_POST)
{
    $modelo = new apresCursosAdicionarAlterarRemover();
    $modelo->nome = $_POST['nome'];
    
    $post = $cursosControle->RemoverPost($modelo);
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
                    <p class="text-danger"><?=$cursosControle->getMensagem()?></p>
<?php
                }
?>
                <h2>Cursos <small>/ Remover</small></h2>
<?php
                if($_GET)
                {
?>
                    <p>Remover o seguinte curso:</p>
                    <form method="post" action="remover.php">
                        <div class="form-group">
                            <label>Nome do curso</label>
                            <input type="text" name="nome"
                                   value="<?=$modelo->nome?>"
                                   class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Área de atuação</label>
                            <input type="text" name="areaAtuacao"
                                value="<?=$modelo->areaAtuacao?>"
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