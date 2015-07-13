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
					<input class="form-control" ng-model="colaborador.novosDados.num_matricula" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Nome</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_colaborador }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_colaborador" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Função</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.funcao.nme_funcao }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_funcao" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Departamento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_departamento }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_departamento" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Local de Trabalho</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_local_trabalho }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_local_trabalho" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Horário</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_grade_horario }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_grade_horario" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Admissão</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_admissao | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dta_admissao" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_ctps" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Serie CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_serie_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_serie_ctps" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Estado Emissão CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_estado_ctps }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_estado_ctps" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Emissão CTPS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_emissao_ctps | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dta_emissao_ctps" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">RG</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_rg }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_rg" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CPF</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cpf }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_cpf" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">PIS</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_pis }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_pis" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Título de eleitor</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_titulo_eleitor }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_titulo_eleitor" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Zona eleitoral</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_zona_eleitoral }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_zona_eleitoral" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Seção eleitoral</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_secao_eleitoral }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_secao_eleitoral" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Reservista</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_reservista }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_reservista" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Endereço</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dsc_endereco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dsc_endereco" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Número</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_endereco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_endereco" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Bairro</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_bairro }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_bairro" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Complemento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dsc_complemento }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dsc_complemento" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Cidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_cidade_moradia }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_cidade_moradia" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CEP</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cep }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_cep" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Nascimento</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_nascimento | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dta_nascimento" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Cidade Naturalidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_cidade_naturalidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_cidade_naturalidade" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Estado Naturalidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_estado_naturalidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_estado_naturalidade" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CNH</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_cnh }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_cnh" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Categoria</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_categoria_cnh }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_categoria_cnh" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Validade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.dta_validade_cnh | date : 'dd/MM/yyyy' }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.dta_validade_cnh" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Sexo</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.flg_sexo }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.flg_sexo" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Banco</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_banco }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_banco" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Agência</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_agencia }}-{{ colaborador.cooperator.num_digito_agencia }}">
				</div>

				<div class="col-lg-4">
					<input class="form-control" ng-model="colaborador.novosDados.num_agencia" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>

				<div class="col-lg-1">
					<input class="form-control" ng-model="colaborador.novosDados.num_digito_agencia" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Conta corrente</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_conta_corrente }}-{{ colaborador.cooperator.num_digito_conta_corrente }}">
				</div>

				<div class="col-lg-4">
					<input class="form-control" ng-model="colaborador.novosDados.num_conta_corrente" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>

				<div class="col-lg-1">
					<input class="form-control" ng-model="colaborador.novosDados.num_digito_conta_corrente" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Sindicato</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_sindicato }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_sindicato" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Entidade</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_entidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.nme_entidade" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Número</label>
				<div class="col-lg-5">
					<input class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_entidade }}">
				</div>

				<div class="col-lg-5">
					<input class="form-control" ng-model="colaborador.novosDados.num_entidade" placeholder="Caso haja alteração ou inconsistência, informe aqui">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Telefones</label>
				<div class="col-lg-5">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th class="text-center text-middle">DDD</th>
							<th class="text-center text-middle">Número</th>
							<th class="text-center text-middle">Tipo</th>
							<th width="20">
								<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalTelefone()">
									<i class="fa fa-plus-circle"></i>
								</button>
							</th>
						</thead>
						<tbody>
							<tr ng-repeat="telefone in colaborador.cooperator.telefones | filter: { flg_removido: false }">
								<td class="text-center text-middle">{{ telefone.num_ddd }}</td>
								<td class="text-center text-middle">{{ telefone.num_telefone }}</td>
								<td class="text-center text-middle">{{ (telefone.tipoTelefone) ? telefone.tipoTelefone.nme_tipo_telefone : telefone.nme_tipo_telefone }}</td>
								<td class="text-center text-middle">
									<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(telefone)">
										<i class="fa fa-trash-o"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<label class="col-lg-1 control-label">E-mails</label>
				<div class="col-lg-4">
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
							<tr ng-repeat="email in colaborador.cooperator.emails | filter: { flg_removido: false }">
								<td>{{ email.end_email }}</td>
								<td class="text-center text-middle">
									<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(email)">
										<i class="fa fa-trash-o"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Dependentes</label>
				<div class="col-lg-10">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th class="text-middle" width="265">Nome</th>
							<th class="text-center text-middle" width="127">Parentesco</th>
							<th class="text-center text-middle" width="85">Dt. Nasc.</th>
							<th class="text-center text-middle" width="160">Plano de Saúde</th>
							<th class="text-center text-middle" width="160">Cursa Faculdade?</th>
							<th width="20"></th>
							<th width="20">
								<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalDependente()">
									<i class="fa fa-plus-circle"></i>
								</button>
							</th>
						</thead>
						<tbody>
							<tr ng-repeat="dependente in colaborador.cooperator.dependentes | filter: { flg_removido: false }">
								<td class="text-middle">{{ dependente.nme_dependente }}</td>
								<td class="text-center text-middle">{{ dependente.nme_tipo_dependencia }}</td>
								<td class="text-center text-middle">{{ dependente.dta_nascimento | date : 'dd/MM/yyyy'}}</td>
								<td class="text-center text-middle">{{ (dependente.flg_plano_saude === '1') ? dependente.nme_plano_saude : 'Não optante' }}</td>
								<td class="text-center text-middle">{{ (dependente.flg_curso_superior) ? 'Sim' : 'Não' }}</td>
								<td class="text-center text-middle">
									<button type="button" class="btn btn-xs btn-warning" ng-click="editDependente(dependente)">
										<i class="fa fa-edit"></i>
									</button>
								</td>
								<td class="text-center text-middle">
									<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(dependente)">
										<i class="fa fa-trash-o"></i>
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
	<div class="panel-footer clearfix">
		<div class="pull-right">
			<button class="btn btn-success btn-labeled fa fa-save" ng-click="enviarDadosParaAtualizacao()">Enviar dados p/ atualização</button>
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
								<input type="text" class="form-control" ng-model="tmpModal.num_ddd">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 control-label">Número</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" ng-model="tmpModal.num_telefone">
							</div>
						</div>
					</div>



					<div class="modal-footer clearfix">
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
								<input type="text" class="form-control" ng-model="tmpModal.end_email">
							</div> 
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addEmail()">Salvar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>