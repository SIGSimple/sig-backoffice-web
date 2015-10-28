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
		<form class="form-horizontal form-fields">
			<div class="panel-body" style="padding-top: 10px;">
				<div class="tab-content">
					<!--First tab-->
					<div id="demo-cls-tab1" class="tab-pane fade">
						<fieldset>
							<legend>Informações Básicas</legend>
							
							<div class="row">
								<div class="col-lg-3 text-right">
									<img class="img img-thumbnail" src="{{ dadosColaborador.pth_arquivo_foto }}" style="max-height: 220px;">
								</div>
								<div class="col-lg-9">
									<div class="form-group">
										<div class="element-group">
											<label class="col-lg-2 control-label">Matrícula</label> 
											<div class="col-lg-2">
												<input type="text" class="form-control" ng-model="dadosColaborador.num_matricula"  maxlength="100" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="element-group">
											<label class="col-lg-2 control-label">Nome</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" ng-model="dadosColaborador.nme_colaborador"  maxlength="100" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="element-group">
											<label class="col-lg-2 control-label">Data de Nascimento</label>
											<div class="col-lg-3">
												<div class="input-group date">
													<input type="text" class="form-control" ng-model="dadosColaborador.dta_nascimento" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
													<span class="input-group-addon" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')"><i class="fa fa-calendar fa-lg"></i></span>
												</div>
											</div>
										</div>
									
										<div class="element-group">
											<label class="col-lg-1 control-label">Sexo</label>
											<div class="col-lg-2">
												<select class="form-control"  ng-model="dadosColaborador.flg_sexo"  maxlength="1" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											 		<option value="M" label="Masculino"></option>
													<option value="F" label="Feminino"></option> 
												</select> 
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="element-group">
											<label class="col-lg-2 control-label">Ativo?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_ativo" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
										
										<div class="element-group">
											<label class="col-lg-4 control-label">Portador Necessidades Especiais?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_portador_necessidades_especiais" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>

										<div class="element-group">
											<label class="col-lg-3 control-label">Preenche Folha de Ponto?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_ajusta_folha_ponto" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="element-group">
											<label class="col-lg-2 control-label">Faz Hora Extra?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_hora_extra" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
										
										<div class="element-group">
											<label class="col-lg-4 control-label">Trabalha de Fim de Semana?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_trabalho_fim_semana" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>	
										
										<div class="element-group">
											<label class="col-lg-3 control-label">Trabalha Feriado?</label>
											<div class="col-lg-1">
												<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_trabalho_feriado" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
											</div>
										</div>
									</div>	
								</div>
							</div>
						</fieldset>
						
						<fieldset>
							<legend>Moradia</legend>

							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2 control-label">CEP</label>
									<div class="col-lg-2">
										<input type="text" class="form-control" ng-model="dadosColaborador.num_cep"  maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
									</div>
								</div>

								<div class="element-group">
									<label class="col-lg-1 control-label">Endereço</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" ng-model="dadosColaborador.dsc_endereco"  maxlength="100" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2 control-label">Número</label>
									<div class="col-lg-2">
										<input type="text" class="form-control" ng-model="dadosColaborador.num_endereco"  maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
									</div>
								</div>

								<div class="element-group">
									<label class="col-lg-1 control-label">Complemento</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" ng-model="dadosColaborador.dsc_complemento"  maxlength="100" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2 control-label">Bairro</label>
									<div class="col-lg-3">
										<input type="text" class="form-control" ng-model="dadosColaborador.nme_bairro"  maxlength="100" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2 control-label">UF</label>
									<div class="col-lg-1">
										<select class="form-control" ng-model="dadosColaborador.cod_estado_moradia"  ng-options="item.cod_estado as item.sgl_estado for item in ufs" ng-change="getCidades('moradia')" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										</select>
									</div>
								</div>
								
								<div class="element-group">
									<label class="col-lg-1 control-label">Cidade</label>
									<div class="col-lg-3">
										<select class="form-control" ng-model="dadosColaborador.cod_cidade_moradia"   ng-options="item.cod_cidade as item.nme_cidade for item in cidadesMoradia" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										</select>
										<span class="loading-cidade-moradia hide">
											<i class="fa fa-spinner fa-pulse"></i> Por favor, aguarde...
										</span>
									</div>
								</div>
							</div>	
						</fieldset>

						<fieldset>
							<legend>Naturalidade</legend>
							
							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2 control-label">Estado</label>
									<div class="col-lg-1">
										<select class="form-control" ng-model="dadosColaborador.cod_estado_naturalidade"  ng-options="item.cod_estado as item.sgl_estado for item in ufs" ng-change="getCidades('naturalidade')" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										</select>
									</div>
								</div>
								
								<div class="element-group">	
									<label class="col-lg-1 control-label">Cidade</label>
									<div class="col-lg-3">
										<select class="form-control" ng-model="dadosColaborador.cod_cidade_naturalidade"  ng-options="item.cod_cidade as item.nme_cidade for item in cidadesNaturalidade" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										</select>
										<span class="loading-cidade-naturalidade hide">
											<i class="fa fa-spinner fa-pulse"></i> Por favor, aguarde...
										</span>
									</div>
								</div>
							</div>
						</fieldset>
						
						<fieldset>
							<legend>Dados de Contato</legend>

							<div class="form-group">
								<div class="element-group">
									<label class="col-lg-2  control-label">Telefones</label>
									<div class="col-lg-4">
										<table class="table table-bordered table-condensed table-hover table-striped" name="telefones">
											<thead>
												<th>DDD</th>
												<th>Número</th>
												<th colspan="{{ (!getFuncionalidadeByName('INCLUIR TELEFONE')) ? '2' : '' }}">Tipo</th>
												<th width="20" ng-show="getFuncionalidadeByName('INCLUIR TELEFONE')">
													<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalTelefone()">
														<i class="fa fa-plus-circle"></i>
													</button>
												</th>
											</thead>
											<tbody>
												<tr ng-repeat="telefone in dadosColaborador.telefones | filter: { flg_removido: false }">
													<td>{{ telefone.num_ddd }}</td>
													<td>{{ telefone.num_telefone }}</td>
													<td colspan="{{ (!getFuncionalidadeByName('EXCLUIR TELEFONE')) ? '2' : '' }}">{{ telefone.tipoTelefone.nme_tipo_telefone }}</td>
													<td width="20" ng-show="getFuncionalidadeByName('EXCLUIR TELEFONE')">
														<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(telefone)">
															<i class="fa fa-trash-o"></i>
														</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
								<div class="element-group">
									<label class="col-lg-2 control-label">E-mails</label>
									<div class="col-lg-4">
										<table class="table table-bordered table-condensed table-hover table-striped">
											<thead>
												<th colspan="{{ (!getFuncionalidadeByName('INCLUIR EMAIL')) ? '2' : '' }}">Endereço de E-mail</th>
												<th width="20" ng-show="getFuncionalidadeByName('INCLUIR EMAIL')">
													<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalEmail()">
														<i class="fa fa-plus-circle"></i>
													</button>
												</th>
											</thead>
											<tbody>
												<tr ng-repeat="email in dadosColaborador.emails | filter: { flg_removido: false }">
													<td colspan="{{ (!getFuncionalidadeByName('EXCLUIR EMAIL')) ? '2' : '' }}">{{ email.end_email }}</td>
													<td width="20" ng-show="getFuncionalidadeByName('EXCLUIR EMAIL')">
														<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(email)">
															<i class="fa fa-trash-o"></i>
														</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
			
					<!--Second tab-->
					<div id="demo-cls-tab2" class="tab-pane fade">
						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Empresa Contratante</label> 
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="empresaContratante" readonly="readonly" value="{{ dadosColaborador.empresaContratante.nme_fantasia }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('empresas', 'empresaContratante')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Regime de Contratação</label>
								<div class="col-lg-1">
									<select class="form-control"  ng-model="dadosColaborador.cod_regime_contratacao" ng-options="item.cod_regime_contratacao as item.dsc_regime_contratacao for item in regimesContratacao" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Contrato</label> 
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="contrato" readonly="readonly" value="{{ dadosColaborador.contrato.dsc_origem }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('origens', 'contrato')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>

								<label class="col-lg-2 control-label">Plano de Saúde</label>
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="planoSaude" readonly="readonly" value="{{ dadosColaborador.planoSaude.nme_fantasia + ' - ' + dadosColaborador.planoSaude.nme_plano_saude }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('planos-saude', 'planoSaude')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Local de Trabalho</label>
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="localTrabalho" readonly="readonly" value="{{ dadosColaborador.localTrabalho.nme_local_trabalho }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('locais-trabalho', 'localTrabalho')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Departamento</label>
								<div class="col-lg-2">
									<select class="form-control" ng-model="dadosColaborador.cod_departamento"  ng-options="item.cod_departamento as item.sgl_departamento for item in departamentos" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Grade de Horário</label>
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="gradeHorario" readonly="readonly" value="{{dadosColaborador.gradeHorario.nme_grade_horario }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('grades-horario', 'gradeHorario')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Horas Contratadas</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.qtd_horas_contratadas" maxlength="11"  ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Sindicato</label>
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="sindicato" readonly="readonly" value="{{dadosColaborador.sindicato.nme_sindicato }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('sindicatos', 'sindicato')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>				
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Data de Admissão</label>
								<div class="col-lg-2">
									<div class="input-group date">																
										<input type="text" class="form-control" ng-model="dadosColaborador.dta_admissao" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										<span class="input-group-addon" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Data de Demissão</label>
								<div class="col-lg-2">
									<div class="input-group date">
										<input type="text" class="form-control" ng-model="dadosColaborador.dta_demissao"  ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										<span class="input-group-addon" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Função</label>
								<div class="col-lg-10">
									<table class="table table-bordered table-condensed table-hover table-striped" name="funcoes ">
										<thead>
											<th width="100">Núm./Código</th>
											<th>Função</th>
											<th width="120">Salário</th>
											<th>Motivo</th>
											<th width="80" colspan="{{ (!getFuncionalidadeByName('INCLUIR FUNÇÃO')) ? '2' : '' }}">Data</th>
											<th width="20" ng-show="getFuncionalidadeByName('INCLUIR FUNÇÃO')">
												<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalFuncao()">
													<i class="fa fa-plus-circle"></i>
												</button>
											</th>
										</thead>
										<tbody>
											<tr ng-repeat="funcao in dadosColaborador.funcoes | filter: { flg_removido: false }" >
												<td>{{ funcao.funcao.num_funcao }}</td>
												<td>{{ funcao.funcao.nme_funcao }}</td>
												<td>R$ {{ funcao.vlr_salario | numberFormat: 2 : ',' : '.' }}</td>
												<td>{{ funcao.motivoAlteracaoFuncao.nme_motivo_alteracao_funcao }}</td>
												<td colspan="{{ (!getFuncionalidadeByName('EXCLUIR FUNÇÃO')) ? '2' : '' }}">{{ funcao.dta_alteracao | date : 'dd/MM/yyyy' }}</td>
												<td width="20" ng-show="getFuncionalidadeByName('EXCLUIR FUNÇÃO')">
													<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(funcao)">
														<i class="fa fa-trash-o"></i>
													</button>
												</td>	
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Dependentes</label>
								<div class="col-lg-10">
									<table class="table table-bordered table-condensed table-hover table-striped" name="dependentes ">
										<thead>
											<th>Parentesco</th>
											<th>Nome</th>
											<th>Dta. Nascimento</th>
											<th>Plano Saúde?</th>
											<th>Plano</th>
											<th>Deduz IRPF?</th>
											<th colspan="{{ (!getFuncionalidadeByName('INCLUIR DEPENDENTE')) ? '2' : '' }}">Possui Faculdade?</th>
											<th width="60" ng-show="getFuncionalidadeByName('INCLUIR DEPENDENTE')">	
												<button type="button" class="btn btn-xs btn-primary" ng-click="tmpModal={};abreModalDependente()">
													<i class="fa fa-plus-circle"></i> Incluir
												</button>
											</th>
										</thead>
										<tbody>
											<tr ng-repeat="dependente in dadosColaborador.dependentes" >
												<td>{{ dependente.tipoDependencia.nme_tipo_dependencia }}</td>
												<td>{{ dependente.nme_dependente }}</td>
												<td>{{ dependente.dta_nascimento }}</td>
												<td>{{ (dependente.flg_plano_saude == 1) ? 'Sim' : 'Não' }}</td>
												<td>{{ dependente.planoSaude.nme_plano_saude }}</td>
												<td>{{ (dependente.flg_deduz_irrf == 1) ? 'Sim' : 'Não'  }}</td>
												<td colspan="{{ (!getFuncionalidadeByName('EXCLUIR DEPENDENTE')) ? '2' : '' }}">{{ (dependente.flg_curso_superior == 1) ? 'Sim' : 'Não'  }}</td>
												<td width="20" ng-show="getFuncionalidadeByName('EXCLUIR DEPENDENTE')">
													<button type="button" class="btn btn-xs btn-warning" ng-click="editarDependente(dependente)">
														<i class="fa fa-edit"></i>
													</button>
													<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(dependente)">
														<i class="fa fa-trash-o"></i>
													</button>
												</td>	
											</tr>
										</tbody>
									</table>
								</div>
							</div>	
						</div>		
					</div>

					<!--Third tab-->
					<div id="demo-cls-tab3" class="tab-pane">
						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Banco</label>
								<div class="col-lg-4">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="banco" readonly="readonly" value="{{ dadosColaborador.banco.num_banco }} | {{ dadosColaborador.banco.nme_banco }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('bancos', 'banco')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Agência</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_agencia" maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-1 control-label">Dígito</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_digito_agencia" maxlength="5" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Conta Corrente</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_conta_corrente" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">  
								</div>
							</div>
							
							<div class="element-group">	
								<label class="col-lg-1 control-label">Dígito</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_digito_conta_corrente" maxlength="5" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
						</div>
					</div>

					<!--Fourth tab-->
					<div id="demo-cls-tab4" class="tab-pane">
						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">RG</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_rg" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
							

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">	
								<div class="col-lg-3">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_rg">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">	
								<label class="col-lg-2 control-label">CPF</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_cpf" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">	
								<div class="col-lg-3">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_cpf">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">	
								<label class="col-lg-2 control-label">PIS</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_pis" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
							
							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">									
								<div class="col-lg-3">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_pis">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">									
								<label class="col-lg-2 control-label">Entidade</label>
								<div class="col-lg-3">
									<div class="input-group {{ (!getFuncionalidadeByName('EDITAR CADASTRO')) ? 'width-100' : ''}}">
										<input type="text" class="form-control" name="entidade" readonly="readonly" value="{{dadosColaborador.entidade.nme_entidade }}">
										<span class="input-group-btn" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
											<button class="btn btn-default" type="button" ng-click="abreModal('entidades', 'entidade')">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</div>
							</div>

							<div class="element-group">									
								<label class="col-lg-1 control-label">Número</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_entidade" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">									
								<label class="col-lg-2 control-label">CTPS</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_ctps" maxlength="50" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
							
							<div class="element-group">										
								<label class="col-lg-1 control-label">Série</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_serie_ctps" maxlength="50" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group">										
								<label class="col-lg-1 control-label">Emissão CTPS</label>
								<div class="col-lg-2">
									<div class="input-group date">
										<input type="text" class="form-control" ng-model="dadosColaborador.dta_emissao_ctps" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										<span class="input-group-addon" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
							</div>

							<div class="element-group">										
								<label class="col-lg-2 control-label">Estado</label>
								<div class="col-lg-1">
									<select class="form-control" ng-model="dadosColaborador.cod_estado_ctps" ng-options="item.cod_estado as item.sgl_estado for item in ufs" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">										
								<label class="col-lg-2 control-label">Título de Eleitor</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_titulo_eleitor" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
								
							<div class="element-group">										
								<label class="col-lg-1 control-label">Zona</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_zona_eleitoral" maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>
							
							<div class="element-group">											
								<label class="col-lg-1 control-label">Seção</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_secao_eleitoral" maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">											
								<div class="col-lg-2">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_titulo_eleitor">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">CNH</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_cnh" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group">											
								<label class="col-lg-1 control-label">Validade</label>
								<div class="col-lg-2">
									<div class="input-group date">
										<input type="text" class="form-control" ng-model="dadosColaborador.dta_validade_cnh" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
										<span class="input-group-addon" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
							</div>

							<div class="element-group">											
								<label class="col-lg-1 control-label">Categoria</label>
								<div class="col-lg-1">
									<input type="text" class="form-control" ng-model="dadosColaborador.nme_categoria_cnh" maxlength="10" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
								</div>
							</div>

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">											
								<div class="col-lg-1">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_cnh">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Reservista</label>
								<div class="col-lg-2">
									<input type="text" class="form-control" ng-model="dadosColaborador.num_reservista" maxlength="20" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))"> 
								</div>
							</div>

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
								<div class="col-lg-3">
									<span class="pull-left btn btn-default btn-file" name="pth_arquivo_reservista" >
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="element-group">
								<label class="col-lg-2 control-label">Possui ensino Superior?</label>
								<div class="col-lg-1">
									<input type="checkbox" class="input-switch" ng-model="dadosColaborador.flg_ensino_superior" ng-readonly="(!getFuncionalidadeByName('EDITAR CADASTRO'))" ng-disabled="(!getFuncionalidadeByName('EDITAR CADASTRO'))">
								</div>
							</div>

							<div class="element-group" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">
								<div class="col-lg-3">
									<span class="pull-left btn btn-default btn-file">
									Selecionar... <input type="file">
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Footer button-->
			<div class="panel-footer clearfix">
				<div class="pull-left">
					<div class="box-inline">
						<button type="button" class="btn btn-danger btn-labeled fa fa-trash-o" ng-show="showDeleteButton()" data-toggle="modal" data-target='#modalExcluiColaborador'>Excluir cadastro</button>
					</div>
				</div>
				<div class="pull-right">
					<div class="box-inline">
						<a href="list-colaboradores" class="btn btn-default">Voltar p/ Listagem de Colaboradores</a>
						<button type="button" class="previous btn btn-success">Voltar</button>
						<button type="button" class="next btn btn-success">Avançar</button>
						<button type="button" class="finish btn btn-success" disabled ng-click="validateFieldValues()" ng-show="getFuncionalidadeByName('EDITAR CADASTRO')">Finalizar</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="modal fade" id="modalExcluiColaborador" tabindex="-1" role="dialog" aria-labelledby="modalExcluiColaboradorLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirma exclusão?</h4>
				</div>
				<div class="modal-body">
					Confirma a exclusão do colaborador [{{ dadosColaborador.nme_colaborador }}]?
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
						<button type="button" class="btn btn-default" ng-click="deleteColaborador()">Sim</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="modalItemsLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalItemsLabel"></h4>
				</div>
				<div class="modal-body">
					<table id="mytable"></table>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAddTelefone" tabindex="-1" role="dialog" aria-labelledby="modalAddTelefoneLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalAddTelefoneLabel">Inclusão de Telefone</h4>
				</div>
				<form class="form form-horizontal" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-lg-3 control-label">Tipo</label>
							<div class="col-lg-9">
								<select class="form-control" ng-model="tmpModal.tipoTelefone" ng-options="item as item.nme_tipo_telefone for item in tiposTelefone"></select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">DDD</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" ng-model="tmpModal.num_ddd" maxlength="2">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Número</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" ng-model="tmpModal.num_telefone" maxlength="11">
							</div>
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-left">
							<p class="text-danger hide">Os campos marcados em vermelho são obrigatórios!</p>
						</div>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addTelefone()">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAddEmail" tabindex="-1" role="dialog" aria-labelledby="modalAddEmailLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalAddEmailLabel">Inclusão do Email</h4>
				</div>

				<form class="form form-horizontal" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-lg-3 control-label">Endereço</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" ng-model="tmpModal.end_email" maxlength="100">
							</div> 
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-left">
							<p class="text-danger hide">Os campos marcados em vermelho são obrigatórios!</p>
						</div>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addEmail()">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAddFuncao" tabindex="-1" role="dialog" aria-labelledby="modalAddFuncaoLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalAddFuncaoLabel">Inclusão da Função</h4>
				</div>

				<form class="form form-horizontal" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-lg-3 control-label">Função</label>
							<div class="col-lg-5">
								<select class="form-control" ng-model="tmpModal.funcao" ng-options="item as item.num_funcao + ' - ' + item.nme_funcao for item in funcoes"></select>
							</div> 
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Salário</label>
							<div class="col-lg-3">
								<input type="text" class="form-control" ng-model="tmpModal.vlr_salario">
							</div> 
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Motivo</label>
							<div class="col-lg-5">
								<select class="form-control" ng-model="tmpModal.motivoAlteracaoFuncao" ng-options="item as item.nme_motivo_alteracao_funcao for item in motivosAlteracaoFuncao"></select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Data Alteração</label>
							<div class="col-lg-4">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="tmpModal.dta_alteracao">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div> 
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-left">
							<p class="text-danger hide">Os campos marcados em vermelho são obrigatórios!</p>
						</div>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addFuncao()">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAddDependente" tabindex="-1" role="dialog" aria-labelledby="modalAddDependenteLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalAddDependenteLabel">Inclusão de Dependente</h4>
				</div>

				<form class="form form-horizontal" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label class="col-lg-3 control-label">Nome</label>
							<div class="col-lg-9">
								<input class="form-control" ng-model="tmpModal.nme_dependente">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Grau de Parentesco</label>
							<div class="col-lg-3">
								<select class="form-control" ng-model="tmpModal.cod_tipo_dependencia">
									<option ng-repeat="item in tiposDependencia" value="{{ item.cod_tipo_dependencia }}" label="{{ item.nme_tipo_dependencia }}" ng-selected="tmpModal.tipoDependencia.cod_tipo_dependencia == item.cod_tipo_dependencia"></option> 
								</select>
							</div>

							<label class="col-lg-2 control-label">Nascimento</label>
							<div class="col-lg-4">
								<div class="input-group date">
									<input type="text" class="form-control" ng-model="tmpModal.dta_nascimento">
									<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Plano de Saúde</label>
							<div class="col-lg-9">
								<div class="checkbox">
									<label class="form-checkbox form-normal form-primary form-text {{ (tmpModal.flg_plano_saude == 1) ? 'active' : '' }}">
										<input type="checkbox" ng-model="tmpModal.flg_plano_saude" ng-change="validateState()">
									</label>
								</div>

								<select class="form-control" ng-model="tmpModal.cod_plano_saude" ng-show="(tmpModal.flg_plano_saude == 1)">
									<option ng-repeat="item in planosSaude" value="{{ item.cod_plano_saude }}" label="{{ item.nme_fantasia + ' - ' + item.nme_plano_saude }}" ng-selected="tmpModal.planoSaude.cod_plano_saude == item.cod_plano_saude"></option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Cursa Faculdade?</label>
							<div class="col-lg-1">
								<div class="checkbox">
									<label class="form-checkbox form-normal form-primary form-text {{ (tmpModal.flg_curso_superior == 1) ? 'active' : '' }}">
										<input type="checkbox" ng-model="tmpModal.flg_curso_superior">
									</label>
								</div>
							</div>

							<label class="col-lg-2 control-label">Deduz IRPF?</label>
							<div class="col-lg-1">
								<div class="checkbox">
									<label class="form-checkbox form-normal form-primary form-text {{ (tmpModal.flg_deduz_irrf == 1) ? 'active' : '' }}">
										<input type="checkbox" ng-model="tmpModal.flg_deduz_irrf">
									</label>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-left">
							<p class="text-danger hide">Os campos marcados em vermelho são obrigatórios!</p>
						</div>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addDependente()">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>