<?php

session_start();

$_SESSION['user_logged']['cod_colaborador'] = 109;
$_SESSION['user_logged']['num_matricula'] = '003423';
$_SESSION['user_logged']['nme_colaborador'] = 'Filipe Mendonça Coelho';
$_SESSION['user_logged']['cod_grade_horario'] = 1;
$_SESSION['user_logged']['qtd_horas_contratadas'] = 220;
$_SESSION['user_logged']['flg_hora_extra'] = 1;
$_SESSION['user_logged']['flg_trabalho_fim_semana'] = 1;

var_dump($_SESSION);

?>