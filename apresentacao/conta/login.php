<?php
require_once('../_require.php');

$contaControle = new ContaControle();

if($_POST)
{
    $modelo = new apresContaLogin();
    $modelo->setUsuario($_POST['usuario']);
    $modelo->setSenha($_POST['senha']);

    $post = $contaControle->LoginPost($modelo);

    if($post)
        header('location: '.app_urlRaizA.'index.php');
}
else
{
    $modelo = $contaControle->LoginGet();
}

include_once(App_CabecalhoModelo);
?>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-6 bg-primary h-100">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col text-center my-auto">
                            <img src="<?=app_urlRaiz?>/wwwrot/img/logo-unip.png">
                            <h1 class=" text-white">Sistema consulta de sala</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 bg-light">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col col-lg-8 p-4 bg-white mx-auto my-auto">
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
<?php include_once(App_RodapeModelo); ?>