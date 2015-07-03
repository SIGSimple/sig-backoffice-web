<?php

if(file_exists($_GET['file-path'])) {
	unlink($_GET['file-path']);
	header("HTTP/1.0 200 Ok");
	echo "Arquivo excluído com sucesso!";
}
else {
	header("HTTP/1.0 404 Not Found");
	echo "Arquivo não encontrado!";
}