$(function(){
	moment.locale('pt-br');
	$('.input-timepicker').timepicker({
		minuteStep: 1,
		secondStep: 5,
		showInputs: false,
		template: 'modal',
		modalBackdrop: true,
		showSeconds: false,
		showMeridian: false
	});
})

function configBootstrapTable() {
	$('.bootstrap-table').bootstrapTable({
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
}

function ativoFormatter(value) {
	return (parseInt(value,10) == 1) ? '<i class="text-success fa fa-circle"></i> Ativo' : '<i class="text-danger fa fa-circle"></i> Inativo';
}

function getQueryParams(qs) {
	qs = qs.split('+').join(' ');

	var params = {},
	tokens,
	re = /[?&]?([^=]+)=([^&]*)/g;

	while (tokens = re.exec(qs)) {
		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
	}

	return params;
}