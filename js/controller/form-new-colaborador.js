$('#demo-cls-wz').bootstrapWizard({
	tabClass			: 'wz-classic',
	nextSelector		: '.next',
	previousSelector	: '.previous',
	onInit : function(){
		$('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
	},
	onTabShow: function(tab, navigation, index) {
		var $total 		= navigation.find('li').length;
		var $current 	= index + 1;
		var $percent 	= ($current / $total) * 100;

		var wdt = 100 / $total;
		var lft = wdt * index;
		
		$('#demo-cls-wz').find('.progress-bar').css({ width: $percent + '%' });

		// If it's the last tab then hide the last button and show the finish instead
		if($current >= $total) {
			$('#demo-cls-wz').find('.next').hide();
			$('#demo-cls-wz').find('.finish').show();
			$('#demo-cls-wz').find('.finish').prop('disabled', false);
			if($current > $total)
				this.finish();
		} else {
			$('#demo-cls-wz').find('.next').show();
			$('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
		}
	}
});

$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroColaboradorCtrl', function($scope, $http, UserSrvc){
	$scope.activePageId = getActivePageId();
	$scope.sessionSaved = false;

	$scope.colaborador = UserSrvc.getUserLogged();

	// Definição de variáveis de uso da tela
	$scope.dadosColaborador = {
		cod_empreendimento: $scope.colaborador.user.cod_empreendimento,
		funcoes:[],
		telefones: [],
		emails: [],
		funcoes: [],
		files: {},
		num_matricula: "",
		nme_colaborador: "",
		flg_portador_necessidades_especiais: 0,
		cod_departamento: 0,
		flg_cm: 0,
		flg_ativo: 0,
		dta_admissao: "",
		dta_demissao: "",
		num_ctps: "",
		num_serie_ctps: "",
		cod_estado_ctps: 0,
		dta_emissao_ctps: "",
		num_rg: "",
		num_cpf: "",
		num_pis: "",
		num_titulo_eleitor: "",
		num_zona_eleitoral: "",
		num_secao_eleitoral: "",
		num_reservista: "",
		dsc_endereco: "",
		num_endereco: "",
		nme_bairro: "",
		dsc_complemento: "",
		cod_cidade_moradia: 0,
		cod_estado_moradia: 0,
		cod_cidade_naturalidade: 0,
		cod_estado_naturalidade: 0,
		cod_estado_moradia: 0,
		num_cep: "",
		dta_nascimento: "",
		num_cnh: "",
		nme_categoria_cnh: "",
		dta_validade_cnh: "",
		flg_sexo: "M",
		banco: {},
		num_agencia: "",
		num_digito_agencia: "",
		num_conta_corrente: "",
		num_digito_conta_corrente: "",
		pth_arquivo_cnh: "",
		pth_arquivo_rg: "",
		pth_arquivo_foto: "",
		pth_arquivo_cpf: "",
		pth_arquivo_entidade: "",
		pth_arquivo_curriculo: "",
		pth_arquivo_reservista: "",
		num_entidade: ""
	};
	$scope.motivosAlteracaoFuncao = [];
	$scope.funcoes = [];
	$scope.ufs = [];
	$scope.cidadesMoradia = [];
	$scope.cidadesNaturalidade = [];
	$scope.empresasContratante = [];
	$scope.regimesContratacao = [];
	$scope.locaisTrabalho = [];
	$scope.departamentos = [];
	$scope.gradesHorario = [];
	$scope.sindicatos = [];
	$scope.bancos = [];
	$scope.entidades = [];
	$scope.contratos = [];
	$scope.tiposTelefone = [];
	$scope.origens = [];
	$scope.dependentes = [];
	$scope.tiposDependencia = [];
	$scope.planosSaude = [];
	$scope.estadosCivis = [];
	$scope.asos = [];
	$scope.certificados = [];
	
	$scope.tmpModal = {};
	
	var modalTablesColumns = {
		"empresas": [
			{
				field: 'nme_fantasia',
				title: 'Nome Fantasia'
			}
		],
		"planos-saude": [
			{
				field: 'nme_fantasia',
				title: 'Empresa'
			},
			{
				field: 'nme_plano_saude',
				title: 'Plano'
			}
		],
		"locais-trabalho": [
			{
				field: 'nme_local_trabalho',
				title: 'Nome Local'
			}

		],
		"sindicatos": [
			{
				field: 'nme_sindicato',
				title: 'Nome Sindicato'
			}

		],
		"grades-horario": [
			{
				field: 'nme_grade_horario',
				title: 'Grade de Horário'
			}

		],
		"entidades": [
			{
				field: 'nme_entidade',
				title: 'Nome'
			}
		],
		"bancos": [
			{
				field: 'num_banco',
				title: 'Número'
			},
			{
				field: 'nme_banco',
				title: 'Nome'
			}
		],
		"origens": [
			{
				field: 'dsc_origem',
				title: 'Contrato'
			}
		],
		"dependentes": [
			{
				field: 'nme_dependente',
				title: 'Nome Dependente'
			}
		]
	};

	$scope.getProfileImagePath = function() {
		return "files/user/" + $scope.dadosColaborador.files.file_foto.nme_anexo;
	}

	$scope.getFuncionalidadeByName = function(nmeFuncionalidade){
		return UserSrvc.getFuncionalidadeByName(nmeFuncionalidade, getActivePage());
	};

	$scope.deleteColaborador = function() {
		var postData = {
			cod_colaborador: $scope.dadosColaborador.cod_colaborador, 	// colaborador que está sendo alterado
			cod_usuario: $scope.colaborador.user.cod_usuario 			// usuário logado no sistema
		};

		$http.delete(baseUrlApi()+"colaborador", {params: postData})
			.success(function(message, status, headers, config){
				$("#modalExcluiColaborador").modal("hide");
				clearObject();
				showNotification("Excluído!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					window.location.href = newUrl.replace("form-new-colaborador", "list-colaboradores");
				}, 5000);
			})
			.error(function(message, status, headers, config){
				showNotification(null, message, null, 'page', status);
			});

	}

	$scope.validateFieldValues = function() {
		var postData = angular.copy($scope.dadosColaborador);
		postData.dta_admissao 		= ($scope.dadosColaborador.dta_admissao != "") ? moment($scope.dadosColaborador.dta_admissao, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_demissao 		= ($scope.dadosColaborador.dta_demissao != "") ? moment($scope.dadosColaborador.dta_demissao, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_emissao_ctps 	= ($scope.dadosColaborador.dta_emissao_ctps != "") ? moment($scope.dadosColaborador.dta_emissao_ctps, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_nascimento 	= ($scope.dadosColaborador.dta_nascimento != "") ? moment($scope.dadosColaborador.dta_nascimento, "DD/MM/YYYY").format("YYYY-MM-DD") : "";
		postData.dta_validade_cnh 	= ($scope.dadosColaborador.dta_validade_cnh != "") ? moment($scope.dadosColaborador.dta_validade_cnh, "DD/MM/YYYY").format("YYYY-MM-DD") : "";   
		postData.dta_aso 			= ($scope.dadosColaborador.dta_aso != "") ? moment($scope.dadosColaborador.dta_aso, "DD/MM/YYYY").format("YYYY-MM-DD") : "";   

		// remove as mensagens de erro dos campos obrigatórios
		$('[data-toggle="tooltip"]').removeAttr("data-toggle").removeAttr("data-placement").removeAttr("title").removeAttr("data-original-title");
		$(".element-group").removeClass("has-error");
		$("table thead").css("background-color","none").css("color","#515151");
		$(".form-fields span").css("background-color", "#fafafa").css("border-color","#CDD6E1").css("color","#515151");

		// captura os valores dos sliders (flgs)
		postData.flg_trabalho_fim_semana 				= ($('.input-switch[ng-model="dadosColaborador.flg_trabalho_fim_semana"]')[0].checked) ? 1 : 0;
		postData.flg_hora_extra 						= ($('.input-switch[ng-model="dadosColaborador.flg_hora_extra"]')[0].checked) ? 1 : 0;
		postData.flg_trabalho_feriado 					= ($('.input-switch[ng-model="dadosColaborador.flg_trabalho_feriado"]')[0].checked) ? 1 : 0;
		postData.flg_ajusta_folha_ponto 				= ($('.input-switch[ng-model="dadosColaborador.flg_ajusta_folha_ponto"]')[0].checked) ? 1 : 0;
		postData.flg_ensino_superior 					= ($('.input-switch[ng-model="dadosColaborador.flg_ensino_superior"]')[0].checked) ? 1 : 0;
		postData.flg_portador_necessidades_especiais 	= ($('.input-switch[ng-model="dadosColaborador.flg_portador_necessidades_especiais"]')[0].checked) ? 1 : 0;
		postData.flg_ativo 								= ($('.input-switch[ng-model="dadosColaborador.flg_ativo"]')[0].checked) ? 1 : 0;

		// envia os dados para a API tratar e salvar no BD
		$http.post(baseUrlApi()+'colaborador', postData)
			.success(function(message, status, headers, config){
				$scope.sessionSaved = true;
				clearObject();
				showNotification("Salvo!", message, null, 'page', status);
				setTimeout(function(){
					// Remove os parâmetros da url
					var newUrl = window.location.href.substr(0, window.location.href.indexOf("?"));
					// Faz o redirecionamento
					window.location.href = newUrl.replace("form-new-colaborador", "list-colaboradores");
				}, 5000);
			})
			.error(function(message, status, headers, config){ // se a API retornar algum erro
				if(status == 406){ // Not-Acceptable (Campos inválidos)
					showNotification("Atenção!", "Alguns campos obrigatórios não foram preenchidos.", null, 'page', status);
					// percorre a lista de campos devolvidos da API
					$.each(message, function(index, value) {
						// seleciona os elemento HTML de acordo com o campo mencionado
						var element = ($("[ng-model='dadosColaborador."+ index +"']").length > 0) ? $("[ng-model='dadosColaborador."+ index +"']") : $("[name='"+ index +"']");

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

	$scope.getCidades = function(el_destino) {
		$(".loading-cidade-" + el_destino).removeClass("hide");

		var cod_estado = 0;

		if(el_destino === 'moradia')
			cod_estado = $scope.dadosColaborador.cod_estado_moradia;
		else if(el_destino === 'naturalidade')
			cod_estado = $scope.dadosColaborador.cod_estado_naturalidade;
	
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

	$scope.abreModal = function(rota, atributo) {
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
				$scope.dadosColaborador[atributo] = row;
				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}

	$scope.abreModalTelefone = function() {
		$("#modalAddTelefone").modal("show");
	}

	$scope.desabilitaItem = function(item) {
		item.flg_removido = true;
	}

	$scope.fileUploaded = function(object, subItem, message) {
		var parsedObj = JSON.parse(message);
		object[subItem] = {};
		object[subItem].nme_anexo 		= parsedObj.flowFileName;
		object[subItem].pth_anexo 		= parsedObj.flowFilePath;
		object[subItem].dsc_tipo_anexo 	= parsedObj.flowFileType;
	}

	$scope.clearAttachment = function(item, subItem) {
		$http.get(baseUrl()+'file-delete.php?file-path=' + item[subItem].pth_anexo)
			.success(function(message, status, headers, config) {
				delete item[subItem];
			})
			.error(function(message, status, headers, config) {
				showNotification(null, message, null, 'floating', status);
			});
	}

	$scope.fileUploadError = function(file, message, flow) {
		console.log(file, message, flow);
	}

	$scope.abreModalEmail = function() {
		$("#modalAddEmail").modal("show");	
	}

	$scope.abreModalFuncao = function() {
		$("#modalAddFuncao").modal("show");
	}

	$scope.abreModalDependente = function() {
		$("#modalAddDependente").modal("show");
	}

	$scope.addASO = function() {
		$scope.asos.push({
			dta_aso: "",
			file: {
				pth_arquivo_aso: ""
			},
			flg_removido: false
		});

		enableDateField();
	}

	$scope.addCertificado = function() {
		$scope.certificados.push({
			dta_certificado: "",
			nme_curso: "",
			file: {
				pth_arquivo_certificado: ""
			},
			flg_removido: false
		});
		enableDateField();
	}

	$scope.addTelefone = function(){
		if(!$("#modalAddTelefone p.text-danger").hasClass("hide"))
			$("#modalAddTelefone p.text-danger").addClass("hide");

		$("#modalAddTelefone .form-group").removeClass("has-error");

		var elTipoTelefone = $("[ng-model='tmpModal.tipoTelefone'] option:selected");
		var elNumDDD = $("[ng-model='tmpModal.num_ddd']");
		var elNumTelefone = $("[ng-model='tmpModal.num_telefone']");

		var hasError = false;

		if(elTipoTelefone.val() == "?") {
			hasError = true;
			elTipoTelefone.closest(".form-group").addClass("has-error");
		}

		if(elNumDDD.val().length == 0) {
			hasError = true;
			elNumDDD.closest(".form-group").addClass("has-error");
		}

		if(elNumTelefone.val().length == 0) {
			hasError = true;
			elNumTelefone.closest(".form-group").addClass("has-error");
		}

		if(!hasError) {
			$scope.tmpModal.flg_removido = false;
			if(typeof($scope.dadosColaborador.telefones) == "undefined")
				$scope.dadosColaborador.telefones = [];

			$scope.dadosColaborador.telefones.push( angular.copy($scope.tmpModal) );
			$scope.tmpModal = {};
			$("#modalAddTelefone").modal("hide");
		}
		else
			$("#modalAddTelefone p.text-danger").removeClass("hide");
	}

	$scope.addEmail = function(){
		if(!$("#modalAddEmail p.text-danger").hasClass("hide"))
			$("#modalAddEmail p.text-danger").addClass("hide");

		$("#modalAddEmail .form-group").removeClass("has-error");

		var elEndereco = $("[ng-model='tmpModal.end_email']");

		var hasError = false;

		if(elEndereco.val() == "") {
			hasError = true;
			elEndereco.closest(".form-group").addClass("has-error");
		}

		if(!hasError) {
			$scope.tmpModal.flg_removido = false;
			$scope.dadosColaborador.emails.push( angular.copy($scope.tmpModal) );
			$scope.tmpModal = {};
			$("#modalAddEmail").modal("hide");
		}
		else
			$("#modalAddEmail p.text-danger").removeClass("hide");
	}

	$scope.addFuncao = function(){
		if(!$("#modalAddFuncao p.text-danger").hasClass("hide"))
			$("#modalAddFuncao p.text-danger").addClass("hide");
		
		$("#modalAddFuncao .form-group").removeClass("has-error");
		
		var elFuncao 	= $("[ng-model='tmpModal.funcao'] option:selected");
		var elSalario 	= $("[ng-model='tmpModal.vlr_salario']");
		var elMotivo 	= $("[ng-model='tmpModal.motivoAlteracaoFuncao'] option:selected");
		var elData 		= $("[ng-model='tmpModal.dta_alteracao']");

		var hasError = false;


		if(elFuncao.val() == "?") {
			hasError = true;
			elFuncao.closest(".form-group").addClass("has-error");
		}

		if(elSalario.val().length == 0) {
			hasError = true;
			elSalario.closest(".form-group").addClass("has-error");
		}

		if(elMotivo.val() == "?") {
			hasError = true;
			elMotivo.closest(".form-group").addClass("has-error");
		}

		if(elData.val().length == 0) {
			hasError = true;
			elData.closest(".form-group").addClass("has-error");
		}

		if(!hasError) {
			$scope.tmpModal.flg_removido = false;
			$scope.tmpModal.dta_alteracao = moment($scope.tmpModal.dta_alteracao, "DD/MM/YYYY").format("YYYY-MM-DD");   
			if(typeof($scope.dadosColaborador.funcoes) == "undefined")
				$scope.dadosColaborador.funcoes = [];

			$scope.dadosColaborador.funcoes.push( angular.copy($scope.tmpModal) );
			$scope.tmpModal = {};
			$("#modalAddFuncao").modal("hide");
		}
		else
			$("#modalAddFuncao p.text-danger").removeClass("hide");
	}

	$scope.addDependente = function(){
		if(!$("#modalAddDependente p.text-danger").hasClass("hide"))
			$("#modalAddDependente p.text-danger").addClass("hide");
		
		$("#modalAddDependente .form-group").removeClass("has-error");
		
		var elNome 				= $("[ng-model='tmpModal.nme_dependente']");
		var elGrauParentesco 	= $("[ng-model='tmpModal.cod_tipo_dependencia'] option:selected");
		var elDtaNascimento 	= $("[ng-model='tmpModal.dta_nascimento']");
		var elFlgPlanoSaude 	= $("[ng-model='tmpModal.flg_plano_saude']");
		var elPlanoSaude 		= $("[ng-model='tmpModal.cod_plano_saude'] option:selected");

		var hasError = false;

		if(elNome.val().length == 0) {
			hasError = true;
			elNome.closest(".form-group").addClass("has-error");
		}

		if(elGrauParentesco.val() == "? undefined:undefined ?") {
			hasError = true;
			elGrauParentesco.closest(".form-group").addClass("has-error");
		}

		if(elDtaNascimento.val().length == 0) {
			hasError = true;
			elDtaNascimento.closest(".form-group").addClass("has-error");
		}

		if(elFlgPlanoSaude.prop('checked') && elPlanoSaude.val() == "? undefined:undefined ?") {
			hasError = true;
			elFlgPlanoSaude.closest(".form-group").addClass("has-error");
		}

		if(!hasError) {
			$scope.tmpModal.flg_atualizado 		= true;
			$scope.tmpModal.dta_nascimento 		= moment($scope.tmpModal.dta_nascimento, "DD/MM/YYYY").format("YYYY-MM-DD");
			$scope.tmpModal.flg_curso_superior 	= ($scope.tmpModal.flg_curso_superior === true || $scope.tmpModal.flg_curso_superior === 1 || $scope.tmpModal.flg_curso_superior == "1") ? 1 : 0;
			$scope.tmpModal.flg_plano_saude 	= ($scope.tmpModal.flg_plano_saude === true || $scope.tmpModal.flg_plano_saude === 1 || $scope.tmpModal.flg_plano_saude == "1") ? 1 : 0;
			$scope.tmpModal.flg_deduz_irrf 		= ($scope.tmpModal.flg_deduz_irrf === true || $scope.tmpModal.flg_deduz_irrf === 1 || $scope.tmpModal.flg_deduz_irrf == "1") ? 1 : 0;

			// Capturando os dados do grau de parentesco selecionado
			$.each($scope.tiposDependencia, function(index, tipoDependencia) {
				if(tipoDependencia.cod_tipo_dependencia == $scope.tmpModal.cod_tipo_dependencia) {
					$scope.tmpModal.cod_tipo_dependencia = undefined;
					$scope.tmpModal.tipoDependencia = tipoDependencia;
				}
			});

			// Capturando os dados do plano de saúde selecionado
			$.each($scope.planosSaude, function(index, planoSaude) {
				if(planoSaude.cod_plano_saude == $scope.tmpModal.cod_plano_saude) {
					$scope.tmpModal.cod_plano_saude = undefined;
					$scope.tmpModal.planoSaude = planoSaude;
				}
			});

			if($scope.tmpModal.$$hashKey == "" || typeof($scope.tmpModal.$$hashKey) == "undefined") {
				if(typeof($scope.dadosColaborador.dependentes) == "undefined")
					$scope.dadosColaborador.dependentes = [];
				$scope.dadosColaborador.dependentes.push( angular.copy($scope.tmpModal) );
			}
			else {
				for (var i = 0; i < $scope.dadosColaborador.dependentes.length; i++) {
					if($scope.dadosColaborador.dependentes[i].$$hashKey == $scope.tmpModal.$$hashKey)
						$scope.dadosColaborador.dependentes[i] = angular.copy($scope.tmpModal);
				};
			}

			$scope.tmpModal = {};
			$("#modalAddDependente").modal("hide");
		}
		else
			$("#modalAddDependente p.text-danger").removeClass("hide");
	}

	$scope.editarDependente = function(dependente) {
		if(dependente.dta_nascimento.split("-")[0].length == 4) // USA (YYYY-MM-DD)
			dependente.dta_nascimento = moment(dependente.dta_nascimento, "YYYY-MM-DD").format("DD/MM/YYYY");

		$scope.tmpModal = dependente;
		$scope.abreModalDependente();
	}

	$scope.validateState = function() {
		if($scope.tmpModal.flg_plano_saude == 0){
			$scope.tmpModal.cod_plano_saude = null;
			$scope.tmpModal.planoSaude = null;
		}
		return;
	}

	$scope.showDeleteButton = function() {
		return (typeof getUrlVars().cod_colaborador != "undefined") && (UserSrvc.getFuncionalidadeByName("EXCLUIR CADASTRO", getActivePage()));
	}

	// Definição de funções auxiliares
	function clearObject() {
		$scope.dadosColaborador = {
			cod_empreendimento: $scope.colaborador.user.cod_empreendimento,
			funcoes:[],
			telefones: [],
			emails: [],
			funcoes: [],
			files: {},
			num_matricula: "",
			nme_colaborador: "",
			flg_portador_necessidades_especiais: 0,
			cod_departamento: 0,
			flg_cm: 0,
			flg_ativo: 0,
			dta_admissao: "",
			dta_demissao: "",
			num_ctps: "",
			num_serie_ctps: "",
			cod_estado_ctps: 0,
			dta_emissao_ctps: "",
			num_rg: "",
			num_cpf: "",
			num_pis: "",
			num_titulo_eleitor: "",
			num_zona_eleitoral: "",
			num_secao_eleitoral: "",
			num_reservista: "",
			dsc_endereco: "",
			num_endereco: "",
			nme_bairro: "",
			dsc_complemento: "",
			cod_cidade_moradia: 0,
			cod_estado_moradia: 0,
			cod_cidade_naturalidade: 0,
			cod_estado_naturalidade: 0,
			cod_estado_moradia: 0,
			num_cep: "",
			dta_nascimento: "",
			num_cnh: "",
			nme_categoria_cnh: "",
			dta_validade_cnh: "",
			flg_sexo: "M",
			banco: {},
			num_agencia: "",
			num_digito_agencia: "",
			num_conta_corrente: "",
			num_digito_conta_corrente: "",
			pth_arquivo_cnh: "",
			pth_arquivo_rg: "",
			pth_arquivo_foto: "",
			pth_arquivo_cpf: "",
			pth_arquivo_entidade: "",
			pth_arquivo_curriculo: "",
			pth_arquivo_reservista: "",
			num_entidade: "",
			dta_aso: ""
		};
		$scope.motivosAlteracaoFuncao = [];
		$scope.funcoes = [];
		$scope.ufs = [];
		$scope.cidadesMoradia = [];
		$scope.cidadesNaturalidade = [];
		$scope.empresasContratante = [];
		$scope.regimesContratacao = [];
		$scope.locaisTrabalho = [];
		$scope.departamentos = [];
		$scope.gradesHorario = [];
		$scope.sindicatos = [];
		$scope.bancos = [];
		$scope.entidades = [];
		$scope.contratos = [];
		$scope.tiposTelefone = [];

		$scope.tmpModal = {};
	}

	function loadUfs() {
		$http.get(baseUrlApi()+'estados')
			.success(function(items){
				$scope.ufs = items;
			});
	}

	function loadEmpresas() {
		$http.get(baseUrlApi()+'empresas?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.empresasContratante = items.rows;
			});
	}

	function loadRegimesContratacao() {
		$http.get(baseUrlApi()+'regimes-contratacao?nolimit=1')
			.success(function(items){
				$scope.regimesContratacao = items.rows;
			});
	}

	function loadLocaisTrabalho() {
		$http.get(baseUrlApi()+'locais-trabalho?nolimit=1&tlt->cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.locaisTrabalho = items.rows;
			});
	}

	function loadDepartamentos() {
		$http.get(baseUrlApi()+'departamentos?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.departamentos = items.rows;
			});
	}

	function loadOrigens() {
		$http.get(baseUrlApi()+'origens?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.contratos = items.rows;
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

	function loadTiposTelefone() {
		$http.get(baseUrlApi()+'tipos/telefone')
			.success(function(items){
				$scope.tiposTelefone = items;
			});
	}

	function loadFuncoes() {
		$http.get(baseUrlApi()+'funcoes?nolimit=1&cod_empreendimento='+$scope.colaborador.user.cod_empreendimento)
			.success(function(items){
				$scope.funcoes = items.rows;
			});
	}

	function loadMotivosAlteracaoFuncao(){
		$http.get(baseUrlApi()+'alteracao/funcao/motivos')
			.success(function(response){
				$scope.motivosAlteracaoFuncao = response;
			});
	}

	function getColaboradorByUrlParam() {
		if(typeof getUrlVars().cod_colaborador != "undefined") { // eu tenho um parametro chamado cod_colaborador na url?
			$http.get(baseUrlApi() + 'colaboradores?col->cod_colaborador=' + getUrlVars().cod_colaborador)
				.success(function(response){
					$scope.dadosColaborador = response.rows[0];
					$scope.dadosColaborador.files = {};
					$scope.dadosColaborador.cod_empreendimento = $scope.colaborador.user.cod_empreendimento;

					if($scope.dadosColaborador.pth_arquivo_foto != null && $scope.dadosColaborador.pth_arquivo_foto != "") {
						if(window.location.hostname == "localhost")
							$scope.dadosColaborador.pth_arquivo_foto = $scope.dadosColaborador.pth_arquivo_foto.replace("/home/consorciointermultip/public_html/files/docs/", "../sig-backoffice-files/");
						else
							$scope.dadosColaborador.pth_arquivo_foto = $scope.dadosColaborador.pth_arquivo_foto.replace("/home/consorciointermultip/public_html/", "");
					}
					else if($scope.dadosColaborador.flg_sexo == "M")
						$scope.dadosColaborador.pth_arquivo_foto = "img/av1.png";
					else if($scope.dadosColaborador.flg_sexo == "F")
						$scope.dadosColaborador.pth_arquivo_foto = "img/av6.png";
					else
						$scope.dadosColaborador.pth_arquivo_foto = "img/logo_intermultiplas.jpg";

					$scope.getCidades('moradia');
					$scope.getCidades('naturalidade');

					$scope.dadosColaborador.dta_admissao 		= ($scope.dadosColaborador.dta_admissao 	!= null) ? moment($scope.dadosColaborador.dta_admissao, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.dadosColaborador.dta_nascimento 		= ($scope.dadosColaborador.dta_nascimento 	!= null) ? moment($scope.dadosColaborador.dta_nascimento, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.dadosColaborador.dta_demissao 		= ($scope.dadosColaborador.dta_demissao 	!= null) && ($scope.dadosColaborador.dta_demissao == "" )    ? moment($scope.dadosColaborador.dta_demissao, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.dadosColaborador.dta_emissao_ctps 	= ($scope.dadosColaborador.dta_emissao_ctps != null) ? moment($scope.dadosColaborador.dta_emissao_ctps, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.dadosColaborador.dta_aso 			= ($scope.dadosColaborador.dta_aso 			!= null )  && ($scope.dadosColaborador.dta_aso == "" )  ? moment($scope.dadosColaborador.dta_aso, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
					$scope.dadosColaborador.dta_validade_cnh 	= ($scope.dadosColaborador.dta_validade_cnh != null) ? moment($scope.dadosColaborador.dta_validade_cnh, "YYYY-MM-DD").format("DD/MM/YYYY") : "";

					$.each($scope.empresasContratante, function(index, empresaContratante) {
						if(empresaContratante.cod_empresa == $scope.dadosColaborador.cod_empresa_contratante)
							$scope.dadosColaborador.empresaContratante = empresaContratante;
					});

					$.each($scope.locaisTrabalho, function(index, localTrabalho) {
						if(localTrabalho.cod_local_trabalho == $scope.dadosColaborador.cod_local_trabalho)
							$scope.dadosColaborador.localTrabalho = localTrabalho;
					});

					$.each($scope.gradesHorario, function(index, gradeHorario) {
						if(gradeHorario.cod_grade_horario == $scope.dadosColaborador.cod_grade_horario)
							$scope.dadosColaborador.gradeHorario = gradeHorario;
					});

					$.each($scope.sindicatos, function(index, sindicato) {
						if(sindicato.cod_sindicato == $scope.dadosColaborador.cod_sindicato)
							$scope.dadosColaborador.sindicato = sindicato;
					});

					$.each($scope.bancos, function(index, banco) {
						if(banco.cod_banco == $scope.dadosColaborador.cod_banco)
							$scope.dadosColaborador.banco = banco;
					});

					$.each($scope.entidades, function(index, entidade) {
						if(entidade.cod_entidade == $scope.dadosColaborador.cod_entidade)
							$scope.dadosColaborador.entidade = entidade;
					});

					$.each($scope.contratos, function(index, origem) {
						if(origem.cod_origem == $scope.dadosColaborador.cod_contrato)
							$scope.dadosColaborador.contrato = origem;
					});

					if((typeof $scope.dadosColaborador.flg_portador_necessidades_especiais != "undefined") && (parseInt($scope.dadosColaborador.flg_portador_necessidades_especiais, 10) == 1)) {
						var element = $("[ng-model='dadosColaborador.flg_portador_necessidades_especiais']");
						// TODO: destruir o elemento
						element.siblings("span.switchery").remove();
						// TODO: adicionar a tag (atributo) "checked"
						element.attr("checked", "checked");
						// TODO: inicializar o elemento novamente
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_ativo != "undefined") && (parseInt($scope.dadosColaborador.flg_ativo, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_ativo']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_hora_extra != "undefined") && (parseInt($scope.dadosColaborador.flg_hora_extra, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_hora_extra']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_trabalho_fim_semana != "undefined") && (parseInt($scope.dadosColaborador.flg_trabalho_fim_semana, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_trabalho_fim_semana']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_trabalho_feriado != "undefined") && (parseInt($scope.dadosColaborador.flg_trabalho_feriado, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_trabalho_feriado']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_ajusta_folha_ponto != "undefined") && (parseInt($scope.dadosColaborador.flg_ajusta_folha_ponto, 10) == 1)){
						var element = $("[ng-model='dadosColaborador.flg_ajusta_folha_ponto']");
						element.siblings("span.switchery").remove();
						element.attr("checked", "checked");
						resetSwitchInput();
					}

					if((typeof $scope.dadosColaborador.flg_ensino_superior != "undefined") && (parseInt($scope.dadosColaborador.flg_ensino_superior, 10) == 1)){
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
	}

	function getTelefonesColaborador(cod_colaborador) {
		$http.get(baseUrlApi() + 'colaborador/telefones?cod_colaborador=' + cod_colaborador)
			.success(function(items){
				$scope.dadosColaborador.telefones = [];

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

					$scope.dadosColaborador.telefones.push(obj);
				});
			});
	}

	function getEmailsColaborador(cod_colaborador) {
		$http.get(baseUrlApi() + 'colaborador/emails?cod_colaborador=' + cod_colaborador)
			.success(function(items){
				$.each(items, function(index, email) {
					items[index].flg_removido = false;
				});

				$scope.dadosColaborador.emails = items;
		});		
	}


	function getFuncoesColaborador(cod_colaborador){
		$http.get(baseUrlApi() + 'colaborador/funcoes/' + cod_colaborador)
			.success(function(items){
				$scope.dadosColaborador.funcoes = [];

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

					$scope.dadosColaborador.funcoes.push(obj);
				});
			});
	}

	function getDependentesColaborador(cod_colaborador) {
		$http.get(baseUrlApi()+'colaborador/dependentes?cod_colaborador='+cod_colaborador)
			.success(function(items){
				$scope.dadosColaborador.dependentes = [];

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
					$scope.dadosColaborador.dependentes.push(obj);
				});
			});
	}

	function getPlanoSaudeColaborador(cod_colaborador) {
		$http.get(baseUrlApi()+'colaborador/beneficios?ben->cod_colaborador='+cod_colaborador+'&ben->cod_tipo_beneficio=9')
			.success(function(items){
				$scope.dadosColaborador.planoSaude = {
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

	function loadEstadosCivis() {
		$http.get(baseUrlApi()+'estados-civis')
			.success(function(items){
				$scope.estadosCivis = items;
			});
	}

	function clearFilesNotUsed(async) {
		if(!$scope.sessionSaved) {
			$.ajax({
				url: "file-directory-clear.php?prefixName="+$scope.activePageId, 
				async: async,
				success:function(){
					console.log('memcache deleted');
				}
			});
		}
	}

	$(window).bind('beforeunload', function(){ 
		if(/Firefox[\/\s](\d+)/.test(navigator.userAgent) && new Number(RegExp.$1) >= 4) {
			console.log('firefox delete');
			clearFilesNotUsed(false);
			return;
		} 
		else {
			console.log('NON-firefox delete');
			clearFilesNotUsed(true);
			return;
		}
	});
	
	// Chamada às funções de inicialização
	loadUfs();
	loadEmpresas();
	loadRegimesContratacao();
	loadLocaisTrabalho();
	loadDepartamentos();
	loadGradesHorario();
	loadSindicatos();
	loadBancos();
	loadEntidades();
	loadOrigens();
	loadTiposTelefone();
	loadFuncoes();
	loadTiposDependencia();
	loadPlanosSaude();
	loadMotivosAlteracaoFuncao();
	loadEstadosCivis();
	getColaboradorByUrlParam();
});