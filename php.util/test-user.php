<?php

session_start();

$_SESSION['user_logged']['cod_colaborador'] = 10;
$_SESSION['user_logged']['num_matricula'] = '003423';
$_SESSION['user_logged']['nme_colaborador'] = 'Filipe Coelho';
$_SESSION['user_logged']['cod_grade_horario'] = 1;
$_SESSION['user_logged']['qtd_horas_contratadas'] = 220;

var_dump($_SESSION);

?>