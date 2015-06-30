<div class="navbar-content clearfix" ng-controller="NavBarDropDownCtrl">
	<ul class="nav navbar-top-links pull-left">
		<!--Navigation toogle button-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<li class="tgl-menu-btn">
			<a class="mainnav-toggle" href="#">
				<i class="fa fa-navicon fa-lg"></i>
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
					<img class="img-circle img-user media-object" src="img/av1.png" alt="Profile Picture">
				</span>
				<div class="username hidden-xs">{{ usuario.nme_colaborador }}</div>
			</a>

			<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right with-arrow panel-default">
				<!-- User dropdown menu -->
				<ul class="head-list">
					<li>
						<a href="pages-profile.html">
							<i class="fa fa-user fa-fw fa-lg"></i> Perfil
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-gear fa-fw fa-lg"></i> Configurações
						</a>
					</li>
					<li>
						<a href="pages-lock-screen.html">
							<i class="fa fa-lock fa-fw fa-lg"></i> Bloquear
						</a>
					</li>
				</ul>

				<!-- Dropdown footer -->
				<div class="pad-all text-right">
					<a href="template-external.php?page=form-login" class="btn btn-danger">
						<i class="fa fa-sign-out fa-fw"></i> Sair
					</a>
				</div>
			</div>
		</li>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End user dropdown-->
	</ul>
</div>