app.controller('RelatorioConsolidadoNaturezaOperacaoCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();

	$scope.itensConsolidados 	= [];
	$scope.itensApurados 		= [];
	$scope.resumoApuracao 		= {};

	$scope.loadItensConsolidados = function() {
		var dtaSelected = $scope.dta_selected;
		var dtaInicio 	= "01/" + dtaSelected;
			dtaInicio	= moment(dtaInicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFinal 	= moment(dtaSelected, "MM/YYYY").endOf("month").format("DD") + "/" + dtaSelected;
			dtaFinal	= moment(dtaFinal, "DD/MM/YYYY").format("YYYY-MM-DD");
		
		$(".loading-data").removeClass("hide");

		$http.get(baseUrlApi()+"lancamentos-financeiros/consolidado/natureza-operacao/"+ dtaInicio +"/"+ dtaFinal)
			.success(function(data){
				$scope.itensConsolidados = data;

				setTimeout(function(){
					$(".loading-data").addClass("hide");
					$("#output").pivotUI(
						$scope.itensConsolidados,
						{
							rows: ["dsc_item"],
							cols: ["dsc_origem"]
						},
						false,
						"pt"
					);
				}, 700);
			});
	}

	enableMonthField();
});