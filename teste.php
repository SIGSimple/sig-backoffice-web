<?php

$dsc_lancamento = "Pagto. NF 13423 Teste de Mesa (1/4)";

echo $dsc_lancamento . "<br>";

$dsc_lancamento = substr($dsc_lancamento, 0, strlen($dsc_lancamento)-6) . " (2/4)";

echo $dsc_lancamento . "<br>";

$dsc_lancamento = substr($dsc_lancamento, 0, strlen($dsc_lancamento)-6) . " (3/4)";

echo $dsc_lancamento . "<br>";

$dsc_lancamento = substr($dsc_lancamento, 0, strlen($dsc_lancamento)-6) . " (4/4)";

echo $dsc_lancamento . "<br>";

?>