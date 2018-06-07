<?php
require_once('../_require.php');

$config = new Configuracoes();

if($_POST)
{
    $turmasControle = new TurmasControle();
    $modelo = $turmasControle->IndexGet($_POST['curso'], $_POST['periodo']);
}
else
{
    header('location: consultar.php');
}

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col col-lg-8 p-4 bg-white">
                <h2>Turmas</h2>
                <p>Lista das turmas cadastradas:</p>
                <div class="container-fluid">
<?php
                    if($modelo->turmas)
                    {                                                            
?>
                        <table class="table table-hover">
                            <thead>
                                <tr class="row">
                                    <th class="col-4">Curso</th>
                                    <th class="col-2">Período</th>
                                    <th class="col-2">Semestre</th>
                                    <th class="col-1">Sala</th>
                                    <th class="col-3">#</th>
                                </tr>
                            </thead>
                            <tbody>
<?php                                                    
                                foreach($modelo->turmas as $turma)
                                {
?>
                                    <tr class="row">
                                        <td class="col-4"><?=$turma['cursos_nome']?></td>
                                        <td class="col-2"><?=$turma['periodo']?></td>
                                        <td class="col-2"><?=$turma['semestre']?></td>
                                        <td class="col-1"><?=$turma['salas_nome']?></td>
                                        <td class="col-3">
                                            <a class="btn btn-sm btn-outline-secondary" href="#" onclick="javascript: window.open('remover.php?c=<?=$turma['cursos_nome']?>&p=<?=$turma['periodo']?>&s=<?=$turma['semestre']?>', '', 'width=500,height=525,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 525) / 2)">Remover</a>
                                            <a class="btn btn-sm btn-secondary" href="#" onclick="javascript: window.open('alterar.php?c=<?=$turma['cursos_nome']?>&p=<?=$turma['periodo']?>&s=<?=$turma['semestre']?>', '', 'width=500,height=525,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 525) / 2)">Alterar</a>
                                        </td>
                                    </tr>
<?php
                                }
?>
                            </tbody>
                        </table>
<?php
                    }
                    else
                    {
?>
                        <p class="text-danger">Não existem turmas desse curso em relação ao período cadastrados.</p>
<?php
                    }
?>
                </div>
                <a class="col-3 btn btn-outline-secondary" href="consultar.php">Voltar</a>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>