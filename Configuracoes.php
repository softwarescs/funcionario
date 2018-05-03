<?php
//Configurações gerais do sistema
//Pasta raiz do sistema
if (!defined('App_DirRaiz'))
    define('App_DirRaiz', dirname(__FILE__) . '/');

//Url raiz do sistema
if (!defined('app_urlRaiz'))
    define('app_urlRaiz', '/scs/appfuncionario/');

//Url raiz apresentação do sistema
if (!defined('app_urlRaizA'))
    define('app_urlRaizA', app_urlRaiz . 'apresentacao/');

//Modelo de cabeçalho, menu e rodapé do sistema
if(!defined('App_CabecalhoModelo'))
    define('App_CabecalhoModelo', App_DirRaiz . 'apresentacao/_cabecalho.php');
if(!defined('App_RodapeModelo'))
    define('App_RodapeModelo', App_DirRaiz . 'apresentacao/_rodape.php');
if(!defined('App_MenuModelo'))
    define('App_MenuModelo', App_DirRaiz . 'apresentacao/_menu.php');

//Data/Hora
date_default_timezone_set('America/Sao_Paulo');
define('Data_Hora', date('h:i:s - d/m'));

//Banco de dados
//Host do banco de dados
define('Bd_Host', 'localhost');

//Usuário do banco de dados
define('Bd_Usuario', 'root');

//Senha do banco de dados
define('Bd_Senha', '');

//Nome do banco de dados
define('Bd_Nome', 'scs');

//API banco de dados
define('Bd_Api', App_DirRaiz . 'dados/Conexao.class.php');
?>