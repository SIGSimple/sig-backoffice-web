configBootstrapTable();

app.controller('CadastroPerfilAcessoCtrl', function($scope, $http){
	$scope.perfil = {
		modulos: []
	};

	$scope.save = function() {
		$(".btn.fa-save").button('loading');

		$http.post(baseUrlApi()+'colaborador', postData)
			.success(function(message, status, headers, config){
				$scope.sessionSaved = true;
				showNotification("Salvo!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					window.location.href = newUrl.replace("form-new-perfil-acesso", "list-perfis-acesso");
				}, 5000);
			})
			.error(function(message, status, headers, config){ // se a API retornar algum erro
				$(".btn.fa-save").button('reset');
				if(status == 406){ // Not-Acceptable (Campos inválidos)
					showNotification("Atenção!", "Alguns campos obrigatórios não foram preenchidos.", null, 'page', status);
					// percorre a lista de campos devolvidos da API
					$.each(message, function(index, value) {
						// seleciona os elemento HTML de acordo com o campo mencionado
						var element = ($("[ng-model='perfil."+ index +"']").length > 0) ? $("[ng-model='perfil."+ index +"']") : $("[name='"+ index +"']");

						if(element.is("table")) // tratamento exclusivo para tabelas
				    		$(element).find("thead").css("background-color","#A94442").css("color","#FFFFFF");
				    	else if(element.is("span")) // tratamento exclusivo para spans
				    		$(element).css("border-color","#A94442").css("color","#A94442");
				    	else if(typeof(element.attr('flow-btn')) != "undefined")
				    		element = $(element).closest("span").css("background-color","#A94442").css("border-color","#A94442").css("color","#FFFFFF");

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

	function loadDadosPerfilByUrlParam() {
		if(typeof getUrlVars().cod_perfil != "undefined") {
			$http.get(baseUrlApi()+'perfis?cod_perfil='+ getUrlVars().cod_perfil)
				.success(function(items) {
					loadModulosPerfil();
					$.extend($scope.perfil, items.rows[0]);
					if((typeof $scope.perfil.flg_ativo != "undefined") && (parseInt($scope.perfil.flg_ativo, 10) == 1)){
						var element = $("[ng-model='perfil.flg_ativo']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}
				});
		}
	}

	function loadModulosPerfil() {
		$http.get(baseUrlApi()+'perfil/'+ getUrlVars().cod_perfil +'/modulos')
			.success(function(items) {
				$scope.perfil.modulos = items;

				$.each($scope.perfil.modulos, function(index, item) {
					var results = $('.modulos-tree').treeview('search',
						[
							item.cod_modulo.toString(),
							'data.cod_modulo',
							{
								ignoreCase: true,
								exactMatch: true,
								revealResults: false
							}
						]
					);

					$.each(results, function(i, node) {
						markNodeIsChecked(node);
					});
				});
			});
	}

	function loadTodosModulos() {
		$http.get(baseUrlApi()+'modulos')
			.success(function(items) {
				var treeviewData = [];

				$.each(items, function(xindex, xData) {
					var xItem 		= {}
						xItem.data 	= xData;
						xItem.text 	= xData.nme_modulo;
						xItem.icon 	= xData.icn_modulo;
					
					if(xData.nodes !==  undefined) {
						xItem.tags = [xData.nodes.length];
						xItem.nodes = [];

						$.each(xData.nodes, function(yindex, yData) {
							var yItem 		= {};
								yItem.data 	= yData;
								yItem.text 	= yData.nme_modulo;
								yItem.icon 	= yData.icn_modulo;

							if(yData.nodes !==  undefined) {
								yItem.tags = [yData.nodes.length];
								yItem.nodes = [];

								$.each(yData.nodes, function(zindex, zData) {
									var zItem 		= {};
										zItem.data 	= zData;
										zItem.text 	= zData.nme_modulo;
										zItem.icon 	= zData.icn_modulo;

									yItem.nodes.push(zItem);
								});
							}

							xItem.nodes.push(yItem);
						});
					}

					treeviewData.push(xItem);
				});

				$(".modulos-tree").treeview({
					data: treeviewData,
					showCheckbox: true,
					showBorder: false,
					levels: 99,
					expandIcon: "fa fa-lg fa-chevron-right",
					collapseIcon: "fa fa-lg fa-chevron-down",
					onNodeChecked: checkNode,
					onNodeUnchecked: checkNode
				});
			});
	}

	function checkNode(event, node) {
		insertOrRemoveModuleInProfileList(node);
		if(node.nodes !== undefined) {
			$.each(node.nodes, function(xindex, xitem){
				markNodeIsChecked(xitem);
				if(xitem.nodes !== undefined) {
					$.each(xitem.nodes, function(yindex, yitem){
						markNodeIsChecked(yitem);
					});
				}
			});
		}
	}

	function markNodeIsChecked(node) {
		if(node.state.checked)
			$('.modulos-tree').treeview('uncheckNode', [node.nodeId, {silent: true}]);
		else {
			$('.modulos-tree').treeview('checkNode', [node.nodeId, {silent: true}]);
		}
	}

	function insertOrRemoveModuleInProfileList(node) {
		var r = _.findWhere($scope.perfil.modulos, {cod_modulo: node.data.cod_modulo});
		if(r === undefined) {
			$scope.perfil.modulos.push(node.data);
		}
		else {
			//_.findKey($scope.perfil.modulos, r)
			$scope.perfil.modulos = _.without($scope.perfil.modulos, r);
		}

		$scope.$apply();

		if(node.nodes !== undefined) {
			$.each(node.nodes, function(i, nodeItem) {
				insertOrRemoveModuleInProfileList(nodeItem);
			});
		}
	}

	loadTodosModulos();
	loadDadosPerfilByUrlParam();
});