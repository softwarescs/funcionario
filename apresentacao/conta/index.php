<?php
require_once('../_require.php');

$contaControle = new ContaControle();

session_start();

if($_POST)
{
    if(isset($_SESSION['usuario']))
    {
        $modelo = new apresContaIndex();

        if(isset($_POST['nome']))
        {
            $modelo->setUsuario($_POST['usuario']);
            $modelo->setNome($_POST['nome']);
            $modelo->setEmail($_POST['email']);
        }
        else
        {
            $modelo->setUsuario($_SESSION['usuario']);
            $modelo->setSenha($_POST['senha']);
            $modelo->setNovaSenha($_POST['novaSenha']);
            $modelo->setNovaSenhaNovamente($_POST['novaSenhaNovamente']);
        }

        $post = $contaControle->IndexPost($modelo);
    }
}
else
{
    if(isset($_SESSION['usuario']))
        $modelo = $contaControle->IndexGet($_SESSION['usuario']);
}

include_once(App_CabecalhoModelo);
include_once(App_MenuModelo);
?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-3 mr-2">
                <!-- Nav-pills menu -->
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#inicio">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#alterarSenha">Alterar senha</a>
                    </li>
                </ul>
            </div>
            <div class="col-8 col-lg-6 p-4 bg-white">
                <?php
                if(isset($post) && $post)
                    echo 'Alterado com sucesso.';
                elseif(isset($_SESSION['erro']))
                    echo $_SESSION['erro'];
                ?>
                <!-- Nav-pills containers -->
                <div class="tab-content">
                    <div class="tab-pane active" id="inicio">
                        <h2>Conta</h2>
                        <p>Alterar informações da conta:</p>
                        <form method="post" action="index.php">
                            <div class="form-group">
                                <label>Usuário</label>
                                <input type="text" name="usuario"
                                    value="<?=$modelo->__get('usuario')?>"
                                    class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="nome"
                                    value="<?=$modelo->__get('nome')?>"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email"
                                    value="<?=$modelo->__get('email')?>"
                                    class="form-control" />
                            </div>
                            <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Salvar</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="alterarSenha">
                        <h2>Conta <small>/ Alterar senha</small></h2>
                        <p>Alterar senha da conta:</p>
                        <form method="post" action="index.php">
                            <div class="form-group">
                                <label>Senha atual<span class="text-warning">*</span></label>
                                <input type="password" name="senha" class="form-control" placeholder="Digite sua senha atual...">
                            </div>
                            <div class="form-group">
                                <label>Nova senha<span class="text-warning">*</span></label>
                                <input type="password" name="novaSenha" class="form-control" placeholder="Digite sua nova senha...">
                            </div>
                            <div class="form-group">
                                <label>Nova senha novamente<span class="text-warning">*</span></label>
                                <input type="password" name="novaSenhaNovamente" class="form-control" placeholder="Digite novamente sua nova senha...">
                            </div>
                            <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once(App_RodapeModelo); ?>