<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container" ng-controller="MenuCtrl">
	<div id="mainnav">
		<!--Menu-->
		<!--================================-->
		<div id="mainnav-menu-wrap">
			<div class="nano">
				<div class="nano-content">
					<ul id="mainnav-menu" class="list-group">						
						<!--[ Gerenciamento ]-->
						<li class="list-header">Gerenciamento & Controle</li>

						<!--Contratos-->
						<li>
							<a href="#">
								<i class="fa fa-copy"></i>
								<span class="menu-title">Contratos</span>
								<i class="arrow"></i>
							</a>
			
							<!--Submenu-->
							<ul class="collapse">
								<li><a href="#">Cadastro</a></li>
								<li><a href="#">Consulta</a></li>
								<li><a href="#">Planejamento/Medições</a></li>
							</ul>
						</li>

						<!--[ Recursos Humanos ]-->
						<li class="list-header">Recursos Humanos</li>
			
						<!--Colaboradores-->
						<li class="active-sub">
							<a href="#">
								<i class="fa fa-users"></i>
								<span class="menu-title">Colaboradores</span>
								<i class="arrow"></i>
							</a>
			
							<!--Submenu-->
							<ul class="collapse in">
								<li><a href="#">Cadastro</a></li>
								<li class="active-link"><a href="#">Consulta</a></li>
								<li><a href="#">Movimentação</a></li>
							</ul>
						</li>

						<!--Tabelas Auxiliares-->
						<li>
							<a href="#">
								<i class="fa fa-list"></i>
								<span class="menu-title">Tabelas Auxiliares</span>
								<i class="arrow"></i>
							</a>
			
							<!--Submenu-->
							<ul class="collapse">
								<li><a href="#">Tabela INSS</a></li>
								<li><a href="#">Tabela IRPF</a></li>
								<li><a href="#">Locais de Trabalho</a></li>
								<li><a href="#">Grades de Horário</a></li>
								<li><a href="#">Sindicatos</a></li>
								<li><a href="#">Departamentos</a></li>
								<li><a href="#">Regimes de Contratação</a></li>
								<li><a href="#">Entidades</a></li>
								<li><a href="#">Funções</a></li>
								<li><a href="#">Planos de Saúde</a></li>
								<li><a href="#">Origens</a></li>
							</ul>
						</li>
			
						<li class="list-divider"></li>

						<!--[ Geral ]-->
						<li class="list-header">Geral</li>
			
						<!--Empresas-->
						<li>
							<a href="index.html">
								<i class="fa fa-university"></i>
								<span class="menu-title">Empresas</span>
							</a>
						</li>

						<!--Empreendimentos-->
						<li>
							<a href="index.html">
								<i class="fa fa-building"></i>
								<span class="menu-title">Empreendimentos</span>
							</a>
						</li>

						<!--Usuários-->
						<li>
							<a href="index.html">
								<i class="fa fa-user-secret"></i>
								<span class="menu-title">Usuários</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--================================-->
		<!--End menu-->
	</div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->