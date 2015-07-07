<div class="panel" ng-controller="ConferenciaDadosPessoaisCtrl">
	<div class="panel-heading">
		<h3 class="panel-title">Utilize este formulário para verificar se as informações do seu cadastro estão corretas</h3>
	</div>
	<div class="panel-body">
		<form class="form form-horizontal" role="form">
			<div class="form-group">
				<label class="col-lg-2 control-label">Matricula</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_matricula }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Nome</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_colaborador }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Função</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.funcao.nme_funcao }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Departamento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_departamento }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Local de Trabalho</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_local_trabalho }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Horário</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_grade_horario }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Admissão</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_admissao | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Serie CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_serie_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Estado Emissão CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_estado_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Emissão CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_emissao_ctps | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">RG</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_rg }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CPF</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cpf }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">PIS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_pis }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Título de eleitor</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_titulo_eleitor }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Zona eleitoral</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_zona_eleitoral }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Seção eleitoral</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_secao_eleitoral }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Reservista</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_reservista }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Endereço</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dsc_endereco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Número</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_endereco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Bairro</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_bairro }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Complemento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dsc_complemento }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Cidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_cidade_moradia }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CEP</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cep }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Nascimento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_nascimento | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Cidade Naturalidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_cidade_naturalidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Estado Naturalidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_estado_naturalidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CNH</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cnh }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Categoria</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_categoria_cnh }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Validade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_validade_cnh | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Sexo</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.flg_sexo }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Banco</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_banco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Agência</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_agencia }}-{{ colaborador.cooperator.num_digito_agencia }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Conta corrente</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_conta_corrente }}-{{ colaborador.cooperator.num_digito_conta_corrente }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Sindicato</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_sindicato }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Entidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_entidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Número</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_entidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Telefones</label>
				<div class="col-lg-5">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th>DDD</th>
							<th>Número</th>
							<th>Tipo</th>
						</thead>
						<tbody>
							<tr ng-repeat="telefone in colaborador.cooperator.telefones">
								<td>{{ telefone.num_ddd }}</td>
								<td>{{ telefone.num_telefone }}</td>
								<td colspan="2">{{ telefone.nme_tipo_telefone }}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-5">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th>DDD</th>
							<th>Número</th>
							<th>Tipo</th>
							<th width="20">
								<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalTelefone()">
									<i class="fa fa-plus-circle"></i>
								</button>
							</th>
						</thead>
						<tbody>
							<tr ng-repeat="telefone in colaborador.cooperator.novos_telefones">
								<td>{{ telefone.num_ddd }}</td>
								<td>{{ telefone.num_telefone }}</td>
								<td colspan="2">{{ telefone.nme_tipo_telefone }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">E-mails</label>
				<div class="col-lg-5">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th>Endereço de E-mail</th>
						</thead>
						<tbody>
							<tr ng-repeat="email in colaborador.cooperator.emails">
								<td>{{ email.end_email }}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-5">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th>Endereço de E-mail</th>
							<th width="20">
								<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalEmail()">
									<i class="fa fa-plus-circle"></i>
								</button>
							</th>
						</thead>
						<tbody>
							<tr ng-repeat="email in colaborador.cooperator.novos_emails">
								<td colspan="2">{{ email.end_email }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<fieldset>
				<legend>Dependentes</legend>

				<div class="form-group">
					<div class="col-lg-6">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<th class="text-middle">Nome</th>
								<th class="text-center text-middle">Parentesco</th>
								<th class="text-center text-middle" width="80">Dt. Nasc.</th>
								<th class="text-center text-middle">Plano de Saúde</th>
								<th class="text-center text-middle">Cursa Faculdade?</th>
							</thead>
							<tbody>
								<tr ng-repeat="dependente in colaborador.cooperator.dependentes">
									<td class="text-middle">{{ dependente.nme_dependente }}</td>
									<td class="text-center text-middle">{{ dependente.nme_tipo_dependencia }}</td>
									<td class="text-center text-middle">{{ dependente.dta_nascimento | date : 'dd/MM/yyyy'}}</td>
									<td class="text-center text-middle">{{ (dependente.flg_plano_saude === '1') ? dependente.nme_plano_saude : 'Não optante' }}</td>
									<td class="text-center text-middle">{{ (dependente.flg_curso_superior) ? 'Sim' : 'Não' }}</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-lg-6">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<th>Nome</th>
								<th class="text-center text-middle">Parentesco</th>
								<th class="text-center text-middle" width="80">Dt. Nasc.</th>
								<th class="text-center text-middle">Plano de Saúde</th>
								<th class="text-center text-middle">Cursa Faculdade?</th>
								<th width="20">
									<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalEmail()">
										<i class="fa fa-plus-circle"></i>
									</button>
								</th>
							</thead>
							<tbody>
								<tr ng-repeat="email in colaborador.cooperator.novos_dependentes">
									<td class="text-middle">{{ dependente.nme_dependente }}</td>
									<td class="text-center text-middle">{{ dependente.nme_tipo_dependencia }}</td>
									<td class="text-center text-middle">{{ dependente.dta_nascimento | date : 'dd/MM/yyyy'}}</td>
									<td class="text-center text-middle">{{ (dependente.flg_plano_saude === '1') ? dependente.nme_plano_saude : 'Não optante' }}</td>
									<td class="text-center text-middle" colspan="2">{{ (dependente.flg_curso_superior) ? 'Sim' : 'Não' }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="panel-footer clearfix">
		<div class="pull-right">
			<button class="btn btn-primary btn-labeled fa fa-save">Enviar dados p/ atualização</button>
		</div>
	</div>
</div>