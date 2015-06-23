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
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-user"></i></span> Informações Complementares
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

							<div id="demo-cls-tab1" class="tab-pane fade">
								<form class="form form-horizontal">
									<fieldset>
										<legend>Informações Básicas</legend>
										
										<div class="form-group">
											<label class="col-lg-3 control-label">Matrícula</label> 
											<div class="col-lg-1">
												<input type="text" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">Nome</label>
											<div class="col-lg-6">
												<input type="text" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">Data de Nascimento</label>
											<div class="col-lg-2">
												<div class="input-group date">
													<input type="text" class="form-control">
													<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
												</div>
											</div>
											
											<label class="col-lg-2 control-label">Sexo</label>
											<div class="col-lg-2">
												<select class="form-control">
													<option value=""></option>
													<option value="M">Masculino</option>
													<option value="F">Feminino</option>
												</select>
											</div>
										</div>							
											
										<div class="form-group">
											<label class="col-lg-3 control-label">Sindicato</label>
											<div class="col-lg-2">
												<select class="form-control">
												</select>
											</div>
											<label class="col-lg-2 control-label">Horas Contratadas</label>
											<div class="col-lg-2">
												<input type="text" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">Data de Admissão</label>
											<div class="col-lg-2">
												<div class="input-group date">
													<input type="text" class="form-control">
													<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
												</div>
											</div>
											<label class="col-lg-2 control-label">Data de Demissão</label>
											<div class="col-lg-2">
												<div class="input-group date">
													<input type="text" class="form-control">
													<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label sr-only"></label>
											<div class="col-lg-3">
												<input type="checkbox" class="input-switch">
												Portador Necessidades Especiais?
											</div>
											
											<div class="col-lg-2">
												<input type="checkbox" class="input-switch">
												C/M?
											</div>

											<div class="col-lg-1">
												<input type="checkbox" class="input-switch">
												Ativo
											</div>
										</div>
									</fieldset>

									<fieldset>
										<legend>Moradia</legend>

										<div class="form-group">
											<label class="col-lg-3 control-label">CEP</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
											<label class="col-lg-1 control-label">Endereço</label>
											<div class="col-lg-4">
												<input type="text" class="form-control"> 
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-lg-3 control-label">Número</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
											<label class="col-lg-1 control-label">Complemento</label>
											<div class="col-lg-4">
												<input type="text" class="form-control"> 
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">Bairro</label>
											<div class="col-lg-4">
												<input type="text" class="form-control"> 
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">UF</label>
											<div class="col-lg-1">
												<select class="form-control">
												</select>
											</div>
											<label class="col-lg-1 control-label">Cidade</label>
											<div class="col-lg-2">
												<select class="form-control">
												</select>
											</div>
										</div>
									</fieldset>

									<fieldset>
										<legend>Naturalidade</legend>
										
										<div class="form-group">
											<label class="col-lg-3 control-label">Estado</label>
											<div class="col-lg-1">
												<select class="form-control">
												</select>
											</div>

											<label class="col-lg-1 control-label">Cidade</label>
											<div class="col-lg-2">
												<select class="form-control">
												</select>
											</div>
										</div>
									</fieldset>

									<fieldset>
										<legend>Dados bancários</legend>

										<div class="form-group">
											<label class="col-lg-3 control-label">Banco</label>
											<div class="col-lg-4">
												<select class="form-control">
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-lg-3 control-label">Agência</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
											<label class="col-lg-1 control-label">Dígito</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-lg-3 control-label">Conta Corrente</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
											<label class="col-lg-1 control-label">Dígito</label>
											<div class="col-lg-1">
												<input type="text" class="form-control"> 
											</div>
										</div>
									</fieldset>
								</form>
							</div>


					
							<!--Second tab-->
							<div id="demo-cls-tab2" class="tab-pane fade">
								<form class="form form-horizontal">
							<div class="form-group">
								<label class="col-lg-3 control-label">Empresa Contratante</label> 
								<div class="col-lg-4">
									<select class="form-control">
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-3 control-label">Contrato</label>
								<div class="col-lg-2">
									<select class="form-control">
									</select>
								</div>
								<label class="col-lg-3 control-label">Regime de Contratação</label>
								<div class="col-lg-2">
									<select class="form-control">
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">Local de Trabalho</label>
								<div class="col-lg-2">
									<select class="form-control">
									</select>
								</div>
								<label class="col-lg-3 control-label">Departamento</label>
								<div class="col-lg-2">
									<select class="form-control">
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">Grade de Horário</label>
								<div class="col-lg-2">
									<select class="form-control">
									</select>
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