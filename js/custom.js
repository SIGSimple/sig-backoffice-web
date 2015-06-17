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