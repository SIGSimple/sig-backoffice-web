configBootstrapTable();

function actionsLancamentoFinanceiroFormatter(value, row, index) {
	return [
		'<a class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Editar Lançamento" ',
			'href="form-new-lancamento-financeiro?cod_lancamento_financeiro='+ row.cod_lancamento_financeiro +'">',
			'<i class="fa fa-edit"></i>',
		'</a>'
	].join('');
}

app.controller('ListLancamentosFinanceirosCtrl', function($scope, $http){
	
});