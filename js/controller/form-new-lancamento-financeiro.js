$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroFinanceiroCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.lancamentoFinanceiro = {
		favorecido: 			{},
		favorecidos: 			[],
		titularMovimento: 		{},
		anexos: 				[],
		cod_tipo_lancamento: 	2,
		tipoLancamento: 		"Despesa",
		flg_lancamento_aberto: 	false,
		vlr_previsto: 			0,
		vlr_realizado: 			0,
		vlrTotalRespectivo: 	0,
		cod_conta_contabil: 	"7",
		cod_empreendimento: 	$scope.colaborador.user.cod_empreendimento
	};
	$scope.favorecido 		= "";
	$scope.titularMovimento = "";
	$scope.planosConta 		= [];
	$scope.contratos 		= [];

	$scope.filtro = {
		dta_inicio: getUrlParameter("fdi"),
		dta_fim: getUrlParameter("fdf"),
		// nme_campo_filtro: getUrlParameter("fcf"),
		cod_tipo_lancamento: getUrlParameter("ftl")
	};

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
			rota = (isScope) ? $scope.lancamentoFinanceiro.favorecido.type : itemData.favorecido.type;
			obj = "favorecido";
		}
		else if(type == "TITULAR_MOVIMENTO"){
			rota = (isScope) ? $scope.lancamentoFinanceiro.titularMovimento.type : itemData.titularMovimento.type;
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

		if(typeof($scope.lancamentoFinanceiro[object]) == "undefined" || $scope.lancamentoFinanceiro[object] == null)
			$scope.lancamentoFinanceiro[object] = [];

		$scope.lancamentoFinanceiro[object].push(objectToAdd);
	}

	$scope.confereValorTotalRespectivo = function() {
		$scope.lancamentoFinanceiro.vlrTotalRespectivo = 0;
		$.each($scope.lancamentoFinanceiro.favorecidos, function(index, favorecido) {
			if(!favorecido.flg_removido) {
				$scope.lancamentoFinanceiro.vlrTotalRespectivo += parseFloat(favorecido.vlr_correspondente);
				$scope.lancamentoFinanceiro.vlrTotalRespectivo = parseFloat($scope.lancamentoFinanceiro.vlrTotalRespectivo.toFixed(2));
			}
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

	$scope.deleteRecord = function() {
		var postData = {
			cod_lancamento_financeiro: $scope.lancamentoFinanceiro.cod_lancamento_financeiro, 	// lançamento que está sendo alterado
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

	$scope.saveRecords = function() {
		var postData = angular.copy($scope.lancamentoFinanceiro);
		postData.dta_emissao 		= (postData.dta_emissao != null 	&& typeof(postData.dta_emissao) != "undefined" 		&& postData.dta_emissao != "" 		&& 	postData.dta_emissao != "Invalid date") ? moment(postData.dta_emissao, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_competencia 	= (postData.dta_competencia != null && typeof(postData.dta_competencia) != "undefined" 	&& postData.dta_competencia != "" 	&& 	postData.dta_competencia != "Invalid date") ? moment(postData.dta_competencia, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_pagamento 		= (postData.dta_pagamento != null 	&& typeof(postData.dta_pagamento) != "undefined" 	&& postData.dta_pagamento != "" 	&& 	postData.dta_pagamento != "Invalid date") ? moment(postData.dta_pagamento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_vencimento 	= (postData.dta_vencimento != null 	&& typeof(postData.dta_vencimento) != "undefined" 	&& postData.dta_vencimento != "" 	&& 	postData.dta_vencimento != "Invalid date") ? moment(postData.dta_vencimento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";

		// remove as mensagens de erro dos campos obrigatórios
		$('[data-toggle="tooltip"]').removeAttr("data-toggle").removeAttr("data-placement").removeAttr("title").removeAttr("data-original-title");
		$(".element-group").removeClass("has-error");
		$("table thead").css("background-color","none").css("color","#515151");
		$(".form-fields span").css("background-color", "#fafafa").css("border-color","#CDD6E1").css("color","#515151");
		$("a.chosen-single").css("border-color","#CDD6E1");

		$http.post(baseUrlApi()+'lancamento-financeiro', postData)
			.success(function(message, status, headers, config){
				showNotification("Salvo!", message, null, 'page', status);
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
			.error(function(message, status, headers, config){ // se a API retornar algum erro
				if(status == 406){ // Not-Acceptable (Campos inválidos)
					showNotification("Atenção!", "Alguns campos obrigatórios não foram preenchidos.", null, 'page', status);
					// percorre a lista de campos devolvidos da API
					$.each(message, function(index, value) {
						// seleciona os elemento HTML de acordo com o campo mencionado
						var element = ($("[ng-model='lancamentoFinanceiro."+ index +"']").length > 0) ? $("[ng-model='lancamentoFinanceiro."+ index +"']") : $("[name='"+ index +"']");

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

	function loadDadosLancamentoFinanceiroByIdUrl() {
		if(typeof getUrlVars().cod_lancamento_financeiro != "undefined") {
			$http.get(baseUrlApi() + 'lancamentos-financeiros?cod_lancamento_financeiro=' + getUrlVars().cod_lancamento_financeiro)
				.success(function(response){
					$scope.lancamentoFinanceiro = response.rows[0];
					
					if($scope.lancamentoFinanceiro.vlr_previsto != null && (!isNaN($scope.lancamentoFinanceiro.vlr_previsto)))
						$scope.lancamentoFinanceiro.vlr_previsto = parseFloat(parseFloat($scope.lancamentoFinanceiro.vlr_previsto).toFixed(2))
					
					if($scope.lancamentoFinanceiro.vlr_realizado != null && (!isNaN($scope.lancamentoFinanceiro.vlr_realizado)))
						$scope.lancamentoFinanceiro.vlr_realizado = parseFloat(parseFloat($scope.lancamentoFinanceiro.vlr_realizado).toFixed(2))
					
					$scope.lancamentoFinanceiro.flg_lancamento_aberto 	= ($scope.lancamentoFinanceiro.flg_lancamento_aberto == 1);
					$scope.lancamentoFinanceiro.dta_emissao 			= ($scope.lancamentoFinanceiro.dta_emissao != null) ? moment($scope.lancamentoFinanceiro.dta_emissao, "YYYY-MM-DD").format("DD/MM/YYYY") : null;
					$scope.lancamentoFinanceiro.dta_competencia 		= ($scope.lancamentoFinanceiro.dta_competencia != null) ? moment($scope.lancamentoFinanceiro.dta_competencia, "YYYY-MM-DD").format("DD/MM/YYYY") : null;
					$scope.lancamentoFinanceiro.dta_pagamento 			= ($scope.lancamentoFinanceiro.dta_pagamento != null) ? moment($scope.lancamentoFinanceiro.dta_pagamento, "YYYY-MM-DD").format("DD/MM/YYYY") : null;
					$scope.lancamentoFinanceiro.dta_vencimento 			= ($scope.lancamentoFinanceiro.dta_vencimento != null) ? moment($scope.lancamentoFinanceiro.dta_vencimento, "YYYY-MM-DD").format("DD/MM/YYYY") : null;

					loadFavorecidosTitularesLancamento();

					if(Boolean(getUrlParameter("copy")))
						$scope.lancamentoFinanceiro.cod_lancamento_financeiro = null;
				});
		}
	}

	function loadFavorecidosTitularesLancamento() {
		$http.get(baseUrlApi() + 'lancamento-financeiro/favorecidos-titulares?ftlf->flg_excluido=0&ftlf->cod_lancamento_financeiro=' + getUrlVars().cod_lancamento_financeiro)
			.success(function(response){
				if(!$scope.lancamentoFinanceiro.flg_lancamento_aberto) {
					var objData = {},
						objType = "",
						objLabel = "";

					// Preenche os dados do Favorecido
					if(response[0].cod_favorecido_fornecedor != null) {
						objData.cod_empresa = response[0].cod_favorecido_fornecedor
						objType = "empresas";
						objLabel = response[0].nme_fantasia_favorecido;
					}
					else if(response[0].cod_favorecido_colaborador != null) {
						objData.cod_colaborador = response[0].cod_favorecido_colaborador;
						objType = "colaboradores";
						objLabel = response[0].nme_colaborador_favorecido;
					}
					else if(response[0].cod_favorecido_terceiro != null) {
						objData.cod_colaborador = response[0].cod_favorecido_terceiro;
						objType = "terceiros";
						objLabel = response[0].nme_terceiro_favorecido;
					}

					$scope.lancamentoFinanceiro.favorecido = {
						data: objData,
						type: objType,
						label: objLabel
					};

					// Preenche os dados do Titular do Movimento
					if(response[0].cod_titular_fornecedor != null) {
						objData.cod_empresa = response[0].cod_titular_fornecedor;
						objType = "empresas";
						objLabel = response[0].nme_fantasia_titular;
					}
					else if(response[0].cod_titular_colaborador != null) {
						objData.cod_colaborador = response[0].cod_titular_colaborador;
						objType = "colaboradores";
						objLabel = response[0].nme_colaborador_titular;
					}
					else if(response[0].cod_titular_terceiro != null) {
						objData.cod_terceiro = response[0].cod_titular_terceiro;
						objType = "terceiros";
						objLabel = response[0].nme_terceiro_titular;
					}

					$scope.lancamentoFinanceiro.titularMovimento = {
						data: objData,
						type: objType,
						label: objLabel
					};
				}
				else {
					var objData = {},
						objType = "",
						objLabel = "";

					// Preenche os dados do Favorecido
					if(response[0].cod_favorecido_fornecedor != null) {
						objData.cod_empresa = response[0].cod_favorecido_fornecedor;
						objType = "empresas";
						objLabel = response[0].nme_fantasia_favorecido;
					}
					else if(response[0].cod_favorecido_colaborador != null) {
						objData.cod_colaborador = response[0].cod_favorecido_colaborador;
						objType = "colaboradores";
						objLabel = response[0].nme_colaborador_favorecido;
					}
					else if(response[0].cod_favorecido_terceiro != null) {
						objData.cod_terceiro = response[0].cod_favorecido_terceiro;
						objType = "terceiros";
						objLabel = response[0].nme_terceiro_favorecido;
					}

					$scope.lancamentoFinanceiro.favorecido = {
						data: objData,
						type: objType,
						label: objLabel
					};

					$scope.lancamentoFinanceiro.favorecidos = [];

					$.each(response, function(index, item) {
						item.flg_removido = false;
						item.favorecido = angular.copy($scope.lancamentoFinanceiro.favorecido);

						var objData = {},
							objType = "",
							objLabel = "";

						// Preenche os dados do Titular do Movimento
						if(item.cod_titular_fornecedor != null) {
							objData.cod_empresa = item.cod_titular_fornecedor;
							objType = "empresas";
							objLabel = item.nme_fantasia_titular;
						}
						else if(item.cod_titular_colaborador != null) {
							objData.cod_colaborador = item.cod_titular_colaborador;
							objType = "colaboradores";
							objLabel = item.nme_colaborador_titular;
						}
						else if(item.cod_titular_terceiro != null) {
							objData.cod_terceiro = item.cod_titular_terceiro;
							objType = "terceiros";
							objLabel = item.nme_terceiro_titular;
						}

						item.titularMovimento = {
							data: objData,
							type: objType,
							label: objLabel
						};

						$scope.lancamentoFinanceiro.favorecidos.push(item);

						$scope.confereValorTotalRespectivo();
					});
				}
			})
			.error(function(message, status, headers, config) {
				$scope.lancamentoFinanceiro.favorecidos = [];
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
	loadDadosLancamentoFinanceiroByIdUrl();
});