<?php
require_once('../_require.php');

$config = new Configuracoes();
$salasControle = new SalasControle();
$modelo = $salasControle->IndexGet();

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
    <div class="container  mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
                <h2>Salas</h2>
                <p>Lista das salas cadastradas:</p>
                <a class="col-4 btn btn-secondary mb-2 float-right" href="#" onclick="javascript: window.open('adicionar.php', '', 'width=500,height=525,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 525) / 2)">Adicionar</a>
                <div class="clearfix"></div>
                <!--Nav-tabs menu-->
                <ul class="nav nav-tabs">
<?php
                    $first = true;
                    for($i = 'A'; $i != 'Z'; $i++)
                    {
                        if($modelo->salas[$i])
                        {
?>
                            <li class="nav-item">
                                <a class="nav-link <?php if($first) {echo 'active';}?>" data-toggle="tab" href="#<?=$i?>">Bloco <?=$i?></a>
                            </li>
<?php
                            $first = false;
                        }
                    }
?>
                </ul>
                <!--Nav-tabs containers-->
                <div class="tab-content">
<?php
                    $first = true;
                    for($i = 'A'; $i != 'Z'; $i++)
                    {
                        if($modelo->salas[$i])
                        {
?>
                            <div class="tab-pane <?php if($first) {echo 'active';}?> container" id="<?=$i?>">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="row">
                                            <th class="col-3" style="border-top:none !important">Nome da sala</th>
                                            <th class="col-2" style="border-top:none !important">Prédio</th>
                                            <th class="col-3" style="border-top:none !important">Pavimento</th>
                                            <th class="col-4" style="border-top:none !important">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
                                        foreach($modelo->salas[$i] as $sala)
                                        {
?>
                                            <tr class="row">
                                                <td class="col-3"><?=$sala['nome']?></td>
                                                <td class="col-2"><?=$sala['predio']?></td>
                                                <td class="col-3"><?=$sala['pavimento']?></td>
                                                <td class="col-4">
                                                    <a class="btn btn-sm btn-outline-secondary" href="#" onclick="javascript: window.open('remover.php?nome=<?=$sala['nome']?>', '', 'width=500,height=525,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 525) / 2)">Remover</a>
                                                    <a class="btn btn-sm btn-secondary" href="#" onclick="javascript: window.open('alterar.php?nome=<?=$sala['nome']?>', '', 'width=500,height=525,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 525) / 2)">Alterar</a>
                                                </td>
                                            </tr>
<?php
                                        }
?>
                                    </tbody>
                                </table>
                            </div>
<?php
                            $first = false;
                        }
                    }
?>
                </div>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>