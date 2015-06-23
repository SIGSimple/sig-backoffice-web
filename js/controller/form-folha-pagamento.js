app.controller('FolhaPagamentoCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador 	= UserSrvc.getUserLogged();

	$scope.folhaPagamento = {
		vlrSalarioBruto: 2343.3,
		vlrSalarioLiquido: 0,
		qtdDependentes: 1,
		vlrTotalProventos: 0,
		vlrTotalDescontos: 0,
		vlrBaseIRRF: 0,
		vlrFGTS: 0,
		vlrDeducaoIRRFFaixa: 142.8,
		vlrDeducaoIRRFDependente: 189.59,
		vlrDeducaoIRRFDependenteTotal: 0,
		vlrAliquotaFGTSEmpresa: 8,
		registros: [
			{
				dsc_registro: "Salário",
				vlr_referencia: 30,
				vlr_total: 2343.3,
				cod_tipo_registro: 1,
				cod_unidade_medida: 1
			},{
				dsc_registro: "Hora Extra 70%",
				vlr_referencia: moment('9', 'h').toDate(),
				vlr_total: 162.9,
				cod_tipo_registro: 1,
				cod_unidade_medida: 3
			},{
				dsc_registro: "DSR S/Horas Extras",
				vlr_referencia: null,
				vlr_total: 39.1,
				cod_tipo_registro: 1,
				cod_unidade_medida: null
			},{
				dsc_registro: "I.N.S.S.",
				vlr_referencia: 11,
				vlr_total: 279.98,
				cod_tipo_registro: 2,
				cod_unidade_medida: 2
			},{
				dsc_registro: "I.R.R.F",
				vlr_referencia: 7.5,
				vlr_total: 12.88,
				cod_tipo_registro: 2,
				cod_unidade_medida: 2
			},{
				dsc_registro: "Desc. Vale Alimentação",
				vlr_referencia: null,
				vlr_total: 113.4,
				cod_tipo_registro: 2,
				cod_unidade_medida: null
			},{
				dsc_registro: "Assistência Médica Titular",
				vlr_referencia: null,
				vlr_total: 109.46,
				cod_tipo_registro: 2,
				cod_unidade_medida: 1
			}
		]
	};

	function calcTotais() {
		var vlrINSS = 0;
		var vlrIRRF = 0;

		$.each($scope.folhaPagamento.registros, function(i, registro) {
			if(registro.cod_tipo_registro == 1)
				$scope.folhaPagamento.vlrTotalProventos += registro.vlr_total;
			else if(registro.cod_tipo_registro == 2) {
				$scope.folhaPagamento.vlrTotalDescontos += registro.vlr_total;
				
				if(registro.dsc_registro == "I.N.S.S.")
					vlrINSS = registro.vlr_total;
				
				if(registro.dsc_registro == "I.R.R.F")
					vlrIRRF = registro.vlr_total;
			}
		});

		$scope.folhaPagamento.vlrDeducaoIRRFDependenteTotal = ($scope.folhaPagamento.qtdDependentes * $scope.folhaPagamento.vlrDeducaoIRRFDependente);
		$scope.folhaPagamento.vlrBaseIRRF = ($scope.folhaPagamento.vlrBaseINSSEmpresa - vlrINSS - ($scope.folhaPagamento.vlrDeducaoIRRFDependenteTotal));
		$scope.folhaPagamento.vlrFGTS = (($scope.folhaPagamento.vlrTotalProventos * $scope.folhaPagamento.vlrAliquotaFGTSEmpresa) / 100);
		$scope.folhaPagamento.vlrSalarioLiquido = ($scope.folhaPagamento.vlrTotalProventos - $scope.folhaPagamento.vlrTotalDescontos);
	}

	calcTotais();
});