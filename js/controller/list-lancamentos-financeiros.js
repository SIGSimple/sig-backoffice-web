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
	$scope.lancamentos 				= [];
	$scope.loadingData 				= false;
	$scope.vlrTotalCredito 			= 0;
	$scope.vlrTotalDebito 			= 0;
	$scope.vlrTotalSaldo 			= 0;
	$scope.vlrTotalCreditoAnterior 	= 0;
	$scope.vlrTotalDebitoAnterior 	= 0;
	$scope.vlrTotalSaldoAnterior 	= 0;
	$scope.vlrSaldoFinal 			= 0;
	$scope.lancamentoFinanceiro 	= null;

	/*$scope.camposFiltro = [{
		nme_campo: "dta_emissao", 
		dsc_campo: "Data de Emissão"
	},{
		nme_campo: "dta_vencimento", 
		dsc_campo: "Data de Vencimento"
	},{
		nme_campo: "dta_pagamento", 
		dsc_campo: "Data de Pagamento"
	}];*/

	$scope.tiposDespesa = [{
		cod_tipo_lancamento: '0', 
		nme_tipo_despesa: "Todos"
	},{
		cod_tipo_lancamento: '1', 
		nme_tipo_despesa: "Receitas"
	},{
		cod_tipo_lancamento: '2', 
		nme_tipo_despesa: "Despesas"
	}];

	$scope.filtro = {
		dta_inicio: 			(typeof(getUrlParameter("fdi")) != "undefined") ? getUrlParameter("fdi") : getFirstDateOfMonthString(),
		dta_fim: 				(typeof(getUrlParameter("fdf")) != "undefined") ? getUrlParameter("fdf") : getLastDateOfMonthString(),
		// nme_campo_filtro: 		(typeof(getUrlParameter("fcf")) != "undefined") ? getUrlParameter("fcf") : $scope.camposFiltro[2].nme_campo,
		cod_tipo_lancamento: 	(typeof(getUrlParameter("ftl")) != "undefined") ? getUrlParameter("ftl") : $scope.tiposDespesa[0].cod_tipo_lancamento,
	};

	$scope.loadLancamentosFinanceiros = function() {
		var dtaInicio 	= moment($scope.filtro.dta_inicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFim 		= moment($scope.filtro.dta_fim, "DD/MM/YYYY").format("YYYY-MM-DD");

		$scope.vlrTotalCredito 	= 0;
		$scope.vlrTotalDebito 	= 0;
		$scope.vlrTotalSaldo 	= 0;
		$scope.vlrSaldoFinal 	= 0;
		$scope.lancamentos 		= [];
		$scope.loadingData 		= true;

		var urlOptions = "";
		if(parseInt($scope.filtro.cod_tipo_lancamento,10) > 0)
			urlOptions = "&tlf->cod_tipo_lancamento=" + $scope.filtro.cod_tipo_lancamento;

		$http.get(baseUrlApi()+"lancamentos-financeiros.json?nolimit=1&flg_excluido=0&tlf->cod_empreendimento="+ $scope.colaborador.user.cod_empreendimento +"&(dta_vencimento[exp]=BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"' OR dta_pagamento BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"')"+urlOptions)
			.success(function(items){
				$scope.loadingData 		= false;
				$scope.lancamentos 		= items.rows;
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
			})
			.error(function(message, status, headers, config){
				if(status === 404) {
					$scope.loadingData = false;
					$scope.lancamentos = [];
				}
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

	$scope.openModal = function(objectData, modal) {
		$scope.lancamentoFinanceiro = angular.copy(objectData);
		$("#"+modal).modal("show");
	}

	$scope.deleteRecord = function(deleteNextRecords) {
		var postData = {
			deleteNextRecords: deleteNextRecords,
			cod_lancamento_financeiro: $scope.lancamentoFinanceiro.cod_lancamento_financeiro, 	// lançamento que está sendo alterado
			cod_lancamento_pai: ($scope.lancamentoFinanceiro.cod_lancamento_pai) ? $scope.lancamentoFinanceiro.cod_lancamento_pai : "", 				// lançamento que está sendo alterado
			cod_usuario: $scope.colaborador.user.cod_usuario 									// usuário logado no sistema
		};

		$http.delete(baseUrlApi()+"lancamento-financeiro", {params: postData})
			.success(function(message, status, headers, config){
				$("#modalExcluiLancamento").modal("hide");
				showNotification("Excluído!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href;
					if(window.location.href.indexOf("?") != -1)
						newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					newUrl = newUrl.replace("form-new-lancamento-financeiro", "list-lancamentos-financeiros");
					newUrl += "?fdi="+ $scope.filtro.dta_inicio +"&fdf="+ $scope.filtro.dta_fim +"&ftl="+ $scope.filtro.cod_tipo_lancamento; // +"&fcf="+ $scope.filtro.nme_campo_filtro;
					window.location.href = newUrl;
				}, 5000);
			})
			.error(function(message, status, headers, config){
				showNotification(null, message, null, 'page', status);
			});
	}

	$scope.copyValorPrevistoRealizado = function() {
		$scope.lancamentoFinanceiro.vlr_realizado = angular.copy($scope.lancamentoFinanceiro.vlr_previsto);
	}

	$scope.confirmarPagamento = function() {
		// remove as mensagens de erro dos campos obrigatórios
		$('[data-toggle="tooltip"]').removeAttr("data-toggle").removeAttr("data-placement").removeAttr("title").removeAttr("data-original-title");
		$(".element-group").removeClass("has-error");
		$("table thead").css("background-color","none").css("color","#515151");
		$(".form-fields span").css("background-color", "#fafafa").css("border-color","#CDD6E1").css("color","#515151");
		$("a.chosen-single").css("border-color","#CDD6E1");

		var postData = angular.copy($scope.lancamentoFinanceiro);
		postData.dta_pagamento = (postData.dta_pagamento != null 	&& typeof(postData.dta_pagamento) != "undefined" 	&& postData.dta_pagamento != "" 	&& 	postData.dta_pagamento != "Invalid date") ? moment(postData.dta_pagamento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";

		$http.post(baseUrlApi()+"lancamento-financeiro/confirmar/pagamento", postData)
			.success(function(message, status, headers, config){
				$("#modalConfirmaPagamento").modal("hide");
				showNotification("Confirmado!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href;
					if(window.location.href.indexOf("?") != -1)
						newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					newUrl = newUrl.replace("form-new-lancamento-financeiro", "list-lancamentos-financeiros");
					newUrl += "?fdi="+ $scope.filtro.dta_inicio +"&fdf="+ $scope.filtro.dta_fim +"&ftl="+ $scope.filtro.cod_tipo_lancamento; // +"&fcf="+ $scope.filtro.nme_campo_filtro;
					window.location.href = newUrl;
				}, 5000);
			})
			.error(function(message, status, headers, config){
				if(status == 406){ // Not-Acceptable (Campos inválidos)
					showNotification("Atenção!", "Alguns campos obrigatórios não foram preenchidos.", null, 'page', status);
					// percorre a lista de campos devolvidos da API
					$.each(message, function(index, value) {
						// seleciona os elemento HTML de acordo com o campo mencionado
						var element = ($("#modalConfirmaPagamento [ng-model='lancamentoFinanceiro."+ index +"']").length > 0) ? $("#modalConfirmaPagamento [ng-model='lancamentoFinanceiro."+ index +"']") : $("[name='"+ index +"']");

						if(element.is("table")) // tratamento exclusivo para tabelas
				    		$(element).find("thead").css("background-color","#A94442").css("color","#FFFFFF");
				    	else if(element.is("span")) // tratamento exclusivo para spans
				    		$(element).css("border-color","#A94442").css("color","#A94442");
				    	else if(typeof(element.attr('flow-btn')) != "undefined")
				    		element = $(element).closest("span").css("background-color","#A94442").css("border-color","#A94442").css("color","#FFFFFF");
				    	else if(element.hasClass("chosen"))
				    		element = element.closest(".form-group").find("a.chosen-single").css("border-color","#A94442");

				    	// coloca a mensagem de erro no elemento HTML selecionado
		    			element.attr("data-toggle","tooltip").attr("data-placement","top").attr("title", value).attr("data-original-title", value);
			    		element.closest(".element-group").addClass("has-error");
					});

					// inicializa o tooltip para exibir o erro ao passar o mouse sobre o elemento HTML
					$('[data-toggle="tooltip"]').tooltip();
				}
				else {
					showNotification(null, message, null, 'page', status);
				}
			});
	}

	$scope.loadSaldoAnterior();

	$("div#container.effect").removeClass("mainnav-lg").addClass("mainnav-sm");
});