<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListLancamentosFinanceirosCtrl">
	<div class="panel-heading">
		<h3 class="panel-title">Listagem de Lançamentos Financeiros</h3>
	</div>
	<div class="panel-body">
		<div id="toolbar">
			<a href="form-new-lancamento-financeiro" class="btn btn-success btn-labeled fa fa-plus-square">
				Cadastrar Novo
			</a>
		</div>
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/lancamentos-financeiros.json?flg_excluido=0"
			data-search="true"
			data-toolbar="#toolbar"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-page-list="[5, 10, 20]"
			data-page-size="5"
			data-pagination="true"
			data-side-pagination="server"
			data-show-pagination-switch="true">
			<thead>
				<tr>
					<th data-visible="true" data-sortable="false" data-formatter="actionsLancamentoFinanceiroFormatter" data-align="center">Ações</th>
					<th data-visible="false" data-sortable="true" data-field="num_nota_fatura">No. Nota/Fatura</th>
					<th data-visible="false" data-sortable="true" data-field="num_lancamento_contabil">No. Lanç. Contábil</th>
					<th data-visible="false" data-sortable="true" data-field="num_documento_banco">No. Banco</th>
					<th data-visible="true" data-sortable="true" data-field="dta_emissao" data-formatter="dateFormatter" data-align="center">Dta. Emissão</th>
					<th data-visible="false" data-sortable="true" data-field="dta_competencia" data-formatter="dateFormatter" data-align="center">Dta. Competência</th>
					<th data-visible="false" data-sortable="true" data-field="dta_vencimento" data-formatter="dateFormatter" data-align="center">Dta. Vencimento</th>
					<th data-visible="true" data-sortable="true" data-field="dta_pagamento" data-formatter="dateFormatter" data-align="center">Dta. Pagamento</th>
					<th data-visible="true" data-sortable="true" data-field="dsc_lancamento">Descrição Despesa</th>
					<th data-visible="true" data-sortable="true" data-field="vlr_previsto" data-formatter="currencyFormatter" data-align="right">Valor Previsto</th>
					<th data-visible="true" data-sortable="true" data-field="vlr_realizado" data-formatter="currencyFormatter" data-align="right">Valor Realizado</th>
					<th data-visible="false" data-sortable="true" data-field="num_conta_contabil">No. Conta Contábil</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_conta_contabil">Conta Contábil</th>
					<th data-visible="false" data-sortable="true" data-field="num_natureza_operacao">No. Natureza da Operação</th>
					<th data-visible="true" data-sortable="true" data-field="dsc_natureza_operacao">Natureza da Operação</th>
					<th data-visible="true" data-sortable="true" data-field="dsc_origem">Origem da Despesa</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_observacao">Observações</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->