<?php
require_once('../_require.php');

$config = new Configuracoes();
$contaControle = new ContaControle();

session_start();

if($_POST)
{
    if(isset($_SESSION['usuario']))
    {
        $modelo = new apresContaIndex();

        if(isset($_POST['nome']))
        {
            $modelo->usuario = $_POST['usuario'];
            $modelo->nome = $_POST['nome'];
            $modelo->email = $_POST['email'];
            
            $post = $contaControle->IndexPost($modelo);
        }
        else
        {
            $modelo->usuario = $_SESSION['usuario'];
            $modelo->senha = $_POST['senha'];
            $modelo->novaSenha = $_POST['novaSenha'];
            $modelo->novaSenhaNovamente = $_POST['novaSenhaNovamente'];
            
            $post = $contaControle->IndexSenhaPost($modelo);
        }
    }
}

if(isset($_SESSION['usuario']))
{
    $modelo = $contaControle->IndexGet($_SESSION['usuario']);
}

include_once($config->getCabecalho());
include_once($config->getMenu());
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
                {
?>
                    <p class="text-success">
                        <i class="fas fa-check mr-2"></i>
                        Alterado com sucesso.
                    </p>
<?php
                }
                elseif(isset($post) && !$post)
                {
?>
                    <p class="text-danger">
                        <i class="fas fa-exclamation mr-2"></i>
                        <?=$contaControle->getMensagem()?>
                    </p>
<?php
                }
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
                                    value="<?=$modelo->usuario?>"
                                    class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="nome"
                                    value="<?=$modelo->nome?>"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email"
                                    value="<?=$modelo->email?>"
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
<?php include_once($config->getRodape()); ?>