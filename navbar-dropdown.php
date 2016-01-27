<div class="navbar-content clearfix" ng-controller="NavBarDropDownCtrl">
	<ul class="nav navbar-top-links pull-left">
		<!--Navigation toogle button-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<li class="tgl-menu-btn">
			<a class="mainnav-toggle" href="#">
				<i class="fa fa-navicon fa-lg"></i>
			</a>
		</li>

		<li>
			<a href="home">
				<i class="fa fa-home fa-lg"></i>
			</a>
		</li>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End Navigation toogle button-->
	</ul>

	<ul class="nav navbar-top-links pull-right">
		<!--User dropdown-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<li id="dropdown-user" class="dropdown">
			<a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
				<span class="pull-right">
					<img class="img-circle img-user media-object" src="{{ (usuario.user.pth_arquivo_foto) ? usuario.user.pth_arquivo_foto : (usuario.user.cod_perfil === 1) ? 'img/av3.png' : (usuario.user.flg_sexo == 'F') ? 'img/av6.png' : (usuario.user.flg_sexo == 'M') ? 'img/av2.png' : 'img/av3.png' }}" alt="Profile Picture">
				</span>
				<div class="username hidden-xs">{{ getFirstAndLastName(usuario.user.nme_usuario) }}</div>
			</a>

			<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right with-arrow panel-default">
				<!-- User dropdown menu -->
				<ul class="head-list">
					<li>
						<a href="#">
							<i class="fa fa-user fa-fw fa-lg"></i> {{ getFirstAndLastName(usuario.user.nme_usuario) }}
						</a>
					</li>
				</ul>

				<!-- Dropdown footer -->
				<div class="pad-all text-right">
					<a href="form-login" class="btn btn-danger btn-block">
						<i class="fa fa-sign-out fa-fw"></i> Sair
					</a>
				</div>
			</div>
		</li>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End user dropdown-->
	</ul>
</div>