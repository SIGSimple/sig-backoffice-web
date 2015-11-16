configBootstrapTable();

/*function actionsLancamentoFinanceiroFormatter(value, row, index) {
	return [
		'<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Lançamento" ',
			'href="form-new-lancamento-financeiro?cod_lancamento_financeiro='+ row.cod_lancamento_financeiro +'">',
			'<i class="fa fa-edit"></i>',
		'</a>'
	].join('');
}*/

app.controller('ListLancamentosFinanceirosCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.lancamentos 			= [];
	$scope.vlrTotalCredito 			= 0;
	$scope.vlrTotalDebito 			= 0;
	$scope.vlrTotalSaldo 			= 0;
	$scope.vlrTotalCreditoAnterior 	= 0;
	$scope.vlrTotalDebitoAnterior 	= 0;
	$scope.vlrTotalSaldoAnterior 	= 0;
	$scope.vlrSaldoFinal 			= 0;

	$scope.camposFiltro = [{
		nme_campo: "dta_emissao", 
		dsc_campo: "Data de Emissão"
	},{
		nme_campo: "dta_vencimento", 
		dsc_campo: "Data de Vencimento"
	},{
		nme_campo: "dta_pagamento", 
		dsc_campo: "Data de Pagamento"
	}]

	$scope.filtro = {
		dta_inicio: getFirstDateOfMonthString(),
		dta_fim: getLastDateOfMonthString(),
		nme_campo_filtro: $scope.camposFiltro[2].nme_campo
	};

	$scope.loadLancamentosFinanceiros = function() {
		var dtaInicio 	= moment($scope.filtro.dta_inicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFim 		= moment($scope.filtro.dta_fim, "DD/MM/YYYY").format("YYYY-MM-DD");

		$scope.vlrTotalCredito 	= 0;
		$scope.vlrTotalDebito 	= 0;
		$scope.vlrTotalSaldo 	= 0;
		$scope.vlrSaldoFinal 	= 0;
		$scope.lancamentos 		= [];

		$http.get(baseUrlApi()+"lancamentos-financeiros.json?nolimit=1&"+ $scope.filtro.nme_campo_filtro +"[exp]=BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"' &flg_excluido=0&tlf->cod_empreendimento="+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.lancamentos = items.rows;
				var vlrCreditos 		= 0;
				var vlrDebitos 			= 0;
				var vlrSaldo 			= 0;

				$.each($scope.lancamentos, function(index, lancamento) {
					vlrCreditos 			= (parseInt(lancamento.cod_tipo_lancamento) == 1) ? ((parseFloat(lancamento.vlr_realizado) > 0) ? parseFloat(lancamento.vlr_realizado) : parseFloat(lancamento.vlr_previsto)) : 0;
					vlrDebitos 				= (parseInt(lancamento.cod_tipo_lancamento) == 2) ? ((parseFloat(lancamento.vlr_realizado) > 0) ? parseFloat(lancamento.vlr_realizado) : parseFloat(lancamento.vlr_previsto)) : 0;
					vlrSaldo 				= (index == 0) ? (($scope.vlrTotalSaldoAnterior + vlrCreditos) - vlrDebitos) : (($scope.lancamentos[index-1].vlr_saldo +  vlrCreditos) - vlrDebitos);
					lancamento.vlr_saldo 	= vlrSaldo;

					$scope.vlrTotalCredito 	+= vlrCreditos;
					$scope.vlrTotalDebito 	+= vlrDebitos;
					$scope.vlrTotalSaldo 	= ($scope.vlrTotalCredito - $scope.vlrTotalDebito);
					$scope.vlrSaldoFinal 	= ($scope.vlrTotalSaldoAnterior - ($scope.vlrTotalSaldo * -1));
				});
			});
	}

	$scope.loadSaldoAnterior = function() {
		var dtaInicio 	= moment($scope.filtro.dta_inicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		
		$http.get(baseUrlApi()+'lancamentos-financeiros/saldo-anterior/'+dtaInicio)
			.success(function(item){
				$scope.vlrTotalCreditoAnterior 	= 0;
				$scope.vlrTotalDebitoAnterior 	= 0;
				$scope.vlrTotalSaldoAnterior 	= 0;

				if(item.vlr_credito != null) {
					$scope.vlrTotalCreditoAnterior 	= item.vlr_credito;
					$scope.vlrTotalDebitoAnterior 	= item.vlr_debito;
					$scope.vlrTotalSaldoAnterior 	= item.vlr_saldo;
				}

				$scope.loadLancamentosFinanceiros();
			});
	}

	$scope.loadSaldoAnterior();
});