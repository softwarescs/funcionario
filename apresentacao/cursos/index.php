<?php
require_once('../_require.php');

$config = new Configuracoes();
$cursosControle = new CursosControle();
$modelo = $cursosControle->IndexGet();

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
                <h2>Cursos</h2>
                <p>Lista dos cursos cadastrados:</p>
                <a class="col-4 btn btn-secondary mb-2 float-right" href="#" onclick="javascript: window.open('adicionar.php', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Adicionar</a>
                <div class="clearfix"></div>
                <!--Nav-tabs menu-->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#biologicas">Biológicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#exatas">Exatas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#humanas">Humanas</a>
                    </li>
                </ul>
                <!--Nav-tabs containers-->
                <div class="tab-content">
                    <div class="tab-pane active container-fluid" id="biologicas">
<?php
                        if($modelo->cursos['Biologicas'])
                        {
?>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-8" style="border-top:none !important">Nome do curso</th>
                                        <th class="col-4" style="border-top:none !important">#</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach($modelo->cursos['Biologicas'] as $curso)
                                    {
?>
                                        <tr class="row">
                                            <td class="col-8"><?=$curso['nome']?></td>
                                            <td class="col-4">
                                                <a class="btn btn-sm btn-outline-secondary" href="#" onclick="javascript: window.open('remover.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Remover</a>
                                                <a class="btn btn-sm btn-secondary" href="#" onclick="javascript: window.open('alterar.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Alterar</a>
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
                            <p class="text-danger mt-2">Não existem cursos da área de Biológicas cadastrados.</p>
<?php
                        }
?>
                    </div>
                    <div class="tab-pane container-fluid" id="exatas">
<?php
                        if($modelo->cursos['Exatas'])
                        {
?>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-8" style="border-top:none !important">Nome do curso</th>
                                        <th class="col-4" style="border-top:none !important">#</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach($modelo->cursos['Exatas'] as $curso)
                                    {
?>
                                        <tr class="row">
                                            <td class="col-8"><?=$curso['nome']?></td>
                                            <td class="col-4">
                                                <a class="btn btn-sm btn-outline-secondary" href="#" onclick="javascript: window.open('remover.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Remover</a>
                                                <a class="btn btn-sm btn-secondary" href="#" onclick="javascript: window.open('alterar.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Alterar</a>
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
                            <p class="text-danger mt-2">Não existem cursos da área de Exatas cadastrados.</p>
<?php
                        }
?>
                    </div>
                    <div class="tab-pane container-fluid" id="humanas">
<?php
                        if($modelo->cursos['Humanas'])
                        {
?>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-8" style="border-top:none !important">Nome do curso</th>
                                        <th class="col-4" style="border-top:none !important">#</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach($modelo->cursos['Humanas'] as $curso)
                                    {
?>
                                        <tr class="row">
                                            <td class="col-8"><?=$curso['nome']?></td>
                                            <td class="col-4">
                                                <a class="btn btn-sm btn-outline-secondary" href="#" onclick="javascript: window.open('remover.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Remover</a>
                                                <a class="btn btn-sm btn-secondary" href="#" onclick="javascript: window.open('alterar.php?nome=<?=$curso['nome']?>', '', 'width=500,height=355,left=' + (document.documentElement.clientWidth - 500) / 2 + ',top=' + (document.documentElement.clientHeight - 355) / 2)">Alterar</a>
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
                            <p class="text-danger mt-2">Não existem cursos da área de Humanas cadastrados.</p>
<?php
                        }
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>