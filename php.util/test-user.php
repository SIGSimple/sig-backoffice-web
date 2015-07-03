<?php

include_once 'HttpUtil.php';
session_start();
$_SESSION['user_logged'] = json_decode(HttpUtil::doGetRequest('http://'. $_SERVER['HTTP_HOST'] .'/sig-backoffice-api/colaboradores?cod_colaborador=166', null))->rows[0];
//$_SESSION['user_logged']->cod_sindicato = 8;
var_dump($_SESSION);
?>