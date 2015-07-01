<?php
include_once 'php.util/HttpUtil.php';
$nme_login = $_GET['nme_login'];
$nme_senha = md5($_GET['nme_senha']);
$data = HttpUtil::doGetRequest('http://'. $_SERVER['HTTP_HOST'] .'/sig-backoffice-api/usuarios?nme_login='.$nme_login.'&nme_senha='.$nme_senha, null);

if($data) {
	echo $data;
}

?>