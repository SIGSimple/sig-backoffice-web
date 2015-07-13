<?php

@session_start();
if(isset($_SESSION['user_logged']))
	header('location: home');
else
	header('location: form-login');

?>