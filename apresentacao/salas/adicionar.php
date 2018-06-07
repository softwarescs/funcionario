<?php
require_once('../_require.php');

$config = new Configuracoes();
$salasControle = new SalasControle();

if($_POST)
{
    $modelo = new apresSalasAdicionarAlterarRemover();
    $modelo->nome = $_POST['nome'];
    $modelo->predio = $_POST['predio'];
    $modelo->bloco = $_POST['bloco'];
    $modelo->pavimento = $_POST['pavimento'];

    $post = $salasControle->AdicionarPost($modelo);
}

$modelo = $salasControle->AdicionarGet();

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
                    <p class="text-danger"><?=$salasControle->getMensagem()?></p>
<?php
                }
?>
                <h2>Salas <small>/ Adicionar</small></h2>
                <p>Adicionar uma nova sala:</p>
                <form method="post" action="adicionar.php">
                    <div class="form-group">
                        <label>Nome da sala</label>
                        <input type="text" name="nome" class="form-control" placeholder="Ex.: A11">
                    </div>
                    <div class="form-group">
                        <label>Prédio</label>
                        <select name="predio" class="form-control">
                            <option selected>Selecione o prédio...</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bloco</label>
                        <select name="bloco" class="form-control">
                            <option selected>Selecione o bloco...</option>
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pavimento</label>
                        <select name="pavimento" class="form-control">
                            <option selected>Selecione o pavimento...</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <a class="col-3 btn btn-outline-secondary" href="#" onclick="javascript: window.close()">Cancelar</a>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>