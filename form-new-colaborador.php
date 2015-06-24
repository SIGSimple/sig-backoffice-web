<div class="panel" ng-controller="CadastroColaboradorCtrl">
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
								<label class="col-lg-2 control-label">Matrícula</label> 
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_matricula">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Nome</label>
								<div class="col-lg-6">
									<input type="text" class="form-control" ng-model="dadosColaborador.nme_colaborador">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Data de Nascimento</label>
								<div class="col-lg-2">
									<div class="input-group date">
										<input type="text" class="form-control" ng-model="dadosColaborador.dta_nascimento">
										<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
								
								<label class="col-lg-2 control-label">Sexo</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.flg_sexo">
										<option value="M" label="Masculino"></option>
										<option value="F" label="Feminino"></option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Portador Necessidades Especiais?</label>
								<div class="col-lg-1">
									<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_portador_necessidades_especiais">
								</div>
								
								<label class="col-lg-1 control-label">C/M?</label>
								<div class="col-lg-1">
									<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_cm">
								</div>

								<label class="col-lg-1 control-label">Ativo?</label>
								<div class="col-lg-1">
									<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_ativo">
								</div>
							</div>
						</fieldset>

						<fieldset>
							<legend>Moradia</legend>

							<div class="form-group">
								<label class="col-lg-2 control-label">CEP</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_cep"> 
								</div>
								<label class="col-lg-1 control-label">Endereço</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" ng-model="dadosColaborador.dsc_endereco"> 
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Número</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_endereco"> 
								</div>
								<label class="col-lg-1 control-label">Complemento</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" ng-model="dadosColaborador.dsc_complemento"> 
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">Bairro</label>
								<div class="col-lg-4">
									<input type="text" class="form-control" ng-model="dadosColaborador.nme_bairro"> 
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">UF</label>
								<div class="col-lg-1">
									<select class="form-control" ng-model="dadosColaborador.cod_estado_moradia">
									</select>
								</div>
								<label class="col-lg-1 control-label">Cidade</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.cod_cidade_moradia">
									</select>
								</div>
							</div>
						</fieldset>

						<fieldset>
							<legend>Naturalidade</legend>
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Estado</label>
								<div class="col-lg-1">
									<select class="form-control" ng-model="dadosColaborador.cod_estado_naturalidade">
									</select>
								</div>

								<label class="col-lg-1 control-label">Cidade</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.cod_cidade_naturalidade">
									</select>
								</div>
							</div>
						</fieldset>
					</div>
			
					<!--Second tab-->
					<div id="demo-cls-tab2" class="tab-pane fade">
						<div class="form-group">
							<label class="col-lg-2 control-label">Empresa Contratante</label> 
							<div class="col-lg-4">
								<select class="form-control" ng-model="dadosColaborador.cod_empresa_contratante">
								</select>
							</div>

							<label class="col-lg-2 control-label">Regime de Contratação</label>
							<div class="col-lg-1">
								<select class="form-control" ng-model="dadosColaborador.cod_regime_contratacao">
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Local de Trabalho</label>
							<div class="col-lg-3">
								<select class="form-control" ng-model="dadosColaborador.cod_local_trabalho">
								</select>
							</div>

							<label class="col-lg-2 control-label">Departamento</label>
							<div class="col-lg-1">
								<select class="form-control" ng-model="dadosColaborador.cod_departamento">
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Contrato</label>
							<div class="col-lg-3">
								<select class="form-control" ng-model="dadosColaborador.cod_contrato">
								</select>
							</div>
							
							<label class="col-lg-2 control-label">Grade de Horário</label>
							<div class="col-lg-2">
								<select class="form-control" ng-model="dadosColaborador.cod_grade_horario">
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Sindicato</label>
							<div class="col-lg-4">
								<select class="form-control" ng-model="dadosColaborador.cod_sindicato">
								</select>
							</div>

							<label class="col-lg-2 control-label">Horas Contratadas</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.qtd_horas_contratadas">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Data de Admissão</label>
							<div class="col-lg-2">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="dadosColaborador.dta_admissao">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div>
							<label class="col-lg-2 control-label">Data de Demissão</label>
							<div class="col-lg-2">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="dadosColaborador.dta_demissao">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div>
						</div>
					</div>

					<!--Third tab-->
					<div id="demo-cls-tab3" class="tab-pane">
						<div class="form-group">
							<label class="col-lg-2 control-label">Banco</label>
							<div class="col-lg-6">
								<select class="form-control" ng-model="dadosColaborador.cod_banco">
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Agência</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_agencia"> 
							</div>
							<label class="col-lg-1 control-label">Dígito</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_digito_agencia"> 
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Conta Corrente</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_conta_corrente">  
							</div>
							<label class="col-lg-1 control-label">Dígito</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_digito_conta_corrente"> 
							</div>
						</div>
					</div>

					<!--Fourth tab-->
					<div id="demo-cls-tab4" class="tab-pane">
						<div class="form-group">
							<label class="col-lg-2 control-label">RG</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_rg"> 
							</div>

							<div class="col-lg-3">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">CPF</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_cpf"> 
							</div>

							<div class="col-lg-3">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">PIS</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_pis"> 
							</div>

							<div class="col-lg-3">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Entidade</label>
							<div class="col-lg-1">
								<select class="form-control" ng-model="dadosColaborador.cod_entidade">
								<!--	<option value="C" label="CREA"></option> -->
								</select>
							</div>
							<label class="col-lg-1 control-label">Número</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_entidade"> 
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">CTPS</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_ctps"> 
							</div>
							<label class="col-lg-1 control-label">Série</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_serie_ctps"> 
							</div>
							<label class="col-lg-1 control-label">Emissão CTPS</label>
							<div class="col-lg-2">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="dadosColaborador.dta_emissao_ctps">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div>
						
							<label class="col-lg-1 control-label">Estado</label>
							<div class="col-lg-1">
								<select class="form-control" ng-model="dadosColaborador.cod_estado_ctps">
								<!--<option value="AC" label="Acre"></option>
									<option value="AL" label="Alagoas"></option>
									<option value="AM" label="Amazonas"></option>
									<option value="AP" label="Amapá"></option>
									<option value="BA" label="Bahia"></option>
									<option value="CE" label="Ceará"></option>
									<option value="DF" label="Distrito Federal"></option>
									<option value="ES" label="Espírito Santo"></option>
									<option value="GO" label="Goiás"></option>
									<option value="MA" label="Maranhão"></option>
									<option value="MG" label="Minas Gerais"></option>
									<option value="MS" label="Mato Grosso do Sul"></option>
									<option value="MT" label="Mato Groso"></option>
									<option value="PA" label="Pará"></option>
									<option value="PB" label="Paraíba"></option>
									<option value="PE" label="Pernambuco"></option>
									<option value="PI" label="Piauí"></option>
									<option value="PR" label="Paraná"></option>
									<option value="RJ" label="Rio de Janeiro"></option>
									<option value="RN" label="Rio Grande do Norte"></option>
									<option value="RO" label="Rondônia"></option>
									<option value="RR" label="Roraima"></option>
									<option value="RS" label="Rio Grande do Sul"></option>
									<option value="SC" label="Santa Catarina"></option>
									<option value="SE" label="Sergipe"></option>
									<option value="SP" label="São Paulo"></option>
									<option value="TO" label="Tocantis"></option> -->

								</select>
							</div>

							<div class="col-lg-1">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Título de Eleitor</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_titulo_eleitor"> 
							</div>

							<label class="col-lg-1 control-label">Zona</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_zona_eleitoral"> 
							</div>

							<label class="col-lg-1 control-label">Seção</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_secao_eleitoral"> 
							</div>

							<div class="col-lg-2">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">CNH</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_cnh"> 
							</div>

							<label class="col-lg-1 control-label">Validade</label>
							<div class="col-lg-2">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="dadosColaborador.dta_validade_cnh">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div>

							<label class="col-lg-1 control-label">Categoria</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" ng-model="dadosColaborador.nme_categoria_cnh">
							</div>

							<div class="col-lg-1">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Reservista</label>
							<div class="col-lg-2">
								<input type="text" class="form-control" ng-model="dadosColaborador.num_reservista"> 
							</div>
						

							<div class="col-lg-3">
								<span class="pull-left btn btn-default btn-file">
								Selecionar... <input type="file">
								</span>
							</div>
						</div>
						
					</div>

				<pre>{{ dadosColaborador }}</pre>
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