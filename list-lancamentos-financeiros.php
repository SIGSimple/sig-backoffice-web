<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListLancamentosFinanceirosCtrl">
	<div class="panel-body">
		<div class="pad-btm">
			<div class="row">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<label class="control-label">De</label>
					<div class="controls">
						<div class="input-group date">
							<input type="text" class="form-control" ng-model="filtro.dta_inicio" placeholder="De">
							<span class="input-group-addon btn-default"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<label class="control-label">Até</label>
					<div class="controls">
						<div class="input-group date">
							<input type="text" class="form-control" ng-model="filtro.dta_fim" placeholder="Até">
							<span class="input-group-addon btn-default"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<label class="control-label sr-only"></label>
					<div class="controls only-buttons">
						<button type="button" class="btn btn-default btn-labeled fa fa-filter" ng-click="toggleAdvancedFilter()">Filtro Avançado</button>
						<button type="button" class="btn btn-primary btn-labeled btn-simple-filter fa fa-search" ng-click="loadData()">Filtar</button>
						<a href="form-new-lancamento-financeiro" 
						class="btn btn-mint btn-labeled fa fa-plus-square">Novo</a>
					</div>
				</div>
			</div>

			<div class="advanced-filter hide bg-gray-light">
				<h4 class="bord-btm pad-top" style="padding-left: 5px;">Filtro Avançado</h4>

				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<label class="control-label">Descrição</label>
						<div class="controls">
							<input type="text" class="form-control" ng-model="filtro.dsc_lancamento" placeholder="Ex.: Reembolso de Despesas">
						</div>
					</div>

					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="control-label">No. Nota/Fatura</label>
						<div class="controls">
							<input type="text" class="form-control" ng-model="filtro.num_nota_fatura" placeholder="Ex.: AMGT-02437">
						</div>
					</div>

					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="control-label">De</label>
						<div class="controls">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" class="form-control" ng-model="filtro.vlr_inicial" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="control-label">Até</label>
						<div class="controls">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" class="form-control" ng-model="filtro.vlr_final" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
						<label class="control-label">Tipo de Lançamento</label>
						<div class="controls">
							<select chosen
								options="tiposDespesa"
								ng-model="filtro.cod_tipo_lancamento"
								ng-options="tipoDespesa.cod_tipo_lancamento as tipoDespesa.nme_tipo_despesa for tipoDespesa in tiposDespesa"
								style="width: 100px;">
							</select>
						</div>
					</div>				
				</div>

				<div class="row mar-top">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<label class="control-label">
							Favorecido
							<label class="radio-inline"><input type="radio" ng-click="filtro.favorecido.type = 'empresas'" ng-checked="(filtro.favorecido.type == 'empresas')">Empresa</label>
							<label class="radio-inline"><input type="radio" ng-click="filtro.favorecido.type = 'colaboradores'" ng-checked="(filtro.favorecido.type == 'colaboradores')">Colaborador</label>
							<label class="radio-inline"><input type="radio" ng-click="filtro.favorecido.type = 'terceiros'" ng-checked="(filtro.favorecido.type == 'terceiros')">Terceiros</label>
						</label>
						<div class="controls">
							<div class="input-group">
								<input type="text" class="form-control" readonly="readonly" value="{{ filtro.favorecido.label }}" ng-click="abreModal('FAVORECIDO', 'filtro', true)">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" ng-click="abreModal('FAVORECIDO', 'filtro', true)">
										<i class="fa fa-search"></i>
									</button>
									<button type="button" class="btn btn-default" tooltip="Limpar seleção" ng-click="filtro.favorecido = {data:{},type:'',label:''}">
										<i class="fa fa-times"></i>
									</button>
								</span>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
						<label class="control-label">Natureza da Operação</label>
						<div class="controls">
							<div class="input-group">
								<select chosen class="chosen" options="planosConta"
									ng-model="filtro.cod_natureza_operacao"
									ng-options="item.cod_item as ('(' + item.num_item + ') ' + item.dsc_item) for item in planosConta">
								</select>
								<span class="input-group-btn">
									<button type="button" class="btn btn-default" tooltip="Limpar seleção" ng-click="filtro.cod_natureza_operacao = ''">
										<i class="fa fa-times"></i>
									</button>
								</span>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<label class="control-label">Controle de Datas</label>
						<div class="controls">
							<select chosen
								options="camposFiltro"
								ng-model="filtro.cod_campo_filtro"
								ng-options="campo.cod_campo as campo.dsc_campo for campo in camposFiltro"
								style="width: 100px;">
							</select>
						</div>
					</div>
				</div>

				<div class="row mar-top pad-btm">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
						<button type="button" class="btn btn-primary btn-labeled btn-advanced-filter fa fa-search pull-right" ng-click="loadData()">Filtar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-hover table-striped">
				<thead>
					<th width="130" class="text-center text-middle">Ações</th>
					<th class="text-middle">Dta. Vencimento</th>
					<th class="text-middle">Dta. Pagamento</th>
					<th class="text-middle">Favorecido</th>
					<th class="text-middle">Descrição Despesa</th>
					<th class="text-center text-middle" width="130">Crédito</th>
					<th class="text-center text-middle" width="130">Débito</th>
					<th class="text-center text-middle" width="130">Saldo</th>
					<th class="text-center text-middle" width="25">Status</th>
				</thead>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="5">Saldo Anterior</td>
						<td class="text-right text-middle text-bold text-success">{{ vlrTotalCreditoAnterior | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold text-danger">{{ vlrTotalDebitoAnterior | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold {{ (vlrTotalSaldoAnterior > 0) ? 'text-info' : ((vlrTotalSaldoAnterior < 0) ? 'text-danger' : '') }}">{{ vlrTotalSaldoAnterior | currency : 'R$ ' : 2 }}</td>
						<td></td>
					</tr>
				</tbody>
				<tbody>
					<tr ng-repeat="item in lancamentos">
						<td class="text-middle">
							<button type="button" class="btn btn-xs btn-danger" data-placement="top" tooltip="Excluir lançamento" ng-click="openModal(item, 'modalExcluiLancamento')">
						   		<i class="fa fa-trash-o"></i>
					   		</button>

							<a class="btn btn-xs btn-warning" 
							   href="form-new-lancamento-financeiro?cod_lancamento_financeiro={{ item.cod_lancamento_financeiro }}" 
							   data-placement="top" tooltip="Editar lançamento">
						   		<i class="fa fa-edit"></i>
					   		</a>

					   		<button type="button" class="btn btn-xs btn-default" data-placement="top" tooltip="Pré-visualizar detalhes"
					   			popover-template="'popoverDetails.html'" popover-title="Detalhes do Lançamento" popover-placement="bottom" popover-trigger="focus">
						   		<i class="fa fa-eye"></i>
					   		</button>

					   		<button type="button" class="btn btn-xs btn-primary {{ (item.flg_lancamento_recorrente === '0') ? 'hide' : '' }}" data-placement="top" tooltip="Lançamentos vinculados"
					   			ng-click="loadLancamentosVinculados(item)"
					   			popover-template="'popoverLancamentosVinculados.html'" popover-title="Lançamentos Vinculados" popover-placement="bottom" popover-trigger="focus">
						   		<i class="fa fa-refresh"></i>
					   		</button>

					   		<button type="button" class="btn btn-xs btn-success {{ (item.dta_pagamento) ? 'hide' : '' }}" 
					   			data-placement="top" tooltip="Confirmar pagamento" ng-click="openModal(item, 'modalConfirmaPagamento')">
						   		<i class="fa fa-check-circle"></i>
					   		</button>
						</td>
						<td class="text-center">{{ item.dta_vencimento | date : 'dd/MM/yyyy' }}</td>
						<td class="text-center">{{ item.dta_pagamento | date : 'dd/MM/yyyy' }}</td>
						<td>{{ item.nme_favorecido }}</td>
						<td>{{ item.dsc_lancamento }}</td>
						<td class="text-right">
							<span class="text-success" ng-show='(item.cod_tipo_lancamento == 1 && (item.vlr_orcado != "" || item.vlr_realizado != ""))'>{{ (item.cod_tipo_lancamento == 1) ? ((item.vlr_realizado > 0) ? item.vlr_realizado : item.vlr_orcado) : 0 | currency : 'R$ ' : 2 }}</span>
						</td>
						<td class="text-right">
							<span class="text-danger" ng-show='(item.cod_tipo_lancamento == 2 && (item.vlr_orcado != "" || item.vlr_realizado != ""))'>{{ (item.cod_tipo_lancamento == 2) ? ((item.vlr_realizado > 0) ? item.vlr_realizado : item.vlr_orcado) : 0 | currency : 'R$ ' : 2 }}</span>
						</td>
						<td class="text-right {{ (item.vlr_saldo > 0) ? 'text-info' : ((item.vlr_saldo < 0) ? 'text-danger' : '') }}">{{ item.vlr_saldo | currency : 'R$ ' : 2 }}</td>
						<td class="text-center text-middle">
							<span class="label label-table {{ (item.dta_pagamento) ? 'label-success' : 'label-warning' }}" 
								data-placement="top" tooltip="{{ (item.dta_pagamento) ? 'Lançamento pago' : 'Lançamento previsto' }}">
								<i class="fa fa-check-circle {{ (!item.dta_pagamento) ? 'hide' : '' }}"></i>
								<i class="fa fa-calendar {{ (item.dta_pagamento) ? 'hide' : '' }}"></i>
							</span>
						</td>
					</tr>
					<tr ng-show="loadingData">
						<td colspan="9" class="text-center text-bold"><i class="fa fa-spinner fa-spin"></i> Aguarde! Carregando lançamentos...</td>
					</tr>
					<tr ng-show="(!loadingData) && (lancamentos.length === 0)">
						<td colspan="9" class="text-center text-bold text-danger">Nenhum lançamento encontrado para o período selecionado!</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="5">Saldo do Período</td>
						<td class="text-right text-middle text-bold text-success">{{ vlrTotalCredito | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold text-danger">{{ vlrTotalDebito | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold {{ (vlrTotalSaldo > 0) ? 'text-info' : ((vlrTotalSaldo < 0) ? 'text-danger' : '') }}">{{ vlrTotalSaldo | currency : 'R$ ' : 2 }}</td>
						<td></td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="7">Saldo Final</td>
						<td class="text-right text-middle text-bold {{ (vlrSaldoFinal > 0) ? 'text-info' : ((vlrTotalSaldo < 0) ? 'text-danger' : '') }}">{{ vlrSaldoFinal | currency : 'R$ ' : 2 }}</td>
						<td></td>
					</tr>
				</tbody>
			</table>

			<script type="text/ng-template" id="popoverDetails.html">
				<strong>No. Nota/Fatura: </strong>{{ item.num_nota_fatura }}<br/>
				<strong>Cód. Lanç. Contábil: </strong>{{ item.num_lancamento_contabil }}<br/>
				<strong>No. Banco: </strong>{{ item.num_banco }}<br/>
				<strong>Descrição: </strong>{{ item.dsc_lancamento }}<br/>
				<strong>Competência: </strong>{{ item.dta_competencia | date : 'MM/yyyy' }}<br/>
				<strong>Emissão: </strong>{{ item.dta_emissao | date : 'dd/MM/yyyy' }}<br/>
				<strong>Vencimento: </strong>{{ item.dta_vencimento | date : 'dd/MM/yyyy' }}<br/>
				<strong>Pagamento: </strong>{{ item.dta_pagamento | date : 'dd/MM/yyyy' }}<br/>
				<strong>R$ Previsto: </strong>{{ item.vlr_orcado | currency : 'R$ ' : 2 }}<br/>
				<strong>R$ Realizado: </strong>{{ item.vlr_realizado | currency : 'R$ ' : 2 }}<br/>
				<strong>No. Conta Contábil: </strong>{{ item.dsc_conta_contabil }}<br/>
				<strong>Conta Contábil: </strong>{{ item.dsc_conta_contabil }}<br/>
				<strong>No. Natureza Operação: </strong>{{ item.num_natureza_operacao }}<br/>
				<strong>Natureza Operação: </strong>{{ item.dsc_natureza_operacao }}<br/>
				<a class="btn btn-sm btn-block btn-warning" 
				   href="form-new-lancamento-financeiro?cod_lancamento_financeiro={{ item.cod_lancamento_financeiro }}" data-placement="top" tooltip="Editar lançamento">
			   		<i class="fa fa-edit"></i> Editar Lançamento
		   		</a>
			</script>

			<script type="text/ng-template" id="popoverLancamentosVinculados.html">
				<table class="table table-condensed table-hover">
					<thead>
						<th class="text-center text-middle" width="10">Nø.</th>
						<th class="text-center text-middle">Venc./Pgto.</th>
						<th class="text-right text-middle">Valor</th>
						<th class="text-center text-middle" width="10">Status</th>
					</thead>
					<tbody>
						<tr ng-repeat="(index, lv) in item.lancamentosVinculados" 
							class="{{ (lv.cod_lancamento_financeiro == item.cod_lancamento_financeiro) ? 'warning' : '' }} {{ (!item.lancamentosVinculados) ? 'hide' : '' }}">
							<td class="text-center text-middle">{{ (index+1) }}ø</td>
							<td class="text-center text-middle">{{ lv.dta_vencimento | date : 'dd/MM/yyyy' }}</td>
							<td class="text-right text-middle">{{ (lv.vlr_realizado > 0) ? lv.vlr_realizado : ((lv.vlr_previsto > 0) ? lv.vlr_previsto : lv.vlr_orcado) | currency : 'R$ ' : 2 }}</td>
							<td class="text-center text-middle">
								<span class="label label-table {{ (lv.dta_pagamento) ? 'label-success' : 'label-warning' }}" 
									tooltip=" {{ (lv.dta_pagamento) ? 'Lançamento pago' : 'Lançamento previsto' }}" tooltip-placement="right">
									<i class="fa {{ (lv.dta_pagamento) ? 'fa-check-circle text-success' : 'fa-calendar text-warning' }}"></i>
								</span>
							</td>
						</tr>
						<tr class="{{ (item.lancamentosVinculados) ? 'hide' : '' }}">
							<td colspan="4" class="text-center"><i class="fa fa-spinner fa-spin"></i> Aguarde, carregando...</td>
						</tr>
					</tbody>
				</table>
			</script>
		</div>
	</div>

	<div class="modal fade" id="modalConfirmaPagamento" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaPagamentoLabel">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirmar pagamento?</h4>
				</div>
				<form class="form form-horizontal" role="form">
					<div class="modal-body">
						<p>Para confirmar este pagamento, informe abaixo a data do pagamento e o valor efetivo:</p>

						<div class="form-group">
							<label class="col-lg-2 control-label">Descrição</label>
							<div class="col-lg-10">
								<input class="form-control" value="{{ lancamentoFinanceiro.dsc_lancamento }}" readonly="readonly">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Vencimento</label>
							<div class="col-lg-4">
								<input class="form-control" value="{{ lancamentoFinanceiro.dta_vencimento | date : 'dd/MM/yyyy' }}" readonly="readonly">
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Pagamento</label>
								<div class="col-lg-4">
									<div class="input-group date">
										<input type="text" class="form-control" ng-model="lancamentoFinanceiro.dta_pagamento">
										<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Previsto</label>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">R$</span>
									<input type="text" class="form-control" ng-model="lancamentoFinanceiro.vlr_orcado" readonly="readonly" ui-number-mask>
								</div>
							</div>

							<div class="element-group">
								<label class="col-lg-2 control-label">Realizado</label>
								<div class="col-lg-4">
									<div class="input-group">
										<span class="input-group-addon">R$</span>
										<input type="text" class="form-control" ng-model="lancamentoFinanceiro.vlr_realizado" ui-number-mask>
										<span class="input-group-addon btn-primary" 
											tooltip="Copiar Valor Previsto" 
											tooltip-placement="right" 
											ng-click="copyValorPrevistoRealizado()">
											<i class="fa fa-copy"></i>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Observações</label>
							<div class="col-lg-10">
								<textarea class="form-control" rows="5" ng-model="lancamentoFinanceiro.dsc_observacao"></textarea>
							</div>
						</div>
					</div>

					<div class="modal-footer clearfix">
						<div class="pull-right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success btn-labeled fa fa-check-circle" ng-click="confirmarPagamento()">Confirmar Pagamento</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalExcluiLancamento" tabindex="-1" role="dialog" aria-labelledby="modalExcluiLancamentoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirma exclusão?</h4>
				</div>
				<div class="modal-body">
					<p class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 1) ? 'hide' : '' }}">
						Confirma a exclusão do lançamento [<strong>{{ lancamentoFinanceiro.dsc_lancamento }}</strong>], com vencimento em [<strong>{{ (lancamentoFinanceiro.dta_vencimento) ? (lancamentoFinanceiro.dta_vencimento | date : 'dd/MM/yyyy' ) : (lancamentoFinanceiro.dta_pagamento | date : 'dd/MM/yyyy') }}</strong>]?
					</p>
					<p class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 0) ? 'hide' : '' }}">
						Este registro faz parte de um provisionamento com outras parcelas, deseja excluir este e os próximos lançamentos?
					</p>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<div class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 1) ? 'hide' : '' }}">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(false)">Sim</button>
						</div>

						<div class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 0) ? 'hide' : '' }}">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(true)">Sim, este e os próximos</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(false)">Não, apenas este</button>
						</div>
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
					<table id="mytable">
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
<!--===================================================-->