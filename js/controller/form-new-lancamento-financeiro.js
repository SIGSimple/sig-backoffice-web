$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroFinanceiroCtrl', function($scope, $http, UserSrvc, FilterSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.lancamentoFinanceiro = {
		favorecido: 				{},
		favorecidos: 				[],
		titularMovimento: 			{},
		anexos: 					[],
		cod_tipo_lancamento: 		2,
		tipoLancamento: 			"Despesa",
		flg_lancamento_aberto: 		false,
		flg_lancamento_recorrente: 	false,
		qtd_dias_recorrencia: 		0,
		vlr_orcado: 				0,
		vlr_previsto: 				0,
		vlr_realizado: 				0,
		vlr_juros: 					0,
		vlr_desconto: 				0,
		vlr_total_impostos: 		0,
		vlrTotalRespectivo: 		0,
		cod_conta_contabil: 		"7",
		cod_empreendimento: 		$scope.colaborador.user.cod_empreendimento
	};
	$scope.favorecido 			= "";
	$scope.titularMovimento 	= "";
	$scope.planosConta 			= [];
	$scope.contratos 			= [];
	$scope.qtdItensToAddTable 	= 1;
	$scope.canUpdateRecorrencia = true;

	$scope.filtro = angular.copy(FilterSrvc.getFilter());

	$scope.recorrencias = [{
		qtd_dias_recorrencia: 0,
		dsc_recorrencia: "Não se repete"
	},{
		qtd_dias_recorrencia: 7,
		dsc_recorrencia: "Sim, Semanalmente"
	},{
		qtd_dias_recorrencia: 30,
		dsc_recorrencia: "Sim, Mensalmente"
	},{
		qtd_dias_recorrencia: 365,
		dsc_recorrencia: "Sim, Anualmente"
	}]

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

				if(isScope) {
					// Verifica se está selecionando o favorecido...
					if(type == "FAVORECIDO") {
						// e atribui o mesmo favorecido para todos os titulares de movimento
						if(typeof($scope.lancamentoFinanceiro.favorecidos) != "undefined") {
							$.each($scope.lancamentoFinanceiro.favorecidos, function(index, favorecido) {
								favorecido.favorecido = itemData[obj];
							});
						}

						if(rota == "colaboradores") {
							itemData['titularMovimento'].data = row;
							itemData['titularMovimento'].type = rota;
							itemData['titularMovimento'].label = $($element.find("td")[0]).text();

							var cod_origem = "";

							if(typeof(row.cod_contrato) != "undefined")
								cod_origem = row.cod_contrato;
							else if(typeof(row.cod_origem) != "undefined")
								cod_origem = row.cod_origem;

							if(cod_origem != "")
								itemData.cod_origem_despesa =  cod_origem;
						}
					}

					// Verifica se é empresa e precisa apurar impostos
					/*if(rota == "empresas" && row.flg_apurar_impostos == "1") {
						$scope.lancamentoFinanceiro.flg_apurar_impostos = (row.flg_apurar_impostos == "1");
						
						if(!$scope.lancamentoFinanceiro.flg_apurar_impostos)
							$scope.clearTaxValues();

						// Verifica se tem que apurar o ISS
						if(row.num_aliquota_iss){
							$scope.lancamentoFinanceiro.flg_iss = true;
							$scope.lancamentoFinanceiro.num_percentual_iss 	= parseFloat(row.num_aliquota_iss);
							$(".input-switch[name='flg_iss']").attr("checked","checked");
						}

						// Verifica se tem que apurar o IRRF
						if(row.num_aliquota_irrf){
							$scope.lancamentoFinanceiro.flg_irrf = true;
							$scope.lancamentoFinanceiro.num_percentual_irrf = parseFloat(row.num_aliquota_irrf);
							$(".input-switch[name='flg_irrf']").attr("checked","checked");
						}

						// Verifica se tem que apurar o CSLL
						if(row.num_aliquota_csll){
							$scope.lancamentoFinanceiro.flg_csll = true;
							$scope.lancamentoFinanceiro.num_percentual_csll = parseFloat(row.num_aliquota_csll);
							$(".input-switch[name='flg_csll']").attr("checked","checked");
						}

						// Verifica se tem que apurar o INSS
						if(row.num_aliquota_inss){
							$scope.lancamentoFinanceiro.flg_inss = true;
							$scope.lancamentoFinanceiro.num_percentual_inss = parseFloat(row.num_aliquota_inss);
							$(".input-switch[name='flg_inss']").attr("checked","checked");
						}

						// Verifica se tem que apurar o PIS/PASEP
						if(row.num_aliquota_pis){
							$scope.lancamentoFinanceiro.flg_pis = true;
							$scope.lancamentoFinanceiro.num_percentual_pis 	= parseFloat(row.num_aliquota_pis);
							$(".input-switch[name='flg_pis']").attr("checked","checked");
						}

						// Verifica se tem que apurar o COFINS
						if(row.num_aliquota_cofins){
							$scope.lancamentoFinanceiro.flg_cofins = true;
							$scope.lancamentoFinanceiro.num_percentual_cofins = parseFloat(row.num_aliquota_cofins);
							$(".input-switch[name='flg_cofins']").attr("checked","checked");
							
						}

						// Recria os elementos html (checkbox like iOS switch)
						resetSwitchInput();

						// Recalcula valores
						$scope.calculaValorRealizado(true);
					}*/
				}
				
				if(type == "TITULAR_MOVIMENTO") {
					var cod_origem = "";

					if(typeof(row.cod_contrato) != "undefined")
						cod_origem = row.cod_contrato;
					else if(typeof(row.cod_origem) != "undefined")
						cod_origem = row.cod_origem;

					if(cod_origem != ""){
						if(isScope)
							itemData.cod_origem_despesa =  cod_origem;
						else
							itemData.cod_origem_correspondente = cod_origem;
					}
				}

				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}

	$scope.addItemTabela = function(object) {
		if(typeof($scope.lancamentoFinanceiro[object]) == "undefined" || $scope.lancamentoFinanceiro[object] == null)
			$scope.lancamentoFinanceiro[object] = [];

		if(object == 'favorecidos') {
			for(var i=0; i < parseInt($scope.qtdItensToAddTable, 10); i++) {
				var objectToAdd = {};
				objectToAdd = {
					favorecido: angular.copy($scope.lancamentoFinanceiro.favorecido),
					titularMovimento: {
						type: 'colaboradores'
					},
					dsc_observacao_adicional: "",
					vlr_correspondente: 0,
					flg_removido: false
				};
				$scope.lancamentoFinanceiro[object].push(objectToAdd);
			}
		}
		else if(object == 'anexos') {
			var objectToAdd = {};
			objectToAdd = {
				nme_anexo: "",
				dsc_observacoes_anexo: "",
				pth_anexo: "",
				dsc_tipo_anexo: "",
				flg_removido: false
			};
			$scope.lancamentoFinanceiro[object].push(objectToAdd);
		}
	}

	$scope.alteraFlagRecorrencia = function() {
		$scope.lancamentoFinanceiro.flg_lancamento_recorrente = ($scope.lancamentoFinanceiro.qtd_dias_recorrencia > 0);
	}

	$scope.desabilitaItem = function(item) {
		item.flg_removido = true;
		$scope.confereValorTotalRespectivo();
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

	$scope.clearTaxValues = function() {
		// Limpa os valores de apuração de impostos
		$scope.lancamentoFinanceiro.flg_iss 			= false;
		$scope.lancamentoFinanceiro.flg_irrf 			= false;
		$scope.lancamentoFinanceiro.flg_csll 			= false;
		$scope.lancamentoFinanceiro.flg_inss 			= false;
		$scope.lancamentoFinanceiro.flg_pis 			= false;
		$scope.lancamentoFinanceiro.flg_cofins 			= false;
		$scope.lancamentoFinanceiro.vlr_iss 			= 0;
		$scope.lancamentoFinanceiro.vlr_irrf 			= 0;
		$scope.lancamentoFinanceiro.vlr_csll 			= 0;
		$scope.lancamentoFinanceiro.vlr_inss 			= 0;
		$scope.lancamentoFinanceiro.vlr_pis 			= 0;
		$scope.lancamentoFinanceiro.vlr_cofins 			= 0;
		$scope.lancamentoFinanceiro.vlr_total_impostos 	= 0;

		$scope.calculaValorRealizado(false);
	}

	$scope.copyValorPrevistoEmpenhado = function() {
		$scope.lancamentoFinanceiro.vlr_previsto = angular.copy($scope.lancamentoFinanceiro.vlr_orcado);
		$scope.calculaValorRealizado(true);
	}

	$scope.calculaValorRealizado = function(flgCalculaImposto) {
		if(flgCalculaImposto) {
			$scope.calculaImposto('flg_iss');
			$scope.calculaImposto('flg_irrf');
			$scope.calculaImposto('flg_csll');
			$scope.calculaImposto('flg_inss');
			$scope.calculaImposto('flg_pis');
			$scope.calculaImposto('flg_cofins');
		}
		$scope.lancamentoFinanceiro.vlr_realizado = (($scope.lancamentoFinanceiro.vlr_previsto + $scope.lancamentoFinanceiro.vlr_juros) - $scope.lancamentoFinanceiro.vlr_desconto - $scope.lancamentoFinanceiro.vlr_total_impostos);
	}

	$scope.calculaImposto = function(imposto) {
		var vlr_base 				= $scope.lancamentoFinanceiro.vlr_previsto;
		var num_percentual_aliquota = $scope.lancamentoFinanceiro['num_percentual_'+imposto.substring(4, imposto.length)];
		var value_field 			= 'vlr_'+ imposto.substr(4,imposto.length);
		$scope.lancamentoFinanceiro[value_field] = (vlr_base * num_percentual_aliquota) / 100;
		$scope.calculaTotalImpostos();
		$scope.calculaValorRealizado(false);
	}

	$scope.calculaTotalImpostos = function() {
		$scope.lancamentoFinanceiro.vlr_total_impostos = 0;
		
		if($scope.lancamentoFinanceiro.vlr_iss)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_iss;
		
		if($scope.lancamentoFinanceiro.vlr_irrf)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_irrf;
		
		if($scope.lancamentoFinanceiro.vlr_csll)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_csll;
		
		if($scope.lancamentoFinanceiro.vlr_inss)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_inss;
		
		if($scope.lancamentoFinanceiro.vlr_pis)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_pis;
		
		if($scope.lancamentoFinanceiro.vlr_cofins)
			$scope.lancamentoFinanceiro.vlr_total_impostos += $scope.lancamentoFinanceiro.vlr_cofins;
	
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

	$scope.saveRecords = function() {
		$('.btn.fa-save').button('loading');

		var postData = angular.copy($scope.lancamentoFinanceiro);
		postData.cod_empreendimento = $scope.colaborador.user.cod_empreendimento;
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
					window.location.href = newUrl;
				}, 5000);
			})
			.error(function(message, status, headers, config){ // se a API retornar algum erro
				$('.btn.fa-save').button('reset');
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
			$http.get(baseUrlApi() + 'lancamentos-financeiros?tlf->cod_lancamento_financeiro=' + getUrlVars().cod_lancamento_financeiro)
				.success(function(response){
					$scope.lancamentoFinanceiro = response.rows[0];

					$scope.lancamentoFinanceiro.qtd_dias_recorrencia = parseInt($scope.lancamentoFinanceiro.qtd_dias_recorrencia, 10);
					
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
					if($scope.lancamentoFinanceiro.cod_tipo_recorrencia == "2")
						loadLancamentosVinculados();

					if(Boolean(getUrlParameter("copy")))
						$scope.lancamentoFinanceiro.cod_lancamento_financeiro = null;


					if(parseInt($scope.lancamentoFinanceiro.flg_lancamento_recorrente,10) == 1 || $scope.lancamentoFinanceiro.flg_lancamento_recorrente == true) {
						$scope.canUpdateRecorrencia = false;
						$scope.lancamentoFinanceiro.dsc_tipo_recorrencia = (parseInt($scope.lancamentoFinanceiro.cod_tipo_recorrencia,10) == 1) ? "Projeção" : "Parcelado";
						
						$.each($scope.recorrencias, function(index, recorrencia) {
							if(recorrencia.qtd_dias_recorrencia == parseInt($scope.lancamentoFinanceiro.qtd_dias_recorrencia,10))
								$scope.lancamentoFinanceiro.dsc_recorrencia = recorrencia.dsc_recorrencia;
						});
					}
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

	function loadLancamentosVinculados() {
		var cod_lancamento_pai = $scope.lancamentoFinanceiro.cod_lancamento_pai;
		if(cod_lancamento_pai == null || typeof(cod_lancamento_pai) == "undefined" || cod_lancamento_pai == "")
			cod_lancamento_pai = $scope.lancamentoFinanceiro.cod_lancamento_financeiro;
		var params = "flg_excluido=0&nolimit=1&(cod_lancamento_financeiro[exp]=="+ $scope.lancamentoFinanceiro.cod_lancamento_financeiro +"%20OR%20cod_lancamento_pai="+ cod_lancamento_pai +"%20OR%20cod_lancamento_financeiro="+ cod_lancamento_pai +")";
		$http.get(baseUrlApi()+"lancamentos-financeiros?"+params)
			.success(function(items){
				$scope.lancamentoFinanceiro.lancamentosVinculados = items.rows;
			});
	}

	$('.input-switch').on("change", function(e){
		if(!this.checked) {
			$scope.lancamentoFinanceiro['num_percentual_'+this.name.substr(4,this.name.length)] = null;
			$scope.lancamentoFinanceiro['vlr_'+this.name.substr(4,this.name.length)] = null;
		}

		$scope.lancamentoFinanceiro[this.name] = this.checked;
		$scope.calculaImposto(this.name);
	});

	loadPlanoContas();
	loadOrigens();
	loadDadosLancamentoFinanceiroByIdUrl();
});