<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<!-- Classic Form Wizard -->
			<!--===================================================-->
			<div id="demo-cls-wz">
				<!--Nav-->
				<ul class="wz-nav-off wz-icon-inline">
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab1">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-info"></i></span> Dados Cadastrais
						</a>
					</li>
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab2">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-user"></i></span> Dados Físicos
						</a>
					</li>
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab3">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-home"></i></span> Histórico
						</a>
					</li>
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab4">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-heart"></i></span> Documentos
						</a>
					</li>
				</ul>

				<!--Progress bar-->
				<div class="progress progress-sm progress-striped active">
					<div class="progress-bar progress-bar-success"></div>
				</div>

				<!--Form-->
				<form class="form-horizontal mar-top">
					<div class="panel-body">
						<div class="tab-content">
							<!--First tab-->
							<div id="demo-cls-tab1" class="tab-pane">
								<div class="form-group">
									<label class="col-lg-3 control-label">Nome</label>
									<div class="col-lg-7">
										<input type="text" class="form-control" name="nme_login" placeholder="Nome">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">CEP</label>
									<div class="col-lg-2">
										<input type="text" class="form-control" name="end_email" placeholder="CEP">
									</div>

									<label class="col-lg-1 control-label">Endereço</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="end_email" placeholder="Endereço">
									</div>
								</div>
							</div>

							<!--Second tab-->
							<div id="demo-cls-tab2" class="tab-pane fade">
								<div class="form-group">
									<label class="col-lg-3 control-label">Nome Completo</label>
									<div class="col-lg-7">
										<input type="text" placeholder="Nome Completo" name="nme_colaborador" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Last name</label>
									<div class="col-lg-7">
										<input type="text" placeholder="Last name" name="lastName" class="form-control">
									</div>
								</div>
							</div>

							<!--Third tab-->
							<div id="demo-cls-tab3" class="tab-pane">
								<div class="form-group">
									<label class="col-lg-3 control-label">Address</label>
									<div class="col-lg-7">
										<input type="text" placeholder="Address" name="address" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">City</label>
									<div class="col-lg-7">
										<input type="text" placeholder="City" name="city" class="form-control">
									</div>
								</div>
							</div>

							<!--Fourth tab-->
							<div id="demo-cls-tab4" class="tab-pane mar-btm">
								<h4>Thank you</h4>
								<p class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
							</div>
						</div>
					</div>

					<!--Footer button-->
					<div class="panel-footer text-right">
						<div class="box-inline">
							<button type="button" class="previous btn btn-success">Voltar</button>
							<button type="button" class="next btn btn-success">Avançar</button>
							<button type="button" class="finish btn btn-success" disabled>Finalizar</button>
						</div>
					</div>
				</form>
			</div>
			<!--===================================================-->
			<!-- End Classic Form Wizard -->
		</div>
	</div>
</div>