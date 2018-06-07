<?php
require_once('../_require.php');

$backup = new Backup();
$backup->AdicionarBkpDadosTabelas();

session_start();
session_unset();
session_destroy();
header('location: login.php');