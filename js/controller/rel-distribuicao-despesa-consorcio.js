app.controller('RelatorioDistribuicaoDespesasConsorcioCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.items = [];
	$scope.vlr_total_consorcio = 0;
	$scope.vlr_total_desassoreamento = 0;
	$scope.vlr_total_intermultiplas = 0;

	$scope.loadItensConsolidados = function() {
		var dtaSelected = $scope.dta_selected;
		var dtaInicio 	= "01/" + dtaSelected;
			dtaInicio	= moment(dtaInicio, "DD/MM/YYYY").format("YYYY-MM-DD");
		var dtaFinal 	= moment(dtaSelected, "MM/YYYY").endOf("month").format("DD") + "/" + dtaSelected;
			dtaFinal	= moment(dtaFinal, "DD/MM/YYYY").format("YYYY-MM-DD");
		
		$scope.items = [];
		$scope.vlr_total_consorcio = 0;
		$scope.vlr_total_desassoreamento = 0;
		$scope.vlr_total_intermultiplas = 0;

		$http.get(baseUrlApi()+"lancamentos-financeiros/distribuicao/despesas/consorcio/"+ dtaInicio +"/"+ dtaFinal)
			.success(function(data){
				$scope.items = data;
				$.each(data, function(index, item) {
					$scope.vlr_total_consorcio 			+= parseFloat(item.vlr_consorcio);
					$scope.vlr_total_desassoreamento 	+= parseFloat(item.vlr_desassoreamento);
					$scope.vlr_total_intermultiplas 	+= parseFloat(item.vlr_intermultiplas);
				});
			});
	}

	$scope.export = function(extension) {
		if(extension == 'excel') {
			exportToExcel('table.table', 'Cons. Natureza de Operação', moment().format('YYYY-MM-DD') +"_Relatório Consolidado por Natureza de Operação");
		}
	}

	enableMonthField();
});