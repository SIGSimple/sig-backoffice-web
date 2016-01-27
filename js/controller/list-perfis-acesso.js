configBootstrapTable();

function editFormater(value, row, index) {
	return [
        '<a class="btn btn-xs btn-warning" href="form-new-perfil-acesso?cod_perfil='+ row.cod_perfil +'" data-toggle="tooltip" title="Visualizar Cadastro">',
        	'<i class="fa fa-edit"></i>',
        '</a>'
    ].join('');
}

app.controller('ListPerfisAcessoCtrl', function($scope, $http){
	
});