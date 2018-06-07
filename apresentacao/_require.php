<?php
require_once(dirname(dirname(__FILE__)).'/Configuracoes.php');

spl_autoload_register(function ($classe)
{
    $config = new Configuracoes();
    $diretorios = array(
        $config->getDiretorio().'controle/',
        $config->getDiretorio().'dados/',
        $config->getDiretorio().'modelo/',
        $config->getDiretorio().'modelo/conta/',
        $config->getDiretorio().'modelo/cursos/',
        $config->getDiretorio().'modelo/salas/',
        $config->getDiretorio().'modelo/turmas/'
    );

    foreach($diretorios as $d)
    {
        if(file_exists($d.$classe.'.class.php'))
            require_once($d.$classe.'.class.php');

    }
});
?>