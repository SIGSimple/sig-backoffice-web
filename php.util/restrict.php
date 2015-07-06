<?php
	@session_start();
	function restrict() {
		if(!isset($_SESSION['user_logged']))
			header("Location: form-login?e=1001");
	}
?>