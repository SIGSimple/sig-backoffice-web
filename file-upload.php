<?php
	$tempDir = __DIR__ . DIRECTORY_SEPARATOR . 'temp';
	
	if (!file_exists($tempDir)) {
		mkdir($tempDir);
	}
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$chunkDir = $tempDir . DIRECTORY_SEPARATOR . $_GET['flowIdentifier'];
		$chunkFile = $chunkDir.'/chunk.part'.$_GET['flowChunkNumber'];
		if (file_exists($chunkFile)) {
			header("HTTP/1.0 200 Ok");
		} else {
			header("HTTP/1.1 204 No Content");
		}
	}

	require_once 'php.util/constants.php';
	require_once 'php.util/upload-class.php';

	header("Content-Type: application/json");

	$handler = new upload($_FILES['file']);

	if($handler->uploaded) {
		$handler->file_name_body_add   = '_' . rand();
		$handler->process(PATH_UPLOAD_FILES);
		if ($handler->processed) {
			header("HTTP/1.0 200 Ok");
			$handler->clean();
		} else {
			header("HTTP/1.0 500 Internal Server Error");
		}
	}

	echo json_encode([
		'success' => $handler->processed,
		'files' => $_FILES,
		'get' => $_GET,
		'post' => $_POST,
		//optional
		'flowTotalSize' => isset($_FILES['file']) ? $_FILES['file']['size'] : $_GET['flowTotalSize'],
		'flowIdentifier' => isset($_FILES['file']) ? $_FILES['file']['name'] . '-' . $_FILES['file']['size']: $_GET['flowIdentifier'],
		'flowFileName' => $handler->file_dst_name,
		'flowFilePath' => $handler->file_dst_pathname,
		'flowFileType' => $_FILES['file']['type'],
		'flowRelativePath' => isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : $_GET['flowRelativePath']
	]);