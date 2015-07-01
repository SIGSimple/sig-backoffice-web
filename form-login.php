<?php

session_start();
unset($_SESSION['user_logged']);

?>
<!-- LOGIN FORM -->
<!--===================================================-->
<div class="{{ (users.length === 0) ? 'cls-content-sm' : 'cls-content-lg' }} panel" ng-controller="LoginCtrl" style="{{ (users.length > 0) ? 'background-color: #F9F9F9;' : '' }}">
	<div class="panel-body" ng-show="users.length === 0">
		<p class="pad-btm">Entre com seus dados</p>

		<form class="form" role="form">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<input type="text" class="form-control" placeholder="usuário" ng-model="dadosLogin.nme_login">
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
					<input type="password" class="form-control" placeholder="Senha" ng-model="dadosLogin.nme_senha">
				</div>
			</div>

			<div class="row">
				
				<div class="col-xs-offset-8 col-xs-4">
					<div class="form-group text-right">
					<button class="btn btn-success text-uppercase" type="submit" ng-click="login()">Entrar</button>
					</div>
				</div>
			</div>

			<div class="row">
				<p class="text-danger">{{ errorMessage }}</p>
			</div>
		</form>
	</div>

	<div class="panel-body" ng-show="users.length > 0">
		<p class="pad-btm"><i class="fa fa-user"></i> Selecione o perfil que deseja utilizar</p>

		<div class="row">
			<div class="col-lg-4" ng-repeat="user in users">
				<div class="panel widget">
					<div class="widget-header bg-{{ (user.flg_sexo == 'F') ? 'pink' : (user.flg_sexo == 'M') ? 'primary' : 'success' }} no-image"></div>
					<div class="widget-body text-center">
						<img class="widget-img img-border img-circle" src="img/{{ (user.flg_sexo == 'F') ? 'av6' : (user.flg_sexo == 'M') ? 'av2' : 'av3' }}.png"></img>
						<h4 class="mar-no">{{ getFirstAndLastName(user.nme_usuario) }}</h4>
						<p class="text-muted mar-btm">{{ user.nme_perfil }}</p>
						<h5 class="text-muted mar-btm text-bold">{{ user.nme_empreendimento }}</h5>
						<div class="pad-ver">
							<button class="btn btn-{{ (user.flg_sexo == 'F') ? 'pink' : 'primary' }}">Utilizar este perfil</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-footer clearfix" ng-show="users.length > 0">
		<div class="pull-right">
			<button type="button" class="btn btn-default" ng-click="cancelLogin()">Cancelar</button>
		</div>
	</div>
</div>
<!--===================================================-->