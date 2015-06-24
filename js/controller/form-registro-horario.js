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

	$scope.validaHoraExtra = function(item, index) {
		if(item.hor_saida.indexOf(":") == -1)
			if(item.hor_saida.length == 4)
				item.hor_saida = item.hor_saida.substr(0,2) + ":" + item.hor_saida.substr(2,2);
			else
				item.hor_saida = item.hor_saida.substr(0,2) + ":00";

		var programacaoTrabalhoDia 					= getProgramacaoTrabalhoDia(item.nmeDate);
		var qtdHorasTrabalhoTotalProgramacao 		= 0;
		var qtdHorasTrabalhoEfetivasProgramacao 	= 0;
		var qtdTempoIntervaloProgramacao 			= 0;

		if(programacaoTrabalhoDia) {
			var qtdHorasTrabalhoTotalProgramacao 		= getQtdHorasTrabalhoDiario(programacaoTrabalhoDia).qtd_horas_total_trabalho;
			var qtdHorasTrabalhoEfetivasProgramacao 	= getQtdHorasTrabalhoDiario(programacaoTrabalhoDia).qtd_horas_efetivas_trabalho;
			var qtdTempoIntervaloProgramacao 			= getQtdHorasTrabalhoDiario(programacaoTrabalhoDia).qtd_tempo_intervalo;
		}

		var dtaEntrada 	= moment(item.cptDate + ' ' + item.hor_entrada, 'YYYY/M/D HH:mm');
		var dtaSaida 	= moment(item.cptDate + ' ' + item.hor_saida, 'YYYY/M/D HH:mm');

		if(dtaEntrada.unix() != dtaSaida.unix()) {
			if(parseInt(item.hor_saida.split(":")[0]) <= parseInt(item.hor_entrada.split(":")[0]))
				dtaSaida.add(1, 'd');

			var summaryOfDay = getHorasTrabalho(dtaEntrada, dtaSaida, qtdHorasTrabalhoTotalProgramacao);

			$.extend(item, summaryOfDay);

			if(summaryOfDay.qtd_horas_trabalhadas < qtdHorasTrabalhoEfetivasProgramacao) {
				item.hor_extra = formatHoraExtra(qtdHorasTrabalhoEfetivasProgramacao - summaryOfDay.qtd_horas_trabalhadas, true);
				item.qtd_total_hora_extra = summaryOfDay.qtd_horas_trabalhadas - qtdHorasTrabalhoEfetivasProgramacao;
			}
			else if(item.flg_hora_extra){
				item.hor_extra = formatHoraExtra(item.qtd_total_hora_extra);
			}
			else
				item.hor_extra = formatHoraExtra(0);
		}
		else {
			item.hor_extra = formatHoraExtra(0);
			item.flg_hora_extra = false;
			item.flg_terminou_mesmo_dia = true;
			item.qtd_hora_adicional_noturno = 0;
			item.qtd_hora_extra_dia_fim = 0;
			item.qtd_hora_extra_dia_inicio = 0;
			item.qtd_horas_trabalhadas = 0;
			item.qtd_total_hora_extra = 0;
		}

		calcTotaisHoraExtra();
	}

	function formatHoraExtra(qtdHoraExtra, isNegativeValue) {
		var value = "";

		if(qtdHoraExtra > 0 && qtdHoraExtra < 1)
			value = "0:" + adicionaZeros(parseFloat((qtdHoraExtra*60).toFixed(0)), "right");
		else if(qtdHoraExtra == 1)
			value = "1:00";
		else if(qtdHoraExtra < 0 || qtdHoraExtra > 1) {
			var hours = parseInt(qtdHoraExtra, 10);
			var minutes = adicionaZeros(parseInt(((qtdHoraExtra - hours) * 60).toFixed(0),10), "right");

			value = hours + ":"+ minutes;
		}
		else
			value = "0:00";

		if(isNegativeValue)
			value = "-" + value;

		return value;
	}

	function adicionaZeros(value, side) {
		if(value < 10 && side == "left")
			value = "0" + value;

		if(value < 11 && side == "right")
			value = value + "0";

		return value;
	}

	function getHorasTrabalho(vHoraInicio, vHoraFim, vJornadaContratual) {
		// declares
		var vHoraFimDiaInicio				= moment(vHoraInicio.format('YYYY-MM-DD') + ' 23:59:59', 'YYYY-MM-DD HH:mm');
		var vHoraInicioAdicionalNoturno 	= moment(vHoraInicio.format('YYYY-MM-DD') + ' 22:00:00', 'YYYY-MM-DD HH:mm');
		var vHoraInicioAuxiliar 			= moment(vHoraInicio.format('YYYY-MM-DD') + ' '+ vHoraInicio.format('HH:mm'), 'YYYY-MM-DD HH:mm');
		var vHoraFimAdicionalNoturno 		= moment(vHoraInicioAuxiliar.add(1, 'd').format('YYYY-MM-DD') + ' 05:00:00', 'YYYY-MM-DD HH:mm');
		var vDiffHoras 						= 0;
		var vDataAuxiliar					= moment();
		var vHoraTotalExtra 				= 0;
		var vHoraExtraDiaIninicio 			= 0;
		var vHoraExtraDiaFim	 			= 0;
		var vAdicionalNoturno 				= 0;
		var vMesmoDia 						= (vHoraInicio.format('YYYY-MM-DD') == vHoraFim.format('YYYY-MM-DD'));

		vDiffHoras = vHoraFim.diff(vHoraInicio, 'hours', true);
		vHoraTotalExtra = (vDiffHoras - vJornadaContratual);

		if(vHoraExtraDiaIninicio == 0 && !vMesmoDia){
			vHoraExtraDiaIninicio 	= (vHoraFimDiaInicio.diff(vHoraInicio, 'hours') - vJornadaContratual);
			vHoraExtraDiaFim 		= (vHoraTotalExtra - vHoraExtraDiaIninicio);
		}
		else
			vHoraExtraDiaFim = vHoraTotalExtra;

		if(!vMesmoDia) {
			if(vHoraInicio > vHoraInicioAdicionalNoturno)
				vDataAuxiliar = vHoraInicio;
			else
				vDataAuxiliar = moment(vHoraInicio.format('YYYY-MM-DD') + ' ' + vHoraInicioAdicionalNoturno.format('HH:mm'), 'YYYY-MM-DD HH:mm');

			vAdicionalNoturno = parseFloat((moment(vHoraFim.format('YYYY-MM-DD') + ' 00:00:00', 'YYYY-MM-DD HH:mm')).diff(vDataAuxiliar, 'hours', true).toFixed(2));

			if(vHoraFim < vHoraFimAdicionalNoturno)
				vDataAuxiliar = vHoraFim;
			else
				vDataAuxiliar = moment(vHoraFim.format('YYYY-MM-DD') + ' ' + vHoraFimAdicionalNoturno.format('HH:mm'), 'YYYY-MM-DD HH:mm');

			vAdicionalNoturno += parseFloat(vDataAuxiliar.diff(moment(vHoraFim.format('YYYY-MM-DD') + ' 00:00:00', 'YYYY-MM-DD HH:mm'), 'hours', true).toFixed(2));
		}
		else {
			vAdicionalNoturno = parseFloat(vHoraFim.diff(moment(vHoraInicio.format('YYYY-MM-DD') + ' ' + vHoraInicioAdicionalNoturno.format('HH:mm'), 'YYYY-MM-DD HH:mm'), 'hours', true).toFixed(2));
			if(vAdicionalNoturno < 0)
				vAdicionalNoturno = 0;
		}

		if(vHoraExtraDiaIninicio < 0)
			vHoraExtraDiaIninicio = 0;

		if(vAdicionalNoturno > 0 && vAdicionalNoturno < 1)
			vAdicionalNoturno = 1;

		return {
			qtd_horas_trabalhadas: vDiffHoras,
			flg_terminou_mesmo_dia: vMesmoDia,
			flg_hora_extra: (vHoraTotalExtra > 0),
			qtd_total_hora_extra: vHoraTotalExtra, 
			qtd_hora_extra_dia_inicio: vHoraExtraDiaIninicio,
			qtd_hora_extra_dia_fim: vHoraExtraDiaFim,
			qtd_hora_adicional_noturno: vAdicionalNoturno
		};
	}

	function getProgramacaoTrabalhoDia(diaSemana) {
		var programacaoTrabalhoDia;
		
		$.each($scope.colaborador.gradeHorario, function(i, item) {
			if(diaSemana.toUpperCase() == item.nme_completo_dia_semana)
				programacaoTrabalhoDia = item;
		});

		return programacaoTrabalhoDia;
	}

	function getIndexHoraExtra(field, value) {
		var index;
		
		$.each($scope.colaborador.horasExtras, function(i, item) {
			if(value == item[field])
				index = i;
		});

		return index;
	}

	function calcTotaisHoraExtra() {
		// limpa os valores para a recontagem
		$.each($scope.colaborador.horasExtras, function(i, item) {
			$scope.colaborador.horasExtras[i].qtdHoraExtra = 0;
			$scope.colaborador.horasExtras[i].qtd_hora_extra = formatHoraExtra(0);
			$scope.colaborador.horasAdicionalNoturno = 0;
			$scope.colaborador.qtd_horas_adicional_noturno = formatHoraExtra(0);
		});

		// calcula as horas extras
		// valida se as horas extras são por escala de dia da semana
		if($scope.colaborador.escalaHoraExtra.length > 0) {
			$.each($scope.arrDiasMes, function(i, item) {
				$.each($scope.colaborador.escalaHoraExtra, function(x, xitem) {
					if(item.nmeDate.toUpperCase() == xitem.nme_completo_dia_semana) {
						if(item.qtd_total_hora_extra) {
							var idxHE = getIndexHoraExtra('num_percentual_hora_extra', xitem.num_percentual_hora_extra);

							if(!item.flg_terminou_mesmo_dia) {
								$scope.colaborador.horasExtras[idxHE].qtdHoraExtra += item.qtd_hora_extra_dia_inicio;
								$scope.colaborador.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[idxHE].qtdHoraExtra);

								if($scope.colaborador.horasExtras[idxHE+1]) {
									$scope.colaborador.horasExtras[idxHE+1].qtdHoraExtra += item.qtd_hora_extra_dia_fim;
									$scope.colaborador.horasExtras[idxHE+1].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[idxHE+1].qtdHoraExtra);
								}
								else {
									$scope.colaborador.horasExtras[0].qtdHoraExtra += item.qtd_hora_extra_dia_fim;
									$scope.colaborador.horasExtras[0].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[0].qtdHoraExtra);
								}
							}
							else {
								$scope.colaborador.horasExtras[idxHE].qtdHoraExtra += item.qtd_total_hora_extra;
								$scope.colaborador.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[idxHE].qtdHoraExtra);
							}
						}
					}
				});
			});
		}
		// valida se as horas extras são por faixa de horário
		else if($scope.colaborador.faixaHoraExtra.length > 0) {
			var qtdTotalHoraExtra = 0;

			$.each($scope.arrDiasMes, function(i, item) {
				if(item.qtd_total_hora_extra)
					qtdTotalHoraExtra += item.qtd_total_hora_extra;
			});

			if(qtdTotalHoraExtra > 0) {
				if(qtdTotalHoraExtra == 1) {
					$scope.colaborador.horasExtras[0].qtdHoraExtra += qtdTotalHoraExtra;
					$scope.colaborador.horasExtras[0].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[0].qtdHoraExtra);
				} else {
					$.each($scope.colaborador.horasExtras, function(i, faixa){
						if(qtdTotalHoraExtra >= faixa.qtd_hora_extra_de && faixa.qtd_hora_extra_ate <= qtdTotalHoraExtra) {
							if(faixa.qtd_hora_extra_ate == null)
								$scope.colaborador.horasExtras[i].qtdHoraExtra += (qtdTotalHoraExtra - $scope.colaborador.horasExtras[i-1].qtd_hora_extra_ate);
							else{
								if(!$scope.colaborador.horasExtras[i-1])
									$scope.colaborador.horasExtras[i].qtdHoraExtra += (faixa.qtd_hora_extra_ate - faixa.qtd_hora_extra_de);
								else
									$scope.colaborador.horasExtras[i].qtdHoraExtra += faixa.qtd_hora_extra_de;
							}

							$scope.colaborador.horasExtras[i].qtd_hora_extra = formatHoraExtra($scope.colaborador.horasExtras[i].qtdHoraExtra);
						}
					})
				}
			}
		}

		// calcula as horas noturnas
		$.each($scope.arrDiasMes, function(i, item) {
			if(item.qtd_hora_adicional_noturno)
				$scope.colaborador.horasAdicionalNoturno += item.qtd_hora_adicional_noturno;
		});

		$scope.colaborador.qtd_horas_adicional_noturno = formatHoraExtra($scope.colaborador.horasAdicionalNoturno);
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
		var hor_entrada 			= moment(gradeHorarioDia.hor_entrada, "HH:mm:ss");
		var hor_entrada_intervalo 	= moment(gradeHorarioDia.hor_entrada_intervalo, "HH:mm:ss");
		var hor_retorno_intervalo 	= moment(gradeHorarioDia.hor_retorno_intervalo, "HH:mm:ss");
		var hor_saida 				= moment(gradeHorarioDia.hor_saida, "HH:mm:ss");

		// calcula o tempo de cada escala
		var diff_entrada_saida 		= hor_saida.diff(hor_entrada, "hours", true, true);
		var diff_intervalo 			= hor_retorno_intervalo.diff(hor_entrada_intervalo, "hours", true, true);

		// calcula o tempo real de trabalho diário
		var tmp_efetivo_diario 		= (diff_entrada_saida - diff_intervalo);

		return {
			qtd_horas_total_trabalho: diff_entrada_saida, 
			qtd_horas_efetivas_trabalho: tmp_efetivo_diario,
			qtd_tempo_intervalo: diff_intervalo
		};
	}

	function getEscalaHoraExtraSindicato() {
		$scope.colaborador.escalaHoraExtra = [];

		$http.get('http://localhost/sig-backoffice-api/sindicato/hora-extra/escala?cod_sindicato='+ $scope.colaborador.cod_sindicato)
			.success(function(data) {
				$scope.colaborador.escalaHoraExtra = data;
				if(data.length > 0) {
					$scope.colaborador.horasExtras = [$scope.colaborador.escalaHoraExtra[0]];
					
					$.each(data, function(i,item) {
						$.each($scope.colaborador.horasExtras, function(x, xitem) {
							$scope.colaborador.horasExtras[x].qtdHoraExtra = 0;

							if(xitem.num_percentual_hora_extra != item.num_percentual_hora_extra){
								item.qtdHoraExtra = 0;
								$scope.colaborador.horasExtras.push(item);
							}
						});
					});
				}
			});
	}

	function getFaixaHoraExtraSindicato() {
		$scope.colaborador.faixaHoraExtra = [];

		$http.get('http://192.168.0.12/sig-backoffice-api/sindicato/hora-extra/faixa?cod_sindicato='+ $scope.colaborador.cod_sindicato)
			.success(function(data) {
				if(data.length > 0) {
					$scope.colaborador.faixaHoraExtra = data;

					$scope.colaborador.horasExtras = [$scope.colaborador.faixaHoraExtra[0]];

					$.each(data, function(i,item) {
						$.each($scope.colaborador.horasExtras, function(x, xitem) {
							$scope.colaborador.horasExtras[x].qtdHoraExtra = 0;

							if(xitem.num_percentual_hora_extra != item.num_percentual_hora_extra) {
								item.qtdHoraExtra = 0;
								$scope.colaborador.horasExtras.push(item);
							}
						});
					});
				}
			});
	}

	function getProgramacaoGradeHorario() {
		$http.get('http://192.168.0.12/sig-backoffice-api/grade-horario/programacao?cod_grade_horario='+ $scope.colaborador.cod_grade_horario)
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
	getEscalaHoraExtraSindicato();
	getFaixaHoraExtraSindicato();
});