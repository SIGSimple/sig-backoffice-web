configBootstrapTable();

/*function actionsLancamentoFinanceiroFormatter(value, row, index) {
	return [
		'<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Lançamento" ',
			'href="form-new-lancamento-financeiro?cod_lancamento_financeiro='+ row.cod_lancamento_financeiro +'">',
			'<i class="fa fa-edit"></i>',
		'</a>'
	].join('');
}*/

app.controller('ListLancamentosFinanceirosCtrl', function($scope, $http, UserSrvc, FilterSrvc){
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
	$scope.planosConta 				= [];

	$scope.camposFiltro = FilterSrvc.getCamposFiltro();
	$scope.tiposDespesa = FilterSrvc.getTiposDespesa();
	$scope.filtro = FilterSrvc.getFilter();

	// Modal control
	$scope.tmpModal = {};
	var modalTablesColumns = {
		"empresas": [
			{
				field: 'nme_fantasia',
				title: 'Nome Fantasia'
			},
			{
				field: 'flg_ativo',
				title: 'Ativo?',
				formatter: ativoFormatter
			}
		],

		"colaboradores": [
			{
				field: 'nme_colaborador',
				title: 'Nome Colaborador'
			},
			{
				field: 'flg_ativo',
				title: 'Ativo?',
				formatter: ativoFormatter
			}
		],
		"terceiros": [
			{
				field: 'nme_terceiro',
				title: 'Nome Terceiro'
			}
		]
	};

	$scope.loadLancamentosFinanceiros = function() {
		var dtaInicio 	= moment($scope.filtro.dta_inicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFim 		= moment($scope.filtro.dta_fim, "DD/MM/YYYY").format("YYYY-MM-DD");

		var urlOptions = "";
		
		if(parseInt($scope.filtro.cod_tipo_lancamento,10) > 0)
			urlOptions += "&tlf->cod_tipo_lancamento=" + $scope.filtro.cod_tipo_lancamento;

		if($scope.filtro.dsc_lancamento != "" || $scope.filtro.dsc_lancamento.length > 0)
			urlOptions += "&tlf->dsc_lancamento=" + $scope.filtro.dsc_lancamento;

		if($scope.filtro.num_nota_fatura != "" || $scope.filtro.num_nota_fatura.length > 0)
			urlOptions += "&tlf->num_nota_fatura=" + $scope.filtro.num_nota_fatura;

		if(Object.keys($scope.filtro.favorecido.data).length > 0) {
			switch($scope.filtro.favorecido.type) {
				case "empresas": {
					urlOptions += "&ftlf->cod_favorecido_fornecedor=" + $scope.filtro.favorecido.data.cod_empresa;
					break;
				}
				case "colaboradores": {
					urlOptions += "&ftlf->cod_favorecido_colaborador=" + $scope.filtro.favorecido.data.cod_colaborador;
					break;
				}
				case "terceiros": {
					urlOptions += "&ftlf->cod_favorecido_terceiro=" + $scope.filtro.favorecido.data.cod_terceiro;
					break;
				}
			}
		}

		if(parseInt($scope.filtro.cod_natureza_operacao,10) > 0)
			urlOptions += "&tlf->cod_natureza_operacao=" + $scope.filtro.cod_natureza_operacao;

		var urlFitroData = "";
		switch($scope.filtro.cod_campo_filtro) {
			case "1": { // Venceu ou pagou no período
				urlFitroData = "(dta_vencimento[exp]=BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"' OR dta_pagamento BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"')";
				
				// Se preencheu o valor inicial e não preencheu o valor final
				if(parseFloat($scope.filtro.vlr_inicial) > 0 && (parseFloat($scope.filtro.vlr_final) == 0 || isNaN(parseFloat($scope.filtro.vlr_final)))) {
					// TODO: addClass('has-error')
					return;
				}
				// Se preencheu o valor final e não preencheu o valor inicial
				else if(parseFloat($scope.filtro.vlr_final) > 0 && (parseFloat($scope.filtro.vlr_inicial) == 0 || isNaN(parseFloat($scope.filtro.vlr_inicial)))) {
					$scope.filtro.vlr_inicial = 0;
					urlFitroData += "&(vlr_orcado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +" OR vlr_previsto BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +")";
				}
				// Valor Inicial e Valor Final estão preenchidos...
				else if(!isNaN(parseFloat($scope.filtro.vlr_inicial)) && !isNaN(parseFloat($scope.filtro.vlr_final))) {
					urlFitroData += "&(vlr_orcado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +" OR vlr_previsto BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +")";
				}

				break;
			}
			case "2": { // Vence no período
				urlFitroData = "(dta_vencimento[exp]=BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"')";

				// Se preencheu o valor inicial e não preencheu o valor final
				if(parseFloat($scope.filtro.vlr_inicial) > 0 && (parseFloat($scope.filtro.vlr_final) == 0 || isNaN(parseFloat($scope.filtro.vlr_final)))) {
					// TODO: addClass('has-error')
					return;
				}
				// Se preencheu o valor final e não preencheu o valor inicial
				else if(parseFloat($scope.filtro.vlr_final) > 0 && (parseFloat($scope.filtro.vlr_inicial) == 0 || isNaN(parseFloat($scope.filtro.vlr_inicial)))) {
					$scope.filtro.vlr_inicial = 0;
					urlFitroData += "&(vlr_orcado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +" OR vlr_previsto BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +")";
				}
				// Valor Inicial e Valor Final estão preenchidos...
				else if(!isNaN(parseFloat($scope.filtro.vlr_inicial)) && !isNaN(parseFloat($scope.filtro.vlr_final))) {
					urlFitroData += "&(vlr_orcado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +" OR vlr_previsto BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +")";
				}

				break;
			}
			case "3": { // Pago no período
				urlFitroData = "(dta_pagamento[exp]=BETWEEN '"+ dtaInicio +"' AND '"+ dtaFim +"')";

				// Se preencheu o valor inicial e não preencheu o valor final
				if(parseFloat($scope.filtro.vlr_inicial) > 0 && (parseFloat($scope.filtro.vlr_final) == 0 || isNaN(parseFloat($scope.filtro.vlr_final)))) {
					// TODO: addClass('has-error')
					return;
				}
				// Se preencheu o valor final e não preencheu o valor inicial
				else if(parseFloat($scope.filtro.vlr_final) > 0 && (parseFloat($scope.filtro.vlr_inicial) == 0 || isNaN(parseFloat($scope.filtro.vlr_inicial)))) {
					$scope.filtro.vlr_inicial = 0;
					urlFitroData += "&(vlr_orcado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +" OR vlr_previsto BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +")";
				}
				// Valor Inicial e Valor Final estão preenchidos...
				else if(!isNaN(parseFloat($scope.filtro.vlr_inicial)) && !isNaN(parseFloat($scope.filtro.vlr_final))) {
					urlFitroData += "&vlr_realizado[exp]=BETWEEN "+ $scope.filtro.vlr_inicial +" AND "+ $scope.filtro.vlr_final +"";
				}

				break;
			}
		}

		$scope.vlrTotalCredito 	= 0;
		$scope.vlrTotalDebito 	= 0;
		$scope.vlrTotalSaldo 	= 0;
		$scope.vlrSaldoFinal 	= 0;
		$scope.lancamentos 		= [];
		$scope.loadingData 		= true;

		$http.get(baseUrlApi()+"lancamentos-financeiros.json?nolimit=1&tlf->flg_excluido=0&tlf->cod_empreendimento="+ $scope.colaborador.user.cod_empreendimento +"&"+urlFitroData+urlOptions)
			.success(function(items){
				$scope.loadingData 		= false;
				$scope.lancamentos 		= items.rows;
				var vlrCreditos 		= 0;
				var vlrDebitos 			= 0;
				var vlrSaldo 			= 0;

				$.each($scope.lancamentos, function(index, lancamento) {
					vlrCreditos 			= (parseInt(lancamento.cod_tipo_lancamento) == 1) ? ((parseFloat(lancamento.vlr_realizado) > 0) ? parseFloat(lancamento.vlr_realizado) : parseFloat(lancamento.vlr_orcado)) : 0;
					vlrDebitos 				= (parseInt(lancamento.cod_tipo_lancamento) == 2) ? ((parseFloat(lancamento.vlr_realizado) > 0) ? parseFloat(lancamento.vlr_realizado) : parseFloat(lancamento.vlr_orcado)) : 0;
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

	$scope.toggleAdvancedFilter = function() {
		if($('.advanced-filter').hasClass('hide')) {
			$('.btn-advanced-filter').removeClass('hide');
			$('.btn-simple-filter').addClass('hide');
			$('.advanced-filter').removeClass('hide');
		}
		else {
			$('.btn-advanced-filter').addClass('hide');
			$('.btn-simple-filter').removeClass('hide');
			$('.advanced-filter').addClass('hide');
		}
	}

	$scope.loadData = function() {
		FilterSrvc.registerFilter(angular.copy($scope.filtro));
		$scope.loadSaldoAnterior();
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

	$scope.abreModal = function(type, itemData, isScope) {
		var rota = "";
		var obj = "";

		if(type == "FAVORECIDO"){
			rota = (isScope) ? $scope.filtro.favorecido.type : itemData.favorecido.type;
			obj = "favorecido";
		}
		else if(type == "TITULAR_MOVIMENTO"){
			rota = (isScope) ? $scope.filtro.titularMovimento.type : itemData.titularMovimento.type;
			obj = "titularMovimento";
		}

		if(isScope)
			itemData = $scope[itemData];

		$("#modalItemsLabel").text("LISTAGEM DE " + rota.replace("-"," de ").toUpperCase());
		$("#modalItems").modal("show");
		$('#mytable').bootstrapTable({
			url: baseUrlApi() + rota +".json",
			search: true,
			showRefresh: true,
			showToggle: true,
			showColumns: true,
			pageList: "[5, 10, 20, 50, 100, All]",
			pageSize: "5",
			pagination: true,
			sidePagination: "server",
			showPaginationSwitch: true,
			columns: modalTablesColumns[rota],
			onClickRow: function(row, $element) {
				itemData[obj].data = row;
				itemData[obj].type = rota;
				itemData[obj].label = $($element.find("td")[0]).text();
				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
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

	$scope.loadLancamentosVinculados = function(lancamentoFinanceiro) {
		if(lancamentoFinanceiro.lancamentosVinculados == null) {
			var cod_lancamento_pai = lancamentoFinanceiro.cod_lancamento_pai;
			if(cod_lancamento_pai == null || typeof(cod_lancamento_pai) == "undefined" || cod_lancamento_pai == "")
				cod_lancamento_pai = lancamentoFinanceiro.cod_lancamento_financeiro;
			var params = "tlf->flg_excluido=0&nolimit=1&(tlf->cod_lancamento_financeiro[exp]=="+ lancamentoFinanceiro.cod_lancamento_financeiro +"%20OR%20tlf.cod_lancamento_pai="+ cod_lancamento_pai +"%20OR%20tlf.cod_lancamento_financeiro="+ cod_lancamento_pai +")";
			$http.get(baseUrlApi()+"lancamentos-financeiros?"+params)
				.success(function(items){
					setTimeout(function() {
						lancamentoFinanceiro.lancamentosVinculados = items.rows;
					}, 500);
				});
		}
	}

	function loadPlanoContas() {
		$http.get(baseUrlApi()+'plano-contas')
			.success(function(items){
				$scope.planosConta = items;
			});
	}

	$scope.loadData();
	loadPlanoContas();
	$("div#container.effect").removeClass("mainnav-lg").addClass("mainnav-sm");
});