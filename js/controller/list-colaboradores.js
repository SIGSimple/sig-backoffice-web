$('#demo-custom-toolbar').bootstrapTable({
	formatSearch: function() {
		return "Filtrar";
	},
	formatRefresh: function() {
		return "Atualizar Lista";
	},
	formatToggle: function() {
		return "Modo de Exibição";
	},
	formatColumns: function() {
		return "Colunas";
	},
	formatShowingRows: function(pageFrom, pageTo, totalRows) {
		return "Exibindo "+ pageFrom +" até "+ pageTo +" de "+ totalRows +" registros";
	},
	formatRecordsPerPage: function(pageNumber) {
		return pageNumber + " registros por página";
	},
	formatNoMatches: function () {
        return 'Nenhum registro encontrado!';
    },
	formatLoadingMessage: function () {
        return 'Carregando, por favor aguarde...';
    },
});

function ativoFormatter(value) {
	return (parseInt(value,10) == 1) ? '<i class="text-success fa fa-circle"></i> Ativo' : '<i class="text-danger fa fa-circle"></i> Inativo';
}

app.controller('ListColaboradoresCtrl', function($scope, $http){
	
});