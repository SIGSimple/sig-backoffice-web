app.controller('RegistroHorarioCtrl', function($scope, $http, UserSrvc){
	$scope.txtEscalaTrabalho 		= "";
	$scope.mesVigente 				= moment().format("MMMM/2015");
	$scope.qtdTempoIntervalo 		= "";
	$scope.colaborador 				= UserSrvc.getUserLogged();
	$scope.colaborador.gradeHorario = [];
	$scope.arrDiasMes 				= getDaysArray(parseInt(moment().format('YYYY'), 10), parseInt(moment().format('M'),10));

	$scope.getToday = function() {
		return moment().format('D');
	}

	$scope.validaHoraExtra = function(item) {
		var programacaoTrabalhoDia 					= getProgramacaoTrabalhoDia(item.nmeDate);
		var qtdHorasTrabalhoEfetivaProgramacaoDia 	= getQtdHorasTrabalhoDiario(programacaoTrabalhoDia).qtd_horas_efetivas_trabalho;
		var qtdHorasTrabalhoEfetivaRegitro 			= getQtdHorasTrabalhoDiario(item).qtd_horas_efetivas_trabalho;
		var qtdHoraExtraDia 						= qtdHorasTrabalhoEfetivaRegitro - qtdHorasTrabalhoEfetivaProgramacaoDia;

		item.qtd_hora_extra = qtdHoraExtraDia;

		if(qtdHoraExtraDia > 0 && qtdHoraExtraDia < 1)
			item.hor_extra = "0:" + (qtdHoraExtraDia * 60);
		else if(qtdHoraExtraDia == 1)
			item.hor_extra = "1:00";
		else if(qtdHoraExtraDia > 1) {
			var hours = parseInt(qtdHoraExtraDia, 10);
			var minutes = parseInt(((qtdHoraExtraDia - hours) * 60).toFixed(0),10);

			item.hor_extra = hours + ":"+ minutes;
		}
	}

	function getProgramacaoTrabalhoDia(diaSemana) {
		var programacaoTrabalhoDia;
		
		$.each($scope.colaborador.gradeHorario, function(i, item) {
			if(diaSemana.toUpperCase() == item.nme_completo_dia_semana)
				programacaoTrabalhoDia = item;
		});

		return programacaoTrabalhoDia;
	}

	function calcEscalaTrabalhoColaborador() {
		var primeiroDiaSemana 	= $scope.colaborador.gradeHorario[0];
		var penultimoDiaSemana 	= $scope.colaborador.gradeHorario[($scope.colaborador.gradeHorario.length - 2)];
		var ultimoDiaSemana 	= $scope.colaborador.gradeHorario[($scope.colaborador.gradeHorario.length - 1)];

		if(ultimoDiaSemana.hor_entrada == primeiroDiaSemana.hor_entrada 
			&& ultimoDiaSemana.hor_saida == primeiroDiaSemana.hor_saida) {
			$scope.txtEscalaTrabalho += primeiroDiaSemana.nme_mini_dia_semana + " a " + ultimoDiaSemana.nme_mini_dia_semana;
			$scope.txtEscalaTrabalho += " das ";
			$scope.txtEscalaTrabalho += primeiroDiaSemana.hor_entrada + " as " + primeiroDiaSemana.hor_saida;
		} else {
			$scope.txtEscalaTrabalho += primeiroDiaSemana.nme_mini_dia_semana + " a " + penultimoDiaSemana.nme_mini_dia_semana;
			$scope.txtEscalaTrabalho += " das ";
			$scope.txtEscalaTrabalho += primeiroDiaSemana.hor_entrada + " as " + primeiroDiaSemana.hor_saida;

			$scope.txtEscalaTrabalho += " - ";
			$scope.txtEscalaTrabalho += ultimoDiaSemana.nme_mini_dia_semana;
			$scope.txtEscalaTrabalho += " das ";
			$scope.txtEscalaTrabalho += ultimoDiaSemana.hor_entrada + " as " + ultimoDiaSemana.hor_saida;
		}
	}

	function getQtdHorasTrabalhoDiario(gradeHorarioDia) {
		// transforma string em moment object
		var hor_entrada 			= moment(gradeHorarioDia.hor_entrada, "hh:mm:ss");
		var hor_entrada_intervalo 	= moment(gradeHorarioDia.hor_entrada_intervalo, "hh:mm:ss");
		var hor_retorno_intervalo 	= moment(gradeHorarioDia.hor_retorno_intervalo, "hh:mm:ss");
		var hor_saida 				= moment(gradeHorarioDia.hor_saida, "hh:mm:ss");

		// calcula o tempo de cada escala
		var diff_entrada_saida 		= hor_saida.diff(hor_entrada, "hours", true);
		var diff_intervalo 			= hor_retorno_intervalo.diff(hor_entrada_intervalo, "hours", true);

		// calcula o tempo real de trabalho diário
		var tmp_efetivo_diario 		= (diff_entrada_saida - diff_intervalo);

		return {
			qtd_horas_efetivas_trabalho: tmp_efetivo_diario,
			qtd_tempo_intervalo: diff_intervalo
		};
	}

	function getProgramacaoGradeHorario() {
		$http.get('http://localhost/sig-backoffice-api/grade-horario-programacao?cod_grade_horario='+ $scope.colaborador.cod_grade_horario)
			.success(function(data) {
				if(data.rows.length > 0) {
					$scope.colaborador.gradeHorario = data.rows;

					var qtdTempoIntervalo = getQtdHorasTrabalhoDiario($scope.colaborador.gradeHorario[0]).qtd_tempo_intervalo;
						qtdTempoIntervalo = (qtdTempoIntervalo < 1) ? (qtdTempoIntervalo * 60) + " minuto(s) p/ intervalo" : qtdTempoIntervalo + " hora(s) p/ intervalo";

					$scope.qtdTempoIntervalo = qtdTempoIntervalo;

					calcEscalaTrabalhoColaborador();
				}
			});
	}
	
	function getDaysArray(year, month) {
		var numDaysInMonth, daysInWeek, daysIndex, index, i, l, daysArray;

		numDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		daysInWeek = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
		daysIndex = { 'Sun': 0, 'Mon': 1, 'Tue': 2, 'Wed': 3, 'Thu': 4, 'Fri': 5, 'Sat': 6 };
		index = daysIndex[(new Date(year, month - 1, 1)).toString().split(' ')[0]];
		daysArray = [];

		for (i = 0, l = numDaysInMonth[month - 1]; i < l; i++) {
			idx = index++;
			daysArray.push({
				hor_entrada: "0:00",
				hor_entrada_intervalo: "0:00",
				hor_retorno_intervalo: "0:00",
				hor_saida: "0:00",
				hor_extra: "0:00",
				numDate: (i + 1),
				nmeDate: daysInWeek[idx],
				cptDate: year + '/' + month + '/' + (i + 1),
				flgWeekend: (daysInWeek[idx] == 'Sábado' || daysInWeek[idx] == 'Domingo')
			});
			if (index == 7) index = 0;
		}

		return daysArray;
	}

	getProgramacaoGradeHorario();
});