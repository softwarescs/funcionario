<?php
require_once(dirname(dirname(__FILE__)).'/Configuracoes.php');

spl_autoload_register(function ($classe)
{
    $diretorios = array(
        App_DirRaiz.'controle/',
        App_DirRaiz.'dados/',
        App_DirRaiz.'modelo/',
        App_DirRaiz.'modelo/conta/',
        App_DirRaiz.'modelo/cursos/',
        App_DirRaiz.'modelo/index/',
        App_DirRaiz.'modelo/salas/',
        App_DirRaiz.'modelo/turmas/'
    );

    foreach($diretorios as $d)
    {
        if(file_exists($d.$classe.'.class.php'))
            require_once($d.$classe.'.class.php');

    }
});
?>