<?php

require_once 'php.util/constants.php';

$prefixNameToFind 	= $_GET['prefixName'];
$filesDirectory 	= dir(PATH_UPLOAD_FILES);

while($file = $filesDirectory->read()) {
	if($file === '.' || $file === '..'){
		// Do anything else
	}
	else{
		$indexOfUnderscore 	= strpos($file, "_");
		$filenamePrefix 	= substr($file, 0, $indexOfUnderscore);
		if($filenamePrefix === $prefixNameToFind)
			unlink(PATH_UPLOAD_FILES.$file);
	}
}

$filesDirectory->close();

?>