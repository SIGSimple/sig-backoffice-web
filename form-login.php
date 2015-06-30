<?php

session_start();
unset($_SESSION['user_logged']);

?>
<!-- LOGIN FORM -->
<!--===================================================-->
<div class="cls-content-sm panel">
	<div class="panel-body">
		<p class="pad-btm">Entre com seus dados</p>
		<form action="index.html">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<input type="text" class="form-control" placeholder="usuário">
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
					<input type="password" class="form-control" placeholder="Senha">
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8 text-left checkbox">
					<label class="form-checkbox form-icon">
					<input type="checkbox"> Lembrar-me
					</label>
				</div>
				<div class="col-xs-4">
					<div class="form-group text-right">
					<button class="btn btn-success text-uppercase" type="submit">Entrar</button>
					</div>
				</div>
			</div>

			<!-- <div class="mar-btm"><em>- ou -</em></div>
			<button class="btn btn-primary btn-lg btn-block" type="button">
				<i class="fa fa-facebook fa-fw"></i> Entrar com Facebook
			</button> -->
		</form>
	</div>
</div>

<div class="pad-ver">
	<a href="pages-password-reminder.html" class="btn-link mar-rgt">Esqueceu sua senha ?</a>
	<a href="pages-register.html" class="btn-link mar-lft">Criar uma nova conta</a>
</div>
<!--===================================================-->