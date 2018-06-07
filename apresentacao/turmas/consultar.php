<?php
require_once('../_require.php');

$config = new Configuracoes();
$turmasControle = new TurmasControle();
$modelo = $turmasControle->ConsultarGet();

include_once($config->getCabecalho());
include_once($config->getMenu());
?>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col col-lg-6 p-4 bg-white">
                <h2>Turmas <small>/ Consultar</small></h2>
                <p>Consultar turmas cadastradas:</p>
                <form method="post" action="index.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso" class="form-control">
                            <option selected>Selecione o curso...</option>
<?php
                            foreach($modelo->cursos as $cursos)
                            {
                                foreach($cursos as $curso)
                                {
?>
                                    <option><?=$curso['nome']?></option>
<?php
                                }
                            }
?>                        </select>
                    </div>
                    <div class="form-group">
                        <label>Período</label>
                        <select name="periodo" class="form-control">
                            <option selected>Selecione o período...</option>
                            <option>Manhã</option>
                            <option>Noite</option>
                            <option>Integral</option>
                        </select>
                    </div>
                    <button type="submit" class="col-4 btn btn-secondary mb-2 float-right">Consultar</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once($config->getRodape()); ?>