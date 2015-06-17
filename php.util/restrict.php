<?php

	@session_start();
	
	function restrict($skills = array()) {
		if(isset($_SESSION['user_logged'])) {
			if(!in_array($_SESSION['user_logged']['cod_perfil'], $skills) && count($skills) > 0) {
				if($_SESSION['user_logged']['cod_perfil'] == 1)
					header("Location: template-internal.php?page=inicio-adm");
				else
					header("Location: template-internal.php?page=inicio-usuario");
			}
			else
				header("Location: template-external.php?page=form-login");
		}
	}

?>