<?php
require_once('_require.php');

$config = new Configuracoes();
$indexControle = new InicioControle();
$modelo = $indexControle->IndexGet();

$turmas = $modelo->turmas;
$ultTurma = end($turmas);
$penulTurma = prev($turmas);
$antepenulTurma = prev($turmas);

$salas = $modelo->salas;
$ultSala = end($salas);
$penulSala = prev($salas);
$antepenulSala = prev($salas);

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col col-lg-8 p-4 bg-white">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-6">
                        <h2>Turmas</h2>
                    </div>
                    <div class="col-6 pt-3 text-right">
                        <a class="" href="./turmas/consultar.php">Ver todas...</a>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-8">
                        <h5 class="">Últimas turmas cadastradas:</h5>
                        <div class="container">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-6 text-muted" style="border-top:none !important">Curso</th>
                                        <th class="col-2 text-muted" style="border-top:none !important">Período</th>
                                        <th class="col-2 text-muted" style="border-top:none !important">Semestre</th>
                                        <th class="col-2 text-muted" style="border-top:none !important">Sala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row">
                                        <td class="col-6">
                                            <?=$ultTurma['cursos_nome']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$ultTurma['periodo']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$ultTurma['semestre']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$ultTurma['salas_nome']?>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-6">
                                            <?=$penulTurma['cursos_nome']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$penulTurma['periodo']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$penulTurma['semestre']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$penulTurma['salas_nome']?>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-6">
                                            <?=$antepenulTurma['cursos_nome']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$antepenulTurma['periodo']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$antepenulTurma['semestre']?>
                                        </td>
                                        <td class="col-2">
                                            <?=$antepenulTurma['salas_nome']?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h6>Turmas cadastradas:</h6>
                            </div>
                            <div class="card-body bg-secondary text-center text-white pt-5 pb-4">
                                <h2>
                                    <?=count($turmas)?>
                                </h2>
                            </div>
                            <div class="card-footer text-muted">
                                <i class="far fa-clock"></i> <?=$config->getDataHora()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0 mt-4">
                <div class="row">
                    <div class="col-6">
                        <h2>Cursos</h2>
                    </div>
                    <div class="col-6 pt-3 text-right">
                        <a class="" href="./cursos/index.php">Ver todos...</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5>Cursos cadastrados:</h5>
                            </div>
                            <div class="card-body bg-secondary text-center text-white pt-5 pb-5">
                                <h2>
                                    <?=count($modelo->cursos['Biologicas'])+ count($modelo->cursos['Exatas']) + count($modelo->cursos['Humanas'])?>
                                </h2>
                            </div>
                            <div class="card-footer text-muted">
                                <i class="far fa-clock"></i> <?=$config->getDataHora()?>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <h5 class="">Últimos cursos cadastrados p/ área:</h5>
                        <div class="container">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-7 text-muted" style="border-top:none !important">Nome do curso</th>
                                        <th class="col-5 text-muted" style="border-top:none !important">Área de atuação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row">
                                        <td class="col-7">
                                            <?=end($modelo->cursos['Biologicas'])['nome']?>
                                        </td>
                                        <td class="col-5">Biológicas</td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-7">
                                            <?=end($modelo->cursos['Exatas'])['nome']?>
                                        </td>
                                        <td class="col-5">Exatas</td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-7">
                                            <?=end($modelo->cursos['Humanas'])['nome']?>
                                        </td>
                                        <td class="col-5">Humanas</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0 mt-4">
                <div class="row">
                    <div class="col-6">
                        <h2>Salas</h2>
                    </div>
                    <div class="col-6 pt-3 text-right">
                        <a class="" href="./salas/index.php">Ver todas...</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <h5 class="">Últimas salas cadastradas:</h5>
                        <div class="container">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="row">
                                        <th class="col-3 text-muted" style="border-top:none !important">Nome</th>
                                        <th class="col-3 text-muted" style="border-top:none !important">Prédio</th>
                                        <th class="col-3 text-muted" style="border-top:none !important">Bloco</th>
                                        <th class="col-3 text-muted" style="border-top:none !important">Pavimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row">
                                        <td class="col-3">
                                            <?=$ultSala['nome']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$ultSala['predio']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$ultSala['bloco']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$ultSala['pavimento']?>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <?=$penulSala['nome']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$penulSala['predio']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$penulSala['bloco']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$penulSala['pavimento']?>
                                        </td>
                                    </tr>
                                    <tr class="row">
                                        <td class="col-3">
                                            <?=$antepenulSala['nome']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$antepenulSala['predio']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$antepenulSala['bloco']?>
                                        </td>
                                        <td class="col-3">
                                            <?=$antepenulSala['pavimento']?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5>Salas cadastradas:</h5>
                            </div>
                            <div class="card-body bg-secondary text-center text-white pt-5 pb-4">
                                <h2>
                                    <?=count($salas)?>
                                </h2>
                            </div>
                            <div class="card-footer text-muted">
                                <i class="far fa-clock"></i> <?=$config->getDataHora()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once($config->getRodape()); ?>