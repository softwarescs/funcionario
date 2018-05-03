<?php
require_once('../_require.php');

$salasControle = new SalasControle();

if($_POST)
{
    $modelo = new apresSalasAdicionarAlterarRemover();
    $modelo->setNome($_POST['nome']);
    $modelo->setPredio($_POST['predio']);
    $modelo->setBloco($_POST['bloco']);
    $modelo->setPavimento($_POST['pavimento']);

    $post = $salasControle->AdicionarPost($modelo);
}
else
{
    $modelo = $salasControle->AdicionarGet();
}

include_once(App_CabecalhoModelo);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
                <?php
                if(isset($post) && $post)
                    echo 'Adicionado com sucesso.';
                elseif(isset($_SESSION['erro']))
                    echo $_SESSION['erro'];
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
<?php include_once(App_RodapeModelo); ?>