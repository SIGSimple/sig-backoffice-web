$(function(){
	moment.locale('pt-br');
	initializeTimepickerInputs();

	$('.input-group.date').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	});

	$.each($('.input-switch'), function(i, el){
		new Switchery(el);
	});

	$('[data-toggle="tooltip"]').tooltip();
})

function showNotification(title, message, icon, container, status) {
	var alertType = "";

	switch(status) {
		case 200:
		case 201:
			title = "Pronto!";
			alertType = 'success';
			icon = 'fa-check-circle fa-lg';
			break;
		case 404:
		case 500:
			title = "Ocorreu um erro!";
			alertType = 'danger';
			icon = 'fa-times-circle fa-lg';
			break;
		case 406:
			title = "Ops!";
			alertType = 'warning';
			icon = 'fa-warning fa-lg';
			break;
		default:
			alertType = 'dark';
			break;
	}

	$.niftyNoty({
		type: alertType,
		container: container,
		icon: 'fa ' + icon,
		title : title,
		message : message,
		timer : 5000
	});
}

function initializeTimepickerInputs() {
	$('.input-timepicker').timepicker({
		minuteStep: 1,
		secondStep: 5,
		showInputs: false,
		template: 'modal',
		modalBackdrop: true,
		showSeconds: false,
		showMeridian: false
	});
}

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

// Applying a theme
// ================================
function changeTheme(themeName, type){
	var themeCSS = $('#theme'),
	filename = 'css/themes/type-'+type+'/'+themeName+'.min.css';

	if (themeCSS.length) {
		themeCSS.prop('href', filename);
	}else{
		themeCSS = '<link id="theme" href="'+filename+'" rel="stylesheet">';
		$('head').append(themeCSS);
	}
}