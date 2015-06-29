$('#demo-cls-wz').bootstrapWizard({
	tabClass		: 'wz-classic',
	nextSelector	: '.next',
	previousSelector	: '.previous',
	onTabClick: function(tab, navigation, index) {
		return false;
	},
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
		} else {
			$('#demo-cls-wz').find('.next').show();
			$('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
		}
	}
});

app.controller('CadastroColaboradorCtrl', function($scope, $http, UserSrvc){
	// Definição de variáveis de uso da tela
	$scope.dadosColaborador = {
		num_matricula: "",
		nme_colaborador: "",
		flg_portador_necessidades_especiais: 0,
		cod_empresa_contratante: 0,
		cod_contrato: 0,
		cod_contrato: 0,
		cod_regime_contratacao: 0,
		cod_departamento: 0,
		flg_cm: 0,
		cod_local_trabalho: 0,
		cod_grade_horario: 0,
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
		flg_sexo: "",
		cod_banco: 0,
		num_agencia: "",
		num_digito_agencia: "",
		num_conta_corrente: "",
		num_digito_conta_corrente: "",
		cod_sindicato: 0,
		pth_arquivo_cnh: "",
		pth_arquivo_rg: "",
		pth_arquivo_foto: "",
		pth_arquivo_cpf: "",
		pth_arquivo_entidade: "",
		pth_arquivo_curriculo: "",
		pth_arquivo_reservista: "",
		cod_entidade: 0,
		num_entidade: ""
	};
	$scope.ufs = [];
	$scope.cidadesMoradia = [];
	$scope.cidadesNaturalidade = [];
	$scope.empresasContratante = [];
	$scope.regimesContratacao = [];
	$scope.locaisTrabalho = [];
	$scope.departamentos = [];
	$scope.contratos = [];
	$scope.gradesHorario = [];
	$scope.sindicatos = [];
	$scope.bancos = [];
	$scope.entidades = [];
	

	// Definição de funções de utilização da tela
	$scope.getCidades = function(el_destino) {
		$(".loading-cidade-" + el_destino).removeClass("hide");

		var cod_estado = 0;

		if(el_destino === 'moradia')
			cod_estado = $scope.dadosColaborador.cod_estado_moradia;
		else if(el_destino === 'naturalidade')
			cod_estado = $scope.dadosColaborador.cod_estado_naturalidade;
	
		$http.get('http://localhost/sig-backoffice-api/cidades?cod_estado='+ cod_estado)
			.success(function(items){
				if(el_destino === 'moradia')
					$scope.cidadesMoradia = items;
				else if(el_destino === 'naturalidade')
					$scope.cidadesNaturalidade = items;

				$(".loading-cidade-" + el_destino).addClass("hide");
				$('.selectpicker').selectpicker('refresh');
			});
	}

	// Definição de funções auxiliares
	function loadUfs() {
		$http.get('http://localhost/sig-backoffice-api/estados')
			.success(function(items){
				$scope.ufs = items;
			});
	}

	function loadEmpresas() {
			$http.get('http://localhost/sig-backoffice-api/empresas')
			.success(function(items){
				$scope.empresasContratante = items.rows;
			});
	}

	function loadRegimesContratacao() {
			$http.get('http://localhost/sig-backoffice-api/regimes-contratacao')
			.success(function(items){
				$scope.regimesContratacao = items.rows;
			});
	}

		function loadLocaisTrabalho() {
			$http.get('http://localhost/sig-backoffice-api/locais-trabalho')
			.success(function(items){
				$scope.locaisTrabalho = items.rows;
			});
	}

	function loadDepartamentos() {
			$http.get('http://localhost/sig-backoffice-api/departamentos')
			.success(function(items){
				$scope.departamentos = items.rows;
			});
	}

		function loadContratos() {
			$http.get('http://localhost/sig-backoffice-api/colaboradores')
			.success(function(items){
				$scope.contratos = items.rows;
			});
	}

	function loadGradesHorario() {
			$http.get('http://localhost/sig-backoffice-api/grades-horario')
			.success(function(items){
				$scope.gradesHorario = items.rows;
			});
	}

	function loadSindicatos() {
			$http.get('http://localhost/sig-backoffice-api/sindicatos')
			.success(function(items){
				$scope.sindicatos = items.rows;
			});
	}

	function loadBancos() {
			$http.get('http://localhost/sig-backoffice-api/bancos')
			.success(function(items){
				$scope.bancos = items.rows;
			});
	}

	function loadEntidades() {
			$http.get('http://localhost/sig-backoffice-api/entidades')
			.success(function(items){
				$scope.entidades = items.rows;
			});
	}

	

	// Chamada às funções de inicialização
	loadUfs();
	loadEmpresas();
	loadRegimesContratacao();
	loadLocaisTrabalho();
	loadDepartamentos();
	loadContratos();
	loadGradesHorario();
	loadSindicatos();
	loadBancos();
	loadEntidades();
});