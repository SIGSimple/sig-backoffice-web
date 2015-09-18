$("#modalItems").on("hidden.bs.modal", function(e){
	$('#mytable').bootstrapTable('destroy');
});

app.controller('CadastroPassagemPedagioCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador = UserSrvc.getUserLogged();
	$scope.passagemPedagio = {};
	
	
	var modalTablesColumns = {
		"veiculos": [
			{
				field: 'nme_modelo',
				title: 'Modelo'
			},

			{
				field: 'num_placa',
				title: 'Placa'
			},
				
			{
				field: 'num_renavam',
				title: 'Renavam'
			},
		
			{
				field: 'ano_fabricacao',
				title: 'Ano de Fabricação'
			},
		
			{
				field: 'ano_modelo',
				title: 'Ano do Modelo'
			}
		]
	};

	$scope.abreModal = function(rota, atributo) {
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
				$scope.passagemPedagio[atributo] = row;
				$scope.$apply();
				$('#mytable').bootstrapTable('destroy');
				$("#modalItems").modal("hide");
			}
		});
	}
});