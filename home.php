<div class="row" ng-controller="HomeCtrl">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-bg-cover">
				<img class="img-responsive" src="img/thumbs/{{ (colaborador.user.flg_sexo == 'F') ? 'img2' : (colaborador.user.flg_sexo == 'M') ? 'img1' : 'img3' }}.jpg" alt="Image">
			</div>
			<div class="panel-media">
				<img src="img/{{ (colaborador.user.flg_sexo == 'F') ? 'av6' : (colaborador.user.flg_sexo == 'M') ? 'av2' : 'av3' }}.png" class="panel-media-img img-circle img-border-light" alt="Profile Picture">
				<div class="row">
					<div class="col-lg-7">
						<h3 class="panel-media-heading">{{ colaborador.user.nme_usuario }}</h3>
						<!-- <a href="#" class="btn-link">@stephen_doe</a> -->
						<p class="text-muted mar-btm">{{ (colaborador.cooperator != null) ? colaborador.cooperator.funcao.nme_funcao : colaborador.user.nme_perfil }}</p>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<h4>Seja bem-vindo(a)!</h4>
				Para utilizar o sistema, navegue através do menu lateral.
			</div>
		</div>
	</div>
</div>