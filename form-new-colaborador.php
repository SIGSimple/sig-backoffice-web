<div class="panel" ng-controller="CadastroColaboradorCtrl">
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
									<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.flg_sexo">
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
									<select class="form-control" ng-model="dadosColaborador.cod_estado_moradia" ng-options="item.cod_estado as item.sgl_estado for item in ufs" ng-change="getCidades('moradia')">
									</select>
								</div>
								<label class="col-lg-1 control-label">Cidade</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.cod_cidade_moradia" ng-options="item.cod_cidade as item.nme_cidade for item in cidadesMoradia">
									</select>
									<span class="loading-cidade-moradia hide">
										<i class="fa fa-spinner fa-pulse"></i> Por favor, aguarde...
									</span>
								</div>
							</div>
						</fieldset>

						<fieldset>
							<legend>Naturalidade</legend>
							
							<div class="form-group">
								<label class="col-lg-2 control-label">Estado</label>
								<div class="col-lg-1">
									<select class="form-control" ng-model="dadosColaborador.cod_estado_naturalidade" ng-options="item.cod_estado as item.sgl_estado for item in ufs" ng-change="getCidades('naturalidade')">
									</select>
								</div>

								<label class="col-lg-1 control-label">Cidade</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.cod_cidade_naturalidade" ng-options="item.cod_cidade as item.nme_cidade for item in cidadesNaturalidade">
									</select>
									<span class="loading-cidade-naturalidade hide">
										<i class="fa fa-spinner fa-pulse"></i> Por favor, aguarde...
									</span>
								</div>
							</div>
						</fieldset>
					</div>
			
					<!--Second tab-->
					<div id="demo-cls-tab2" class="tab-pane fade">
						<div class="form-group">
							<label class="col-lg-2 control-label">Empresa Contratante</label> 
							<div class="col-lg-4">
								<div class="input-group">
									<input type="text" class="form-control" ng-model="dadosColaborador.empresaContratante.nme_fantasia">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" ng-click="abreModal('empresas')">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
							</div>

							<label class="col-lg-2 control-label">Regime de Contratação</label>
							<div class="col-lg-1">
								<div class="input-group">
									<input type="text" class="form-control" ng-model="dadosColaborador.cod_regime_contratacao.dsc_regime_contratacao">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" ng-click="abreModal('regimes-contratacao')">
											<i class="fa fa-search"></i>
										</button>
									</span>

									<!--<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_regime_contratacao">
									<option ng-repeat="item in regimesContratacao" value="{{ item.cod_regime_contratacao }}" label="{{ item.dsc_regime_contratacao }}">{{ item.dsc_regime_contratacao }}</option>
								</select> -->
								</div>
							</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Local de Trabalho</label>
							<div class="col-lg-3">
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_local_trabalho">
									<option ng-repeat="item in locaisTrabalho" value="{{ item.cod_local_trabalho }}" label="{{ item.nme_local_trabalho }}">{{ item.nme_local_trabalho }}</option>
								</select>
							</div>

							<label class="col-lg-2 control-label">Departamento</label>
							<div class="col-lg-1">
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_departamento">
									<option ng-repeat="item in departamentos" value="{{ item.cod_departamento }}" label="{{ item.nme_departamento }}">{{ item.nme_departamento }}</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Contrato</label>
							<div class="col-lg-3">
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_origem">
									<option ng-repeat="item in contratos" value="{{ item.cod_origem }}" label="{{ item.dsc_origem }}">{{ item.dsc_origem }}</option>
								</select>
							</div>
							
							<label class="col-lg-2 control-label">Grade de Horário</label>
							<div class="col-lg-2">
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_grade_horario">
									<option ng-repeat="item in gradesHorario" value="{{ item.cod_grade_horario }}" label="{{ item.nme_grade_horario }}">{{ item.nme_grade_horario }}</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Sindicato</label>
							<div class="col-lg-4">
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_sindicato">
									<option ng-repeat="item in sindicatos" value="{{ item.cod_sindicato }}" label="{{ item.nme_sindicato }}">{{ item.nme_sindicato }}</option>
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
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_banco">
									<option ng-repeat="item in bancos" value="{{ item.cod_banco }}" label="{{ item.nme_banco }}">{{ item.nme_banco }}</option>
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
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_entidade">
									<option ng-repeat="item in entidades" value="{{ item.cod_entidade }}" label="{{ item.nme_entidade }}">{{ item.nme_entidade }}</option>
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
								<select class="form-control selectpicker" data-live-search="true" ng-model="dadosColaborador.cod_estado_ctps" ng-options="item.cod_estado as item.sgl_estado for item in ufs">
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

	<div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="modalItemsLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalItemsLabel">{{ modalOptions.title }}</h4>
				</div>
				<div class="modal-body">
					<!-- <table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th ng-repeat="column in modalOptions.columns" class="{{ column.class }}">{{ column.title }}</th>
						</thead>
						<tbody>
							<tr ng-repeat="linha in modalOptions.values">
								<td ng-repeat="value in linha">{{ value }}</td>
							</tr>
						</tbody>
					</table> -->

					<table class="bootstrap-table" 
						data-toggle="table"
						data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/empresas.json"
						data-search="true"
						data-show-refresh="true"
						data-show-toggle="true"
						data-show-columns="true"
						data-page-list="[5, 10, 20, 50, 100]"
						data-page-size="10"
						data-pagination="true"
						data-side-pagination="server"
						data-show-pagination-switch="true">
						<thead>
							<tr>
								<th data-visible="true" data-sortable="true" data-field="num_cnpj">CNPJ</th>
								<th data-visible="true" data-sortable="true" data-field="nme_razao_social">Razão Social</th>
								<th data-visible="true" data-sortable="true" data-field="nme_fantasia">Nome Fantasia</th>
								<th data-visible="false" data-sortable="true" data-field="num_inscricao_estadual">I.E.</th>
								<th data-visible="true" data-sortable="true" data-field="dsc_endereco">Endereço</th>
								<th data-visible="false" data-sortable="true" data-field="nme_bairro">Bairro</th>
								<th data-visible="false" data-sortable="true" data-field="num_cep">CEP</th>
								<th data-visible="true" data-sortable="true" data-field="nme_cidade">Cidade</th>
								<th data-visible="true" data-sortable="true" data-field="sgl_estado">UF</th>
								<th data-visible="true" data-sortable="true" data-field="flg_ativo" data-formatter="ativoFormatter">Ativo?</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>