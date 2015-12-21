app.controller('RelatorioConsolidadoNaturezaOperacaoCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();

	$scope.loadItensConsolidados = function() {
		var dtaSelected = $scope.dta_selected;
		var dtaInicio 	= "01/" + dtaSelected;
			dtaInicio	= moment(dtaInicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFinal 	= moment(dtaSelected, "MM/YYYY").endOf("month").format("DD") + "/" + dtaSelected;
			dtaFinal	= moment(dtaFinal, "DD/MM/YYYY").format("YYYY-MM-DD");
		
		$(".loading-data").removeClass("hide");

		$http.get(baseUrlApi()+"lancamentos-financeiros/consolidado/natureza-operacao/"+ dtaInicio +"/"+ dtaFinal)
			.success(function(data){
				setTimeout(function(){
					$(".loading-data").addClass("hide");
					$("#output").pivotUI(
						data,
						{
							rows: [],
							cols: []
						},
						false,
						"pt"
					);
				}, 700);
			});
	}

	$scope.export = function(extension) {
		if(extension == 'excel') {
			exportToExcel('table.pvtTable', 'Cons. Natureza de Operação', moment().format('YYYY-MM-DD') +"_Relatório Consolidado por Natureza de Operação");
		}
	}

	enableMonthField();
});