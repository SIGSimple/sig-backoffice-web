$(function(){
	moment.locale('pt-br');
	initializeTimepickerInputs();

	enableDateField();

	resetSwitchInput();

	$('[data-toggle="tooltip"]').tooltip();

	var feedbackValidatorIcons = {
		valid: 'fa fa-check-circle fa-lg text-success',
		invalid: 'fa fa-times-circle fa-lg',
		validating: 'fa fa-refresh'
	};
});

function getActivePageId() {
	return Math.random().toString(36).slice(2);
}

function resetSwitchInput() {
	$("span.switchery").remove();
	$.each($('.input-switch'), function(i, el){
		new Switchery(el);
	});
}

function enableDateField() {
	setTimeout(function() {
		$('.input-group.date').datepicker({
			language: 'pt-BR',
			format: 'dd/mm/yyyy',
			autoclose: true
		});
	}, 1000);
}

function getActivePage() {
	return document.location.pathname.split('/')[document.location.pathname.split('/').length-1];
}

function showNotification(title, message, icon, container, status, time) {
	var alertType = "";

	switch(status) {
		case 200:
		case 201:
			if(title == "")
				title = "Pronto!";
			alertType = 'success';
			icon = 'fa-check-circle fa-lg';
			break;
		case 404:
		case 500:
			if(title == "")
				title = "Ocorreu um erro!";
			alertType = 'danger';
			icon = 'fa-times-circle fa-lg';
			break;
		case 406:
			if(title == "")
				title = "Ops!";
			alertType = 'warning';
			icon = 'fa-warning fa-lg';
			break;
		default:
			alertType = 'dark';
			break;
	}

	if(time === 0 || time == null)
		time = 5000;

	$.niftyNoty({
		type: alertType,
		container: container,
		icon: 'fa ' + icon,
		title : title,
		message : message,
		timer : time
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
	$('.bootstrap-table').on('load-success.bs.table', function(){
		$(".img-profile-table").popover();
	});
}

function ativoFormatter(value) {
	return (parseInt(value,10) == 1) ? '<i class="text-success fa fa-circle"></i> Ativo' : '<i class="text-danger fa fa-circle"></i> Inativo';
}

function dateFormatter(value) {
	return moment(value, "YYYY-MM-DD").format("DD/MM/YYYY");
}

function currencyFormatter(value) {
	var isParsed = (parseFloat(value)) ? true : false;

	if(isParsed)
		return "R$ " + numberFormat(parseFloat(value), 2, ",", ".");
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