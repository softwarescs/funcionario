<?php
require_once('../_require.php');

$backup = new Backup();
$abrirConexao = $backup->AbrirConexao();
$abrirBd = $backup->AbrirBd();
if(!empty($abrirConexao) && empty($abrirBd))
{
    $backup->RestaurarBd();
    $backup->RestaurarBkpDadosTabelas();
}

$config = new Configuracoes();
$contaControle = new ContaControle();

if($_POST)
{
    $modelo = new apresContaLogin();
    $modelo->usuario = $_POST['usuario'];
    $modelo->senha = $_POST['senha'];

    $post = $contaControle->LoginPost($modelo);

    if($post)
    {
        header('location: '.$config->getUrlApres().'index.php');
    }
}

$modelo = $contaControle->LoginGet();

include_once($config->getCabecalho());
?>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-6 bg-primary h-100">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col text-center my-auto">
                            <img src="<?=$config->getUrl()?>/wwwrot/img/logo-unip.png">
                            <h1 class=" text-white">Sistema consulta de sala</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 bg-light">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col col-lg-8 p-4 bg-white mx-auto my-auto">
<?php
                            if(isset($post) && !$post)
                            {
?>
                                <p class="text-danger">
                                    <i class="fas fa-exclamation mr-2"></i>
                                    <?=$contaControle->getMensagem()?>
                                </p>
<?php
                            }
?>
                            <h2>Conta <small>/ Login</small></h2>
                            <p>Fazer login no sistema:</p>
                            <form method="post" action="login.php">
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input type="text" name="usuario" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" name="senha" class="form-control">
                                </div>
                                <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Entrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>