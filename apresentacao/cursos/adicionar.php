<?php
require_once('../_require.php');

$config = new Configuracoes();
$cursosControle = new CursosControle();

if($_POST)
{
    $modelo = new apresCursosAdicionarAlterarRemover();
    $modelo->nome = $_POST['nome'];
    $modelo->areaAtuacao = $_POST['areaAtuacao'];

    $post = $cursosControle->AdicionarPost($modelo);
}

$modelo = $cursosControle->AdicionarGet();

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
                        Adicionado com sucesso.
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
                <h2>Cursos <small>/ Adicionar</small></h2>
                <p>Adicionar um novo curso:</p>
                <form method="post" action="adicionar.php">
                    <div class="form-group">
                        <label>Nome do curso</label>
                        <input type="text" name="nome" class="form-control" placeholder="Ex.: 'Administração'">
                    </div>
                    <div class="form-group">
                        <label>Área de atuação</label>
                        <select name="areaAtuacao" class="form-control">
                            <option selected>Selecione a área de atuação...</option>
                            <option>Biológicas</option>
                            <option>Exatas</option>
                            <option>Humanas</option>
                        </select>
                    </div>
                    <a class="col-3 btn btn-outline-secondary" href="#" onclick="javascript: window.close()">Cancelar</a>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>