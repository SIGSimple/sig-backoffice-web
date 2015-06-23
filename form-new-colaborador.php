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
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-list-alt"></i></span> Informações Complementares
						</a>
					</li>
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab3">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-institution"></i></span> Dados Bancários
						</a>
					</li>
					<li class="col-xs-3 bg-info">
						<a data-toggle="tab" href="#demo-cls-tab4">
							<span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="fa fa-paperclip"></i></span> Documentos/Anexos
						</a>
					</li>
				</ul>

				<!--Progress bar-->
				<div class="progress progress-sm progress-striped active">
					<div class="progress-bar progress-bar-success"></div>
				</div>

				<!--Form-->
				<form class="form-horizontal">
					<div class="panel-body" style="padding-top: 10px;">
						<div class="tab-content">
							<!--First tab-->
							<div id="demo-cls-tab1" class="tab-pane fade">
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
										<label class="col-lg-3 control-label">Portador Necessidades Especiais?</label>
										<div class="col-lg-1">
											<input type="checkbox" class="input-switch">
										</div>
										
										<label class="col-lg-1 control-label">C/M?</label>
										<div class="col-lg-1">
											<input type="checkbox" class="input-switch">
										</div>

										<label class="col-lg-1 control-label">Ativo?</label>
										<div class="col-lg-1">
											<input type="checkbox" class="input-switch">
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
							</div>
					
							<!--Second tab-->
							<div id="demo-cls-tab2" class="tab-pane fade">
								<div class="form-group">
									<label class="col-lg-3 control-label">Empresa Contratante</label> 
									<div class="col-lg-4">
										<select class="form-control">
										</select>
									</div>

									<label class="col-lg-2 control-label">Regime de Contratação</label>
									<div class="col-lg-1">
										<select class="form-control">
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Local de Trabalho</label>
									<div class="col-lg-3">
										<select class="form-control">
										</select>
									</div>

									<label class="col-lg-3 control-label">Departamento</label>
									<div class="col-lg-1">
										<select class="form-control">
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Contrato</label>
									<div class="col-lg-3">
										<select class="form-control">
										</select>
									</div>
									
									<label class="col-lg-2 control-label">Grade de Horário</label>
									<div class="col-lg-2">
										<select class="form-control">
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Sindicato</label>
									<div class="col-lg-4">
										<select class="form-control">
										</select>
									</div>

									<label class="col-lg-2 control-label">Horas Contratadas</label>
									<div class="col-lg-1">
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
							</div>

							<!--Third tab-->
							<div id="demo-cls-tab3" class="tab-pane">
								<div class="form-group">
									<label class="col-lg-3 control-label">Banco</label>
									<div class="col-lg-6">
										<select class="form-control">
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Agência</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>
									<label class="col-lg-1 control-label">Dígito</label>
									<div class="col-lg-1">
										<input type="text" class="form-control"> 
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Conta Corrente</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>
									<label class="col-lg-1 control-label">Dígito</label>
									<div class="col-lg-1">
										<input type="text" class="form-control"> 
									</div>
								</div>
							</div>

							<!--Fourth tab-->
							<div id="demo-cls-tab4" class="tab-pane">
								<div class="form-group">
									<label class="col-lg-3 control-label">RG</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>

									<div class="col-lg-3">
										<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">CPF</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>

									<div class="col-lg-3">
										<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">PIS</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>

									<div class="col-lg-3">
										<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">CTPS</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>

									<div class="col-lg-3">
										<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
										</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-3 control-label">Título de Eleitor</label>
									<div class="col-lg-2">
										<input type="text" class="form-control"> 
									</div>

									<label class="col-lg-1 control-label">Zona</label>
									<div class="col-lg-1">
										<input type="text" class="form-control"> 
									</div>

									<label class="col-lg-1 control-label">Seção</label>
									<div class="col-lg-1">
										<input type="text" class="form-control"> 
									</div>

									<div class="col-lg-3">
										<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
										</span>
									</div>
								</div>
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
		</form>
	</div>
</div>