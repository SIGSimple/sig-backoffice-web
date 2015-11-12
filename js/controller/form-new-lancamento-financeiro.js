$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroFinanceiroCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.lancamentoFinanceiro = {
		favorecido: {},
		favorecidos: [],
		titularMovimento: {},
		anexos: [],
		cod_tipo_lancamento: 2,
		tipoLancamento: "Despesa",
		abrirLancamento: false,
		vlr_previsto: 0,
		vlr_realizado: 0,
		vlrTotalRespectivo: 0
	};
	$scope.favorecido = "";
	$scope.titularMovimento = "";
	$scope.planosConta = [];
	$scope.contratos = [];

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

	$scope.abreModal = function(type, itemData, isScope) {
		var rota = "";
		var obj = "";

		if(type == "FAVORECIDO"){
			rota = (isScope) ? $scope.favorecido : itemData.favorecidoOption;
			obj = "favorecido";
		}
		else if(type == "TITULAR_MOVIMENTO"){
			rota = (isScope) ? $scope.titularMovimento : itemData.titularMovimentoOption;
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

				if(isScope && type == "FAVORECIDO") {
					$.each($scope.lancamentoFinanceiro.favorecidos, function(index, favorecido) {
						favorecido.favorecido = itemData[obj];
					});
				}

				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}

	$scope.addItemTabela = function(object) {
		var objectToAdd = {};

		if(object == 'favorecidos') {
			objectToAdd = {
				favorecido: angular.copy($scope.lancamentoFinanceiro.favorecido),
				titularMovimento: {},
				dsc_observacao_adicional: "",
				vlr_correspondente: 0,
				flg_removido: false
			};
		}
		else if(object == 'anexos') {
			objectToAdd = {
				nme_anexo: "",
				dsc_observacoes_anexo: "",
				pth_anexo: "",
				dsc_tipo_anexo: "",
				flg_removido: false
			};
		}

		$scope.lancamentoFinanceiro[object].push(objectToAdd);
	}

	$scope.confereValorTotalRespectivo = function() {
		$scope.lancamentoFinanceiro.vlrTotalRespectivo = 0;
		$.each($scope.lancamentoFinanceiro.favorecidos, function(index, favorecido) {
			if(!favorecido.flg_removido)
				$scope.lancamentoFinanceiro.vlrTotalRespectivo += parseFloat(favorecido.vlr_correspondente);
		});
	}

	$scope.validateVlrTotalRespectivo = function() {
		if((parseFloat($scope.lancamentoFinanceiro.vlr_realizado) > 0) && ($scope.lancamentoFinanceiro.vlrTotalRespectivo > parseFloat($scope.lancamentoFinanceiro.vlr_realizado)))
			return true;
		else if($scope.lancamentoFinanceiro.vlrTotalRespectivo > parseFloat($scope.lancamentoFinanceiro.vlr_previsto))
			return true;

		return false;
	}

	$scope.desabilitaItem = function(item) {
		item.flg_removido = true;
		$scope.confereValorTotalRespectivo();
	}

	$scope.copyValorPrevistoRealizado = function() {
		$scope.lancamentoFinanceiro.vlr_realizado = angular.copy($scope.lancamentoFinanceiro.vlr_previsto);
	}

	$scope.saveRecords = function() {
		var postData = angular.copy($scope.lancamentoFinanceiro);
		postData.dta_emissao 		= (postData.dta_emissao != "") ? moment(postData.dta_emissao, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_competencia 	= (postData.dta_competencia != "") ? moment(postData.dta_competencia, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_pagamento 		= (postData.dta_pagamento != "") ? moment(postData.dta_pagamento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_vencimento 	= (postData.dta_vencimento != "") ? moment(postData.dta_vencimento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";

		// remove as mensagens de erro dos campos obrigatórios
		/*$('[data-toggle="tooltip"]').removeAttr("data-toggle").removeAttr("data-placement").removeAttr("title").removeAttr("data-original-title");
		$(".element-group").removeClass("has-error");
		$("table thead").css("background-color","none").css("color","#515151");
		$(".form-fields span").css("background-color", "#fafafa").css("border-color","#CDD6E1").css("color","#515151");*/

		console.log(postData);

		$http.post(baseUrlApi()+'lancamento-financeiro', postData)
			.success(function(message, status, headers, config){
				showNotification("Salvo!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href;
					if(window.location.href.indexOf("?") != -1)
						newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					window.location.href = newUrl.replace("form-new-lancamento-financeiro", "list-lancamentos-financeiros");
				}, 3000);
			})
			.error(function(message, status, headers, config){ // se a API retornar algum erro
				if(status == 406){ // Not-Acceptable (Campos inválidos)
					showNotification("Atenção!", "Alguns campos obrigatórios não foram preenchidos.", null, 'page', status);
					// percorre a lista de campos devolvidos da API
					/*$.each(message, function(index, value) {
						// seleciona os elemento HTML de acordo com o campo mencionado
						var element = ($("[ng-model='lancamentoFinanceiro."+ index +"']").length > 0) ? $("[ng-model='lancamentoFinanceiro."+ index +"']") : $("[name='"+ index +"']");

						if(element.is("table")) // tratamento exclusivo para tabelas
				    		$(element).find("thead").css("background-color","#A94442").css("color","#FFFFFF");
				    	else if(element.is("span")) // tratamento exclusivo para spans
				    		$(element).css("border-color","#A94442").css("color","#A94442");
				    	else if(typeof(element.attr('flow-btn')) != "undefined")
				    		element = $(element).closest("span").css("background-color","#A94442").css("border-color","#A94442").css("color","#FFFFFF");

				    	// coloca a mensagem de erro no elemento HTML selecionado
			    		element.attr("data-toggle","tooltip").attr("data-placement","top").attr("title", value).attr("data-original-title", value);
			    		element.closest(".element-group").addClass("has-error");
					});*/

					// inicializa o tooltip para exibir o erro ao passar o mouse sobre o elemento HTML
					// $('[data-toggle="tooltip"]').tooltip();
				}
				else {
					showNotification(null, message, null, 'page', status);
				}
			});
	}

	function loadPlanoContas() {
		$http.get(baseUrlApi()+'plano-contas')
			.success(function(items){
				$scope.planosConta = items;
			});
	}

	function loadOrigens() {
		$http.get(baseUrlApi()+'origens?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.contratos = items.rows;
			});
	}

	loadPlanoContas();
	loadOrigens();
});