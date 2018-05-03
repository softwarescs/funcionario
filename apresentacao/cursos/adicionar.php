<?php
require_once('../_require.php');

$cursosControle = new CursosControle();

if($_POST)
{
    $modelo = new apresCursosAdicionarAlterarRemover();
    $modelo->setNome($_POST['nome']);
    $modelo->setAreaAtuacao($_POST['areaAtuacao']);

    $post = $cursosControle->AdicionarPost($modelo);
}
else
{
    $modelo = $cursosControle->AdicionarGet();
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
<?php include_once(App_RodapeModelo); ?>