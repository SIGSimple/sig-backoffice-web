$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroFinanceiroCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.lancamentoFinanceiro = {
		favorecido: {
			data: {},
			label: ""
		},
		titularMovimento: {
			data: {},
			label: ""
		}
	};
	$scope.favorecido = "";
	$scope.titularMovimento = "";

	// Modal control
	$scope.tmpModal = {};
	var modalTablesColumns = {
		"empresas": [
			{
				field: 'nme_fantasia',
				title: 'Nome Fantasia'
			}
		],

		"colaboradores": [
			{
				field: 'nme_colaborador',
				title: 'Nome Colaborador'
			}
		],

		"terceiros": [
			{
				field: 'nme_terceiro',
				title: 'Nome Terceiro'
			}
		]
	};

	$scope.abreModal = function(type) {
		var rota = "";
		var obj = "";

		if(type == "FAVORECIDO"){
			rota = $scope.favorecido;
			obj = "favorecido";
		}
		else if(type == "TITULAR_MOVIMENTO"){
			rota = $scope.titularMovimento;
			obj = "titularMovimento";
		}

		$("#modalItemsLabel").text("LISTAGEM DE " + rota.replace("-"," de ").toUpperCase());
		$("#modalItems").modal("show");
		$('#mytable').bootstrapTable({
			url: "http://localhost/sig-backoffice-api/"+ rota +".json",
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
				$scope.lancamentoFinanceiro[obj].data = row;
				$scope.lancamentoFinanceiro[obj].label = $element.find("td").text();
				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}
});