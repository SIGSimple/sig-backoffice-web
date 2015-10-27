app.controller('ConferenciaDadosPessoaisCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.colaborador.novosDados = {};
	$scope.tmpModal = { flg_removido: false };
	$scope.empresasContratante = [];
	$scope.locaisTrabalho = [];
	$scope.gradesHorario = [];
	$scope.sindicatos = [];
	$scope.bancos = [];
	$scope.entidades = [];
	$scope.contratos = [];
	$scope.flg_editable = true;

	$scope.enviarDadosParaAtualizacao = function() {
		$("button.btn-success.fa-save").button('loading');
		$http.post(baseUrlApi()+'colaborador/conferencia/dados', $scope.colaborador)
			.success(function(message, status, headers, config){
				$("button.btn-success.fa-save").remove();
				showNotification("Enviado!", message, null, 'page', status);
			})
			.error(function(message, status, headers, config){
				$("button.btn-success.fa-save").button('reset');
				showNotification(null, message, null, 'page', status);
			})
	}

	$scope.abreModalTelefone = function() {
		$("#modalAddTelefone").modal("show");
	}

	$scope.abreModalEmail = function() {
		$("#modalAddEmail").modal("show");	
	}

	$scope.abreModalDependente = function(isEditMode, item) {
		if(isEditMode){
			$scope.tmpModal = angular.copy(item);
			$scope.tmpModal.$$hashKey = item.$$hashKey;
		}
		$("#modalAddDependente").modal("show");	
	}

	$scope.addTelefone = function(){
		$scope.colaborador.cooperator.telefones.push( angular.copy($scope.tmpModal) );
		$scope.tmpModal = {};
		$("#modalAddTelefone").modal("hide");
	}

	$scope.addDependente = function(){		
		if($scope.tmpModal.$$hashKey == "") {
			$scope.colaborador.cooperator.dependentes.push( angular.copy($scope.tmpModal) );
		}
		else {
			for (var i = 0; i < $scope.colaborador.cooperator.dependentes.length; i++) {
				if($scope.colaborador.cooperator.dependentes[i].$$hashKey == $scope.tmpModal.$$hashKey)
					$scope.colaborador.cooperator.dependentes[i] = angular.copy($scope.tmpModal);
			};
		}

		$scope.tmpModal = {};
		resetSwitchInput();
		$("#modalAddDependente").modal("hide");
	}

	$scope.desabilitaItem = function(item) {
		item.flg_removido = true;
	}

	$scope.addEmail = function(){
		$scope.colaborador.cooperator.emails.push( angular.copy($scope.tmpModal) );
		$scope.tmpModal = {};
		$("#modalAddEmail").modal("hide");
	}

	function habilitaTodosOsItens() {
		if($scope.colaborador.cooperator.telefones != null && $scope.colaborador.cooperator.telefones.length > 0) {
			$.each($scope.colaborador.cooperator.telefones, function(index, telefone) {
				$scope.colaborador.cooperator.telefones[index].flg_removido = false;
			});
		}

		if($scope.colaborador.cooperator.emails != null && $scope.colaborador.cooperator.emails.length > 0) {
			$.each($scope.colaborador.cooperator.emails, function(index, email) {
				$scope.colaborador.cooperator.emails[index].flg_removido = false;
			});
		}

		if($scope.colaborador.cooperator.dependentes != null && $scope.colaborador.cooperator.dependentes.length > 0) {
			$.each($scope.colaborador.cooperator.dependentes, function(index, dependente) {
				$scope.colaborador.cooperator.dependentes[index].flg_removido = false;
			});
		}
	}

	function loadTiposTelefone() {
		$http.get(baseUrlApi()+'tipos/telefone')
			.success(function(items){
				$scope.tiposTelefone = items;
			});
	}

	function loadTiposDependencia() {
		$http.get(baseUrlApi()+'tipos/dependencia')
			.success(function(items){
				$scope.tiposDependencia = items;
			});
	}

	function loadPlanosSaude() {
		$http.get(baseUrlApi()+'planos-saude?nolimit=1')
			.success(function(items){
				$scope.planosSaude = items.rows;
			});
	}

	function loadEmpresas() {
		$http.get(baseUrlApi()+'empresas?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.empresasContratante = items.rows;
			});
	}

	function loadLocaisTrabalho() {
		$http.get(baseUrlApi()+'locais-trabalho?nolimit=1&tlt->cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.locaisTrabalho = items.rows;
			});
	}

	function loadGradesHorario() {
		$http.get(baseUrlApi()+'grades-horario?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.gradesHorario = items.rows;
			});
	}

	function loadSindicatos() {
		$http.get(baseUrlApi()+'sindicatos?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.sindicatos = items.rows;
			});
	}

	function loadBancos() {
		$http.get(baseUrlApi()+'bancos?nolimit=1')
			.success(function(items){
				$scope.bancos = items.rows;
			});
	}

	function loadEntidades() {
		$http.get(baseUrlApi()+'entidades?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.entidades = items.rows;
			});
	}

	function loadOrigens() {
		$http.get(baseUrlApi()+'origens?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.contratos = items.rows;
			});
	}

	function getColaboradorByUrlParam() {
		if(typeof getUrlVars().cod_colaborador != "undefined") { // eu tenho um parametro chamado cod_colaborador na url?
			$scope.flg_editable = false;
			$http.get(baseUrlApi() + 'colaboradores?col->cod_colaborador=' + getUrlVars().cod_colaborador)
				.success(function(response){
					$scope.colaborador.cooperator = response.rows[0];
					$scope.colaborador.cooperator.cod_empreendimento = $scope.colaborador.user.cod_empreendimento;

					if($scope.colaborador.cooperator.pth_arquivo_foto != null && $scope.colaborador.cooperator.pth_arquivo_foto != "") {
						if(window.location.hostname == "localhost")
							$scope.colaborador.cooperator.pth_arquivo_foto = $scope.colaborador.cooperator.pth_arquivo_foto.replace("/home/consorciointermultip/public_html/files/docs/", "../sig-backoffice-files/");
						else
							$scope.colaborador.cooperator.pth_arquivo_foto = $scope.colaborador.cooperator.pth_arquivo_foto.replace("/home/consorciointermultip/public_html/", "");
					}
					else if($scope.colaborador.cooperator.flg_sexo == "M")
						$scope.colaborador.cooperator.pth_arquivo_foto = "img/av1.png";
					else if($scope.colaborador.cooperator.flg_sexo == "F")
						$scope.colaborador.cooperator.pth_arquivo_foto = "img/av6.png";
					else
						$scope.colaborador.cooperator.pth_arquivo_foto = "img/logo_intermultiplas.jpg";

					$scope.getCidades('moradia');
					$scope.getCidades('naturalidade');

					$scope.colaborador.cooperator.dta_admissao 		= ($scope.colaborador.cooperator.dta_admissao 	!= null) ? moment($scope.colaborador.cooperator.dta_admissao, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.colaborador.cooperator.dta_nascimento 		= ($scope.colaborador.cooperator.dta_nascimento 	!= null) ? moment($scope.colaborador.cooperator.dta_nascimento, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.colaborador.cooperator.dta_demissao 		= ($scope.colaborador.cooperator.dta_demissao 	!= null) && ($scope.colaborador.cooperator.dta_demissao == "" )    ? moment($scope.colaborador.cooperator.dta_demissao, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.colaborador.cooperator.dta_emissao_ctps 	= ($scope.colaborador.cooperator.dta_emissao_ctps != null) ? moment($scope.colaborador.cooperator.dta_emissao_ctps, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.colaborador.cooperator.dta_aso 			= ($scope.colaborador.cooperator.dta_aso 			!= null )  && ($scope.colaborador.cooperator.dta_aso == "" )  ? moment($scope.colaborador.cooperator.dta_aso, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.colaborador.cooperator.dta_validade_cnh 	= ($scope.colaborador.cooperator.dta_validade_cnh != null) ? moment($scope.colaborador.cooperator.dta_validade_cnh, "YYYY-MM-DD").format("DD/MM/YYYY") : "";

					$.each($scope.empresasContratante, function(index, empresaContratante) {
						if(empresaContratante.cod_empresa == $scope.colaborador.cooperator.cod_empresa_contratante)
							$scope.colaborador.cooperator.empresaContratante = empresaContratante;
					});

					$.each($scope.locaisTrabalho, function(index, localTrabalho) {
						if(localTrabalho.cod_local_trabalho == $scope.colaborador.cooperator.cod_local_trabalho)
							$scope.colaborador.cooperator.localTrabalho = localTrabalho;
					});

					$.each($scope.gradesHorario, function(index, gradeHorario) {
						if(gradeHorario.cod_grade_horario == $scope.colaborador.cooperator.cod_grade_horario)
							$scope.colaborador.cooperator.gradeHorario = gradeHorario;
					});

					$.each($scope.sindicatos, function(index, sindicato) {
						if(sindicato.cod_sindicato == $scope.colaborador.cooperator.cod_sindicato)
							$scope.colaborador.cooperator.sindicato = sindicato;
					});

					$.each($scope.bancos, function(index, banco) {
						if(banco.cod_banco == $scope.colaborador.cooperator.cod_banco)
							$scope.colaborador.cooperator.banco = banco;
					});

					$.each($scope.entidades, function(index, entidade) {
						if(entidade.cod_entidade == $scope.colaborador.cooperator.cod_entidade)
							$scope.colaborador.cooperator.entidade = entidade;
					});

					$.each($scope.contratos, function(index, origem) {
						if(origem.cod_origem == $scope.colaborador.cooperator.cod_contrato)
							$scope.colaborador.cooperator.contrato = origem;
					});

					if((typeof $scope.colaborador.cooperator.flg_portador_necessidades_especiais != "undefined") && (parseInt($scope.colaborador.cooperator.flg_portador_necessidades_especiais, 10) == 1)) {
						var element = $("[ng-model='dadosColaborador.flg_portador_necessidades_especiais']");
						// TODO: destruir o elemento
						element.siblings("span.switchery").remove();
						// TODO: adicionar a tag (atributo) "checked"
						element.attr("checked", "checked");
						// TODO: inicializar o elemento novamente
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_ativo != "undefined") && (parseInt($scope.colaborador.cooperator.flg_ativo, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_ativo']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_hora_extra != "undefined") && (parseInt($scope.colaborador.cooperator.flg_hora_extra, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_hora_extra']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_trabalho_fim_semana != "undefined") && (parseInt($scope.colaborador.cooperator.flg_trabalho_fim_semana, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_trabalho_fim_semana']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_trabalho_feriado != "undefined") && (parseInt($scope.colaborador.cooperator.flg_trabalho_feriado, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_trabalho_feriado']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_ajusta_folha_ponto != "undefined") && (parseInt($scope.colaborador.cooperator.flg_ajusta_folha_ponto, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_ajusta_folha_ponto']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.colaborador.cooperator.flg_ensino_superior != "undefined") && (parseInt($scope.colaborador.cooperator.flg_ensino_superior, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_ensino_superior']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}


					getTelefonesColaborador(getUrlVars().cod_colaborador);
					getEmailsColaborador(getUrlVars().cod_colaborador);
					getFuncoesColaborador(getUrlVars().cod_colaborador);
					getDependentesColaborador(getUrlVars().cod_colaborador);
					getPlanoSaudeColaborador(getUrlVars().cod_colaborador);
				});
		}
		else
			habilitaTodosOsItens();
	}

	function getTelefonesColaborador(cod_colaborador) {
		$http.get(baseUrlApi() + 'colaborador/telefones?cod_colaborador=' + cod_colaborador)
			.success(function(items){
				$scope.colaborador.cooperator.telefones = [];

				$.each(items, function(index, telefone){
					var obj = {
						cod_telefone: telefone.cod_telefone,
						cod_colaborador: telefone.cod_colaborador,
						num_ddd: telefone.num_ddd,
						num_telefone: telefone.num_telefone,
						tipoTelefone: {
							cod_tipo_telefone: telefone.cod_tipo_telefone,
							nme_tipo_telefone: telefone.nme_tipo_telefone
						},
						flg_removido: false
					};

					$scope.colaborador.cooperator.telefones.push(obj);
				});
			});
	}

	function getEmailsColaborador(cod_colaborador) {
		$http.get(baseUrlApi() + 'colaborador/emails?cod_colaborador=' + cod_colaborador)
			.success(function(items){
				$.each(items, function(index, email) {
					items[index].flg_removido = false;
				});

				$scope.colaborador.cooperator.emails = items;
		});		
	}

	function getFuncoesColaborador(cod_colaborador){
		$http.get(baseUrlApi() + 'colaborador/funcoes/' + cod_colaborador)
			.success(function(items){
				$scope.colaborador.cooperator.funcoes = [];

				$.each(items, function(index, funcao){
					var obj = {
						cod_alteracao_funcao: funcao.cod_alteracao_funcao,
						funcao: {
							num_funcao: funcao.num_funcao,
							nme_funcao: funcao.nme_funcao,
							cod_funcao: funcao.cod_funcao
						},
						vlr_salario: funcao.vlr_salario,
						motivoAlteracaoFuncao: {
							nme_motivo_alteracao_funcao: funcao.nme_motivo_alteracao_funcao,
						},
						dta_alteracao: moment(funcao.dta_alteracao, "YYYY-MM-DD hh:mm:ss").format("DD/MM/YYYY"),
						flg_removido: false
					};

					$scope.colaborador.cooperator.funcoes.push(obj);
				});
			});
	}

	function getDependentesColaborador(cod_colaborador) {
		$http.get(baseUrlApi()+'colaborador/dependentes?cod_colaborador='+cod_colaborador)
			.success(function(items){
				$scope.colaborador.cooperator.dependentes = [];

				$.each(items, function(index, dependente) {
					var obj = {
						cod_dependente: dependente.cod_dependente,
						tipoDependencia: {
							cod_tipo_dependencia: dependente.cod_tipo_dependencia,
							nme_tipo_dependencia: dependente.nme_tipo_dependencia
						},
						nme_dependente: dependente.nme_dependente,
						pth_documento: dependente.pth_documento,
						dta_nascimento: moment(dependente.dta_nascimento, "YYYY-MM-DD").format("DD/MM/YYYY"),
						planoSaude: {
							cod_plano_saude: dependente.cod_plano_saude,
							nme_plano_saude: dependente.nme_plano_saude
						},
						flg_plano_saude: dependente.flg_plano_saude,
						flg_deduz_irrf: dependente.flg_deduz_irrf,
						flg_curso_superior: dependente.flg_curso_superior,
						flg_removido: false
					};
					$scope.colaborador.cooperator.dependentes.push(obj);
				});
			});
	}

	function getPlanoSaudeColaborador(cod_colaborador) {
		$http.get(baseUrlApi()+'colaborador/beneficios?ben->cod_colaborador='+cod_colaborador+'&ben->cod_tipo_beneficio=9')
			.success(function(items){
				$scope.colaborador.cooperator.planoSaude = {
					cod_plano_saude: 		items.rows[0].cod_plano_saude,
					cod_empresa: 			items.rows[0].cod_empresa,
					nme_plano_saude: 		items.rows[0].nme_plano_saude,
					vlr_custo_empresa: 		items.rows[0].vlr_custo_empresa,
					vlr_custo_colaborador: 	items.rows[0].vlr_custo_colaborador,
					vlr_custo_dependente: 	items.rows[0].vlr_custo_dependente,
					cod_empreendimento: 	items.rows[0].cod_empreendimento,
					nme_fantasia: 			items.rows[0].nme_fantasia
				};
			});
	}

	$scope.getCidades = function(el_destino) {
		$(".loading-cidade-" + el_destino).removeClass("hide");

		var cod_estado = 0;

		if(el_destino === 'moradia')
			cod_estado = $scope.colaborador.cooperator.cod_estado_moradia;
		else if(el_destino === 'naturalidade')
			cod_estado = $scope.colaborador.cooperator.cod_estado_naturalidade;
	
		$http.get(baseUrlApi()+'cidades?cod_estado='+ cod_estado)
			.success(function(items){
				if(el_destino === 'moradia')
					$scope.cidadesMoradia = items;
				else if(el_destino === 'naturalidade')
					$scope.cidadesNaturalidade = items;

				$(".loading-cidade-" + el_destino).addClass("hide");
				$('.selectpicker').selectpicker('refresh');
			});
	}

	loadTiposTelefone();
	loadTiposDependencia();
	loadPlanosSaude();
	loadEmpresas();
	loadLocaisTrabalho();
	loadGradesHorario();
	loadSindicatos();
	loadBancos();
	loadEntidades();
	loadOrigens();
	//habilitaTodosOsItens();
	getColaboradorByUrlParam();
});