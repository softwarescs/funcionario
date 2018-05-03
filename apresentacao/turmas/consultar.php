<?php
require_once('../_require.php');

$turmasControle = new TurmasControle();
$modelo = $turmasControle->ConsultarGet();

include_once(App_CabecalhoModelo);
include_once(App_MenuModelo);
?>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col col-lg-6 p-4 bg-white">
                <h2>Turmas <small>/ Consultar</small></h2>
                <p>Consultar turmas cadastradas:</p>
                <form method="post" action="index.php">
                    <div class="form-group">
                        <label>Curso</label>
                        <select name="curso" class="form-control">
                            <option selected>Selecione o curso...</option>
<?php
                            if($modelo->__get('cursosBiologicas'))
                            {
                                foreach($modelo->__get('cursosBiologicas') as $m)
                                {
?>
                                    <option><?=$m['nome']?></option>
<?php
                                }
                            }
                            if($modelo->__get('cursosExatas'))
                            {
                                foreach($modelo->__get('cursosExatas') as $m)
                                {
?>
                                    <option><?=$m['nome']?></option>
<?php
                                }
                            }
                            if($modelo->__get('cursosHumanas'))
                            {
                                foreach($modelo->__get('cursosHumanas') as $m)
                                {
?>
                                    <option><?=$m['nome']?></option>
<?php
                                }
                            }
?>
                        </select>
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
<?php include_once(App_RodapeModelo); ?>