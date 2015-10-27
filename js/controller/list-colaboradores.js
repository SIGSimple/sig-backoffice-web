configBootstrapTable();

function fotoFormatter(value, row, index) {
	if(value != null && value != "") {
		if(window.location.hostname == "localhost")
			value = value.replace("/home/consorciointermultip/public_html/files/docs/", "../sig-backoffice-files/");
		else
			value = value.replace("/home/consorciointermultip/public_html/", "");
	}
	else if(row.flg_sexo == "M")
		value = "img/av1.png";
	else if(row.flg_sexo == "F")
		value = "img/av6.png";
	else
		value = "img/logo_intermultiplas.jpg";

	var imgInner = '<img src=\''+ value +'\' class=\'img img-thumbnail\'>';
	var popover = 'data-toggle="popover" data-title="'+ row.nme_colaborador +'" data-content="'+ imgInner +'" data-html="true" data-placement="right" data-trigger="hover"';

	return (value != null && value != "") ? '<img src="'+ value +'" class="img-profile-table" '+ popover +'>' : '';
}

function editFormater(value, row, index) {
	return [
        '<a class="btn btn-xs btn-warning" href="form-new-colaborador?cod_colaborador='+ row.cod_colaborador +'">',
        	'<i class="fa fa-edit"></i> Visualizar Cadastro',
        '</a>'
    ].join('');
}

function queryParams() {
	var params = {};
	var flg_ativo = $("input[name='flg_ativo']").prop('checked');
	var flg_inativo = $("input[name='flg_inativo']").prop('checked');

	if(flg_ativo && flg_inativo)
		params['col->flg_ativo[exp]']= "=1 OR col.flg_ativo=0";
	else if(flg_ativo)
		params['col->flg_ativo']= "1";
	else if(flg_inativo)
		params['col->flg_ativo']= "0";
	return params;
}

app.controller('ListColaboradoresCtrl', function($scope, $http){
	$scope.refreshTable = function (){
		$('.bootstrap-table').bootstrapTable('refresh');
	}
});