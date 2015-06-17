app.controller('RegistroHorarioCtrl', function($scope, $http){
	$scope.mesVigente 				= moment().format("MMMM/2015");
	$scope.qtdTempoIntervalo 		= "";
	$scope.colaborador 				= {};
	$scope.gradeHorarioColaborador 	= [];
	$scope.arrDiasMes 				= getDaysArray(parseInt(moment().format('YYYY'), 10), parseInt(moment().format('M'),10));

	$scope.getToday = function() {
		return moment().format('D');
	}

	function calcQtdHorasMes() {
		$.each($scope.gradeHorarioColaborador, function(i, item) {
			// transforma string em moment object
			var hor_entrada 			= moment(item.hor_entrada, "hh:mm:ss");
			var hor_entrada_intervalo 	= moment(item.hor_entrada_intervalo, "hh:mm:ss");
			var hor_retorno_intervalo 	= moment(item.hor_retorno_intervalo, "hh:mm:ss");
			var hor_saida 				= moment(item.hor_saida, "hh:mm:ss");

			// calcula o tempo de cada escala
			var diff_entrada_saida 		= hor_saida.diff(hor_entrada, "hours");
			var diff_intervalo 			= hor_retorno_intervalo.diff(hor_entrada_intervalo, "hours", true);

			$scope.qtdTempoIntervalo = (diff_intervalo < 1) ? (diff_intervalo * 60) + " minuto(s) p/ intervalo" : diff_intervalo + " hora(s) p/ intervalo";

			// calcula o tempo real de trabalho diário
			var tmp_efetivo_diario = (diff_entrada_saida - diff_intervalo);
		});
	}

	function getDadosColaborador() {
		$http.get('http://localhost/sig-backoffice-api/colaboradores?cod_colaborador=109')
			.success(function(data) {
				if(data.rows.length > 0) {
					$scope.colaborador = data.rows[0];
					getProgramacaoGradeHorarioColaborador();
				}
			});
	}

	function getProgramacaoGradeHorarioColaborador() {
		$http.get('http://localhost/sig-backoffice-api/grade-horario-programacao?cod_grade_horario='+ $scope.colaborador.cod_grade_horario)
			.success(function(data) {
				if(data.rows.length > 0) {
					$scope.gradeHorarioColaborador = data.rows;
					calcQtdHorasMes();
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
				numDate: (i + 1),
				nmeDate: daysInWeek[idx],
				cptDate: year + '/' + month + '/' + (i + 1),
				flgWeekend: (daysInWeek[idx] == 'Sábado' || daysInWeek[idx] == 'Domingo')
			});
			if (index == 7) index = 0;
		}

		return daysArray;
	}

	getDadosColaborador();
});