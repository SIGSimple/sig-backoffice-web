<?php

header('Content-Type: '. $_GET['file-type']);
header('Content-Disposition: attachment; filename='. $_GET['file-name']);
header('Pragma: no-cache');
readfile($_GET['file-path']);

?>