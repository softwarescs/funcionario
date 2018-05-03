<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$pagina = basename($_SERVER['PHP_SELF']);

if(!isset($_SESSION['login']) && $pagina != 'login.php')
    header('location: '.app_urlRaizA.'conta/login.php');
?>
<!DOCTYPE html>
<html class="h-100">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$modelo->__get('titulo')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Principal CSS, FontAwesome CSS e Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" media="screen" href="<?=app_urlRaiz?>/wwwrot/css/site.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=app_urlRaiz?>wwwrot/lib/bootstrap/css/bootstrap.css" />
</head>
<body class="bg-light h-100">