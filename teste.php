<?php

ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');

$dta = "2016-03-12";

function geraDataProximoMes() {
	$dateOriginal = new DateTime($dta);
	$date = new DateTime($dta);
	$newDate = $date->add(new DateInterval("P1M"));

	if( ((int)$newDate->format("m") - $dateOriginal->format("m")) > 1 ) {
		$m = ((int)$newDate->format("m")-1);

		if($m < 10)
			$m = "0".$m;

		$f = new DateTime($newDate->format("Y") . $m .'01');
		$f->modify('last day of this month');

		return $f->format('Y-m-d');
	}
	else {
		return $newDate->format('Y-m-d');
	}
}

?>