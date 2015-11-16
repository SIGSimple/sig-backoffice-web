<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListLancamentosFinanceirosCtrl">
	<div class="panel-body">
		<div class="pad-btm form-inline">
			<div class="row">
				<div class="table-toolbar-left">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="input-group date">
							<input type="text" class="form-control" ng-model="filtro.dta_inicio" placeholder="De">
							<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="input-group date">
							<input type="text" class="form-control" ng-model="filtro.dta_fim" placeholder="Até">
							<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<select chosen
							options="camposFiltro"
							ng-model="filtro.nme_campo_filtro"
							ng-options="campo.nme_campo as campo.dsc_campo for campo in camposFiltro"
							style="width: 100px;">
						</select>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<button type="button" class="btn btn-primary btn-labeled fa fa-filter" ng-click="loadSaldoAnterior()">Filtar Lançamentos</button>
					</div>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-hover table-striped">
				<thead>
					<th>Ações</th>
					<th>Dta. Vencimento</th>
					<th>Dta. Pagamento</th>
					<th>Origem da Despesa</th>
					<th>Descrição Despesa</th>
					<th class="text-center">Crédito</th>
					<th class="text-center">Débito</th>
					<th class="text-center">Saldo</th>
				</thead>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="5">Saldo Anterior</td>
						<td class="text-right text-middle text-bold text-success">{{ vlrTotalCreditoAnterior | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold text-danger">{{ vlrTotalDebitoAnterior | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold {{ (vlrTotalSaldoAnterior > 0) ? 'text-info' : ((vlrTotalSaldoAnterior < 0) ? 'text-danger' : '') }}">{{ vlrTotalSaldoAnterior | currency : 'R$ ' : 2 }}</td>
					</tr>
				</tbody>
				<tbody>
					<tr ng-repeat="item in lancamentos" popover-template="'myPopoverTemplate.html'" popover-title="Detalhes do Lançamento" popover-placement="top" popover-trigger="mouseenter">
						<td class="text-center">
							<a class="btn btn-xs btn-warning" 
							   href="form-new-lancamento-financeiro?cod_lancamento_financeiro={{ item.cod_lancamento_financeiro }}" data-placement="top" tooltip="Editar lançamento">
						   		<i class="fa fa-edit"></i>
					   		</a>
						</td>
						<td class="text-center">{{ item.dta_vencimento | date : 'dd/MM/yyyy' }}</td>
						<td class="text-center">{{ item.dta_pagamento | date : 'dd/MM/yyyy' }}</td>
						<td>{{ item.dsc_origem }}</td>
						<td>{{ item.dsc_lancamento }}</td>
						<td class="text-right">
							<span class="text-success">{{ (item.cod_tipo_lancamento == 1) ? ((item.vlr_realizado > 0) ? item.vlr_realizado : item.vlr_previsto) : 0 | currency : 'R$ ' : 2 }}</span>
						</td>
						<td class="text-right">
							<span class="text-danger">{{ (item.cod_tipo_lancamento == 2) ? ((item.vlr_realizado > 0) ? item.vlr_realizado : item.vlr_previsto) : 0 | currency : 'R$ ' : 2 }}</span>
						</td>
						<td class="text-right {{ (item.vlr_saldo > 0) ? 'text-info' : ((item.vlr_saldo < 0) ? 'text-danger' : '') }}">{{ item.vlr_saldo | currency : 'R$ ' : 2 }}</td>
					</tr>
					<tr ng-hide="lancamentos.length > 0">
						<td colspan="8" class="text-center text-bold text-danger">Nenhum lançamento encontrado para o período selecionado!</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="5">Saldo do Período</td>
						<td class="text-right text-middle text-bold text-success">{{ vlrTotalCredito | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold text-danger">{{ vlrTotalDebito | currency : 'R$ ' : 2 }}</td>
						<td class="text-right text-middle text-bold {{ (vlrTotalSaldo > 0) ? 'text-info' : ((vlrTotalSaldo < 0) ? 'text-danger' : '') }}">{{ vlrTotalSaldo | currency : 'R$ ' : 2 }}</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="text-right text-middle text-bold" colspan="7">Saldo Final</td>
						<td class="text-right text-middle text-bold {{ (vlrSaldoFinal > 0) ? 'text-info' : ((vlrTotalSaldo < 0) ? 'text-danger' : '') }}">{{ vlrSaldoFinal | currency : 'R$ ' : 2 }}</td>
					</tr>
				</tbody>
			</table>

			<script type="text/ng-template" id="myPopoverTemplate.html">
				<strong>No. Nota/Fatura: </strong>{{ item.num_nota_fatura }}<br/>
				<strong>Cód. Lanç. Contábil: </strong>{{ item.num_lancamento_contabil }}<br/>
				<strong>No. Banco: </strong>{{ item.num_banco }}<br/>
				<strong>Descrição: </strong>{{ item.dsc_lancamento }}<br/>
				<strong>Competência: </strong>{{ item.dta_competencia | date : 'MM/yyyy' }}<br/>
				<strong>Emissão: </strong>{{ item.dta_emissao | date : 'dd/MM/yyyy' }}<br/>
				<strong>Vencimento: </strong>{{ item.dta_vencimento | date : 'dd/MM/yyyy' }}<br/>
				<strong>Pagamento: </strong>{{ item.dta_pagamento | date : 'dd/MM/yyyy' }}<br/>
				<strong>R$ Previsto: </strong>{{ item.vlr_previsto | currency : 'R$ ' : 2 }}<br/>
				<strong>R$ Realizado: </strong>{{ item.vlr_realizado | currency : 'R$ ' : 2 }}<br/>
				<strong>No. Conta Contábil: </strong>{{ item.dsc_conta_contabil }}<br/>
				<strong>Conta Contábil: </strong>{{ item.dsc_conta_contabil }}<br/>
				<strong>No. Natureza Operação: </strong>{{ item.num_natureza_operacao }}<br/>
				<strong>Natureza Operação: </strong>{{ item.dsc_natureza_operacao }}<br/>
			</script>
		</div>
	</div>
</div>
<!--===================================================-->