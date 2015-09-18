$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroHistoricoVeiculoCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.historicoVeiculo = {
		beneficiario: {
			data: {

			},
			label: ""
		}
	};
	$scope.beneficiario = "";

	var modalTablesColumns = {
		"colaboradores": [
			{
				field: 'nme_colaborador',
				title: 'Nome Colaborador'
			}
		]
	};

	$scope.abreModal = function() {
		var rota = $scope.beneficiario;

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
				$scope.historicoVeiculo.beneficiario.data = row;
				$scope.historicoVeiculo.beneficiario.label = $element.find("td").text();
				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}
});