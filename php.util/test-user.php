<?php

include_once 'HttpUtil.php';
session_start();
$_SESSION['user_logged'] = json_decode(HttpUtil::doGetRequest('http://192.168.0.12/sig-backoffice-api/colaboradores?cod_colaborador=109', null))->rows[0];
//$_SESSION['user_logged']->cod_sindicato = 8;
var_dump($_SESSION);
?>