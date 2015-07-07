app.controller('RegistroHorarioCtrl', function($scope, $http, UserSrvc, $timeout, $window){
	$scope.txtEscalaTrabalho 		= "";
	$scope.mesVigente 				= moment().format("MMMM/2015");
	$scope.qtdTempoIntervalo 		= "";
	$scope.colaborador 				= UserSrvc.getUserLogged();
	$scope.colaborador.cooperator.gradeHorario = [];
	$scope.arrDiasMes 				= [];
	$scope.tiposRegistroHorario 	= [];
	$scope.feriados 				= [];
	$scope.diasPonte 				= [];
	$scope.programacaoCompensacoes 	= [];
	$scope.fechamentoMensal 		= { 
		cod_colaborador: $scope.colaborador.cooperator.cod_colaborador,
		dta_referencia: moment().format('YYYY-MM-DD'),
		qtd_dias_trabalhados: 0,
		qtd_adicional_noturno: 0,
		qtd_faltas_justificadas: 0,
		qtd_faltas_injustificadas: 0,
		qtd_atrasos_justificados: 0,
		qtd_atrasos_injustificados: 0,
		qtd_total_horas_extras: 0
	};

	$scope.getToday = function() {
		return moment().format('D');
	}

	$scope.fileUploaded = function(item, message) {
		var parsedObj = JSON.parse(message);

		item.nme_anexo 		= parsedObj.flowFileName;
		item.pth_anexo 		= parsedObj.flowFilePath;
		item.dsc_tipo_anexo = parsedObj.flowFileType;
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

		var qtdTempoIntervalo 	= getQtdHorasTrabalhoDiario(item).qtd_tempo_intervalo;
		var dtaEntrada 			= moment(item.cptDate + ' ' + item.hor_entrada, 'YYYY/M/D HH:mm');
		var dtaSaida 			= moment(item.cptDate + ' ' + item.hor_saida, 'YYYY/M/D HH:mm');
		var qtdTempoCompensacao = 0;

		if(item.flg_compensacao)
			qtdTempoCompensacao = item.qtd_tempo_compensacao;

		if(dtaEntrada.unix() != dtaSaida.unix()) {
			item.flg_registrado = true;

			item.cod_tipo_registro_horario = 1;
			if(parseInt(item.hor_saida.split(":")[0]) <= parseInt(item.hor_entrada.split(":")[0]))
				dtaSaida.add(1, 'd');

			var summaryOfDay = getHorasTrabalho(dtaEntrada, dtaSaida, (qtdHorasTrabalhoTotalProgramacao-qtdTempoIntervaloProgramacao), qtdTempoIntervalo, qtdTempoCompensacao);

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
			if(item.flgBridgeDay)
				item.cod_tipo_registro_horario = 2;

			item.hor_extra = formatHoraExtra(0);
			item.flg_hora_extra = false;
			item.flg_terminou_mesmo_dia = true;
			item.qtd_hora_adicional_noturno = 0;
			item.qtd_hora_extra_dia_fim = 0;
			item.qtd_hora_extra_dia_inicio = 0;
			item.qtd_horas_trabalhadas = 0;
			item.qtd_total_hora_extra = 0;
			item.flg_registrado = false;
		}

		calcTotaisHoraExtra();
	}

	$scope.clearAttachment = function(item) {
		$http.get(baseUrl()+'file-delete.php?file-path=' + item.pth_anexo)
			.success(function(message, status, headers, config) {
				item.nme_anexo 		= "";
				item.pth_anexo 		= "";
				item.dsc_tipo_anexo = "";
			})
			.error(function(message, status, headers, config) {
				showNotification(null, message, null, 'floating', status);
			});
	}

	$scope.saveRecords = function () {
		var alteracoes = false;
		var itemsToSave = [];
		var itemsToUpdate = [];
		var qtdDiasMes = $scope.arrDiasMes.length;
		var qtdItensRegistrados = 0;
		var countx = 0;
		var county = 0;

		$.each($scope.arrDiasMes, function(i, item) {
			if(item.flg_registrado)
				qtdItensRegistrados++;

			if(item.flg_registrado && item.cod_registro_horario === 0) {
				item.cod_colaborador = $scope.colaborador.cooperator.cod_colaborador;
				item.dta_registro = moment(item.cptDate, 'YYYY/M/D').format('YYYY-MM-DD');
				itemsToSave.push(item);
			}
			else if(item.cod_registro_horario !== 0 && $scope.colaborador.cooperator.flg_ajusta_folha_ponto === "1")
				itemsToUpdate.push(item);
		});

		if(itemsToSave.length > 0) {
			countx++;
			alteracoes = true;
			$http.post(baseUrlApi()+'colaborador/registro/horario/new', { records: itemsToSave })
				.success(function(message, status, headers, config){
					showNotification(null, message, null, 'page', status);
					county++;

					if(county == countx)
						$window.location.reload();
				})
				.error(function(message, status, headers, config){
					showNotification(null, message, null, 'page', status);
				});
		}

		if(itemsToUpdate.length > 0) {
			alteracoes = true;
			countx++;
			$http.post(baseUrlApi()+'colaborador/registro/horario/update', { records: itemsToUpdate })
				.success(function(message, status, headers, config){
					showNotification(null, message, null, 'page', status);
					county++;

					if(county == countx)
						$window.location.reload();
				})
				.error(function(message, status, headers, config){
					showNotification(null, message, null, 'page', status);
				});
		}

		if(!alteracoes)
			showNotification(null, 'Nenhuma alteração realizada!', null, 'floating', 406);

		if(qtdItensRegistrados === qtdDiasMes)
			calcFechamentoMensal();
	}

	function formatHoraExtra(qtdHoraExtra, isNegativeValue) {
		var value = "";

		if(qtdHoraExtra > 0 && qtdHoraExtra < 1)
			value = "0:" + adicionaZeros(parseFloat((qtdHoraExtra*60).toFixed(0)), "right");
		else if(qtdHoraExtra == 1)
			value = "1:00";
		else if(qtdHoraExtra < 0 || qtdHoraExtra > 1) {
			var hours = parseInt(qtdHoraExtra, 10);
			var minutes = adicionaZeros(parseInt(((qtdHoraExtra - hours) * 60).toFixed(0),10), "left");

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

	function getHorasTrabalho(vHoraInicio, vHoraFim, vJornadaContratual, vIntervalo, vCompensacao) {
		// declares
		var vHoraFimDiaInicio				= moment(vHoraInicio.format('YYYY-MM-DD') + ' 23:59:59', 'YYYY-MM-DD HH:mm');
		var vHoraInicioAdicionalNoturno 	= moment(vHoraInicio.format('YYYY-MM-DD') + ' 22:00:00', 'YYYY-MM-DD HH:mm');
		var vHoraInicioAuxiliar 			= moment(vHoraInicio.format('YYYY-MM-DD') + ' '+ vHoraInicio.format('HH:mm'), 'YYYY-MM-DD HH:mm');
		var vHoraFimAdicionalNoturno 		= moment(vHoraInicioAuxiliar.add(1, 'd').format('YYYY-MM-DD') + ' 05:00:00', 'YYYY-MM-DD HH:mm');
		var vDiffHoras 						= 0;
		var vDataAuxiliar					= moment();
		var vHoraTotalExtra 				= 0;
		var vHoraExtraDiaInicio 			= 0;
		var vHoraExtraDiaFim	 			= 0;
		var vAdicionalNoturno 				= 0;
		var vMesmoDia 						= (vHoraInicio.format('YYYY-MM-DD') == vHoraFim.format('YYYY-MM-DD'));

		var dadosDiaInicio = $scope.arrDiasMes[getIndexDiaMes('numDate', parseInt(vHoraInicio.format("D"),10))];

		vDiffHoras = vHoraFim.diff(vHoraInicio, 'hours', true) - vIntervalo;

		if(dadosDiaInicio.flg_feriado){
			vHoraTotalExtra = vDiffHoras;
			vJornadaContratual = 0;
		}
		else
			vHoraTotalExtra = (vDiffHoras - vJornadaContratual - vCompensacao);

		if(vHoraExtraDiaInicio == 0 && !vMesmoDia){
			vHoraExtraDiaInicio 	= parseFloat((vHoraFimDiaInicio.diff(vHoraInicio, 'hours', true) - vJornadaContratual).toFixed(2));
			if(vHoraExtraDiaInicio > 0)
				vHoraExtraDiaFim = parseFloat((vHoraTotalExtra - vHoraExtraDiaInicio).toFixed(2));
			else
				vHoraExtraDiaFim = vHoraTotalExtra;
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

		if(vHoraExtraDiaInicio < 0)
			vHoraExtraDiaInicio = 0;

		if(vAdicionalNoturno > 0 && vAdicionalNoturno < 1)
			vAdicionalNoturno = 1;
		else if(vAdicionalNoturno > 1)
			vAdicionalNoturno = parseFloat(((vAdicionalNoturno / 52.5) * 60).toFixed(2))

		return {
			qtd_horas_negativas: parseFloat((vDiffHoras - (vJornadaContratual + vCompensacao)).toFixed(2)),
			qtd_horas_trabalhadas: vDiffHoras,
			flg_terminou_mesmo_dia: vMesmoDia,
			flg_hora_extra: (vHoraTotalExtra > 0),
			qtd_total_hora_extra: vHoraTotalExtra, 
			qtd_hora_extra_dia_inicio: vHoraExtraDiaInicio,
			qtd_hora_extra_dia_fim: vHoraExtraDiaFim,
			qtd_hora_adicional_noturno: vAdicionalNoturno
		};
	}

	function getProgramacaoTrabalhoDia(diaSemana) {
		var programacaoTrabalhoDia;
		
		$.each($scope.colaborador.cooperator.gradeHorario, function(i, item) {
			if(diaSemana.toUpperCase() == item.nme_completo_dia_semana)
				programacaoTrabalhoDia = item;
		});

		return programacaoTrabalhoDia;
	}

	function getIndexHoraExtra(field, value) {
		var index;
		
		$.each($scope.colaborador.cooperator.horasExtras, function(i, item) {
			if(value == item[field])
				index = i;
		});

		return index;
	}

	function getIndexDiaMes(field, value) {
		var index;
		
		$.each($scope.arrDiasMes, function(i, item) {
			if(value == item[field])
				index = i;
		});

		return index;
	}

	function getIndexInArray(array, field, value) {
		var index;
		
		$.each(array, function(i, item) {
			if(value == item[field])
				index = i;
		});

		return index;
	}

	function calcTotaisHoraExtra() {
		// limpa os valores para a recontagem
		$.each($scope.colaborador.cooperator.horasExtras, function(i, item) {
			$scope.colaborador.cooperator.horasExtras[i].qtdHoraExtra = 0;
			$scope.colaborador.cooperator.horasExtras[i].qtd_hora_extra = formatHoraExtra(0);
			$scope.colaborador.cooperator.horasAdicionalNoturno = 0;
			$scope.colaborador.cooperator.qtd_horas_adicional_noturno = formatHoraExtra(0);
		});

		// calcula as horas extras
		// valida se as horas extras são por escala de dia da semana
		if($scope.colaborador.cooperator.escalaHoraExtra.length > 0) {
			$.each($scope.arrDiasMes, function(i, item) {
				$.each($scope.colaborador.cooperator.escalaHoraExtra, function(x, xitem) {
					if(item.nmeDate.toUpperCase() == xitem.nme_completo_dia_semana) {
						if(item.qtd_total_hora_extra) {
							var idxHE = 0;

							if(item.flg_feriado)
								idxHE = getIndexHoraExtra('num_percentual_hora_extra', 100);
							else
								idxHE = getIndexHoraExtra('num_percentual_hora_extra', xitem.num_percentual_hora_extra);

							if(!item.flg_terminou_mesmo_dia) {
								if(item.qtd_hora_extra_dia_inicio > 0) {
									$scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra += item.qtd_hora_extra_dia_inicio;
									$scope.colaborador.cooperator.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra);

									if($scope.colaborador.cooperator.horasExtras[idxHE+1]) {
										$scope.colaborador.cooperator.horasExtras[idxHE+1].qtdHoraExtra += item.qtd_hora_extra_dia_fim;
										$scope.colaborador.cooperator.horasExtras[idxHE+1].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[idxHE+1].qtdHoraExtra);
									}
									else {
										idxHE = 0;
										$scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra += item.qtd_hora_extra_dia_fim;
										$scope.colaborador.cooperator.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra);
									}
								}
								else {
									$scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra += item.qtd_hora_extra_dia_fim;
									$scope.colaborador.cooperator.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra);
								}
							}
							else {
								$scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra += item.qtd_total_hora_extra;
								$scope.colaborador.cooperator.horasExtras[idxHE].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[idxHE].qtdHoraExtra);
							}
						}
					}
				});
			});
		}
		// valida se as horas extras são por faixa de horário
		else if($scope.colaborador.cooperator.faixaHoraExtra.length > 0) {
			var qtdTotalHoraExtra = 0;

			$.each($scope.arrDiasMes, function(i, item) {
				if(item.qtd_total_hora_extra)
					qtdTotalHoraExtra += item.qtd_total_hora_extra;
			});

			if(qtdTotalHoraExtra > 0) {
				if(qtdTotalHoraExtra == 1) {
					$scope.colaborador.cooperator.horasExtras[0].qtdHoraExtra += qtdTotalHoraExtra;
					$scope.colaborador.cooperator.horasExtras[0].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[0].qtdHoraExtra);
				} else {
					$.each($scope.colaborador.cooperator.horasExtras, function(i, faixa){
						if(qtdTotalHoraExtra >= faixa.qtd_hora_extra_de && faixa.qtd_hora_extra_ate <= qtdTotalHoraExtra) {
							if(faixa.qtd_hora_extra_ate == null)
								$scope.colaborador.cooperator.horasExtras[i].qtdHoraExtra += (qtdTotalHoraExtra - $scope.colaborador.cooperator.horasExtras[i-1].qtd_hora_extra_ate);
							else{
								if(!$scope.colaborador.cooperator.horasExtras[i-1])
									$scope.colaborador.cooperator.horasExtras[i].qtdHoraExtra += (faixa.qtd_hora_extra_ate - faixa.qtd_hora_extra_de);
								else
									$scope.colaborador.cooperator.horasExtras[i].qtdHoraExtra += faixa.qtd_hora_extra_de;
							}

							$scope.colaborador.cooperator.horasExtras[i].qtd_hora_extra = formatHoraExtra($scope.colaborador.cooperator.horasExtras[i].qtdHoraExtra);
						}
					})
				}
			}
		}

		// calcula as horas noturnas
		$.each($scope.arrDiasMes, function(i, item) {
			if(item.qtd_hora_adicional_noturno)
				$scope.colaborador.cooperator.horasAdicionalNoturno += item.qtd_hora_adicional_noturno;
		});

		$scope.colaborador.cooperator.qtd_horas_adicional_noturno = formatHoraExtra($scope.colaborador.cooperator.horasAdicionalNoturno);
	}

	function calcFechamentoMensal() {
		$.each($scope.arrDiasMes, function(i, item) {
			// Se tiver hora extra, totaliza
			if(item.qtd_total_hora_extra)
				$scope.fechamentoMensal.qtd_total_horas_extras += item.qtd_total_hora_extra;

			// Se tiver adicional noturno, totaliza
			if(item.qtd_hora_adicional_noturno)
				$scope.fechamentoMensal.qtd_adicional_noturno += $scope.colaborador.cooperator.horasAdicionalNoturno;

			// Se tiver falta justificada, totaliza
			if(parseInt(item.cod_tipo_registro_horario, 10) === 3)
				$scope.fechamentoMensal.qtd_faltas_justificadas++;

			// Se tiver falta injustificada, totaliza
			if(parseInt(item.cod_tipo_registro_horario, 10) === 4)
				$scope.fechamentoMensal.qtd_faltas_injustificadas++;

			// Se houver atrasos justificados, totaliza
			if(item.qtd_horas_negativas > 0 && parseInt(item.cod_tipo_registro_horario,10) === 5)
				$scope.fechamentoMensal.qtd_atrasos_justificados += item.qtd_horas_negativas;

			// Se houver atrasos justificados, totaliza
			if(item.qtd_horas_negativas > 0 && parseInt(item.cod_tipo_registro_horario,10) !== 5)
				$scope.fechamentoMensal.qtd_atrasos_injustificados += item.qtd_horas_negativas;
		});
	}

	function calcEscalaTrabalhoColaborador() {
		var primeiroDiaSemana 	= $scope.colaborador.cooperator.gradeHorario[0];
		var penultimoDiaSemana 	= $scope.colaborador.cooperator.gradeHorario[($scope.colaborador.cooperator.gradeHorario.length - 2)];
		var ultimoDiaSemana 	= $scope.colaborador.cooperator.gradeHorario[($scope.colaborador.cooperator.gradeHorario.length - 1)];

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
		var hor_saida_intervalo 	= moment((gradeHorarioDia.hor_entrada_intervalo != null) ? gradeHorarioDia.hor_entrada_intervalo : gradeHorarioDia.hor_saida_intervalo, "HH:mm:ss");
		var hor_retorno_intervalo 	= moment(gradeHorarioDia.hor_retorno_intervalo, "HH:mm:ss");
		var hor_saida 				= moment(gradeHorarioDia.hor_saida, "HH:mm:ss");

		// calcula o tempo de cada escala
		var diff_entrada_saida 		= hor_saida.diff(hor_entrada, "hours", true, true);
		var diff_intervalo 			= hor_retorno_intervalo.diff(hor_saida_intervalo, "hours", true, true);

		// calcula o tempo real de trabalho diário
		var tmp_efetivo_diario 		= (diff_entrada_saida - diff_intervalo);

		return {
			qtd_horas_total_trabalho: diff_entrada_saida, 
			qtd_horas_efetivas_trabalho: tmp_efetivo_diario,
			qtd_tempo_intervalo: diff_intervalo
		};
	}

	function getEscalaHoraExtraSindicato() {
		$scope.colaborador.cooperator.escalaHoraExtra = [];

		$http.get(baseUrlApi()+'sindicato/hora-extra/escala?cod_sindicato='+ $scope.colaborador.cooperator.cod_sindicato)
			.success(function(data) {
				$scope.colaborador.cooperator.escalaHoraExtra = data;
				if(data.length > 0) {
					$scope.colaborador.cooperator.horasExtras = [$scope.colaborador.cooperator.escalaHoraExtra[0]];
					
					$.each(data, function(i,item) {
						$.each($scope.colaborador.cooperator.horasExtras, function(x, xitem) {
							$scope.colaborador.cooperator.horasExtras[x].qtdHoraExtra = 0;

							if(xitem.num_percentual_hora_extra != item.num_percentual_hora_extra){
								item.qtdHoraExtra = 0;
								$scope.colaborador.cooperator.horasExtras.push(item);
							}
						});
					});
				}
			});
	}

	function getFaixaHoraExtraSindicato() {
		$scope.colaborador.cooperator.faixaHoraExtra = [];

		$http.get(baseUrlApi()+'sindicato/hora-extra/faixa?cod_sindicato='+ $scope.colaborador.cooperator.cod_sindicato)
			.success(function(data) {
				if(data.length > 0) {
					$scope.colaborador.cooperator.faixaHoraExtra = data;

					$scope.colaborador.cooperator.horasExtras = [$scope.colaborador.cooperator.faixaHoraExtra[0]];

					$.each(data, function(i,item) {
						$.each($scope.colaborador.cooperator.horasExtras, function(x, xitem) {
							$scope.colaborador.cooperator.horasExtras[x].qtdHoraExtra = 0;

							if(xitem.num_percentual_hora_extra != item.num_percentual_hora_extra) {
								item.qtdHoraExtra = 0;
								$scope.colaborador.cooperator.horasExtras.push(item);
							}
						});
					});
				}
			});
	}

	function getProgramacaoGradeHorario() {
		$http.get(baseUrlApi()+'grade-horario/programacao?cod_grade_horario='+ $scope.colaborador.cooperator.cod_grade_horario)
			.success(function(data) {
				if(data.rows.length > 0) {
					$scope.colaborador.cooperator.gradeHorario = data.rows;

					var qtdTempoIntervalo = getQtdHorasTrabalhoDiario($scope.colaborador.cooperator.gradeHorario[0]).qtd_tempo_intervalo;
						qtdTempoIntervalo = (qtdTempoIntervalo < 1) ? (qtdTempoIntervalo * 60) + " minuto(s) p/ intervalo" : qtdTempoIntervalo + " hora(s) p/ intervalo";

					$scope.qtdTempoIntervalo = qtdTempoIntervalo;

					calcEscalaTrabalhoColaborador();
				}
			});
	}
	
	function getDadosLocalTrabalhoColaborador() {
		$http.get(baseUrlApi()+'locais-trabalho?tlt->cod_local_trabalho=' + $scope.colaborador.cooperator.cod_local_trabalho)
			.success(function(data){
				if(data.total > 0) {
					$scope.colaborador.cooperator.localTrabalho = data.rows[0];
					getFeriadosMes();
				}
			});
	}

	function getFeriadosMes() {
		var numMes = parseInt(moment().format('M'),10);
		var codEstado = $scope.colaborador.cooperator.localTrabalho.cod_estado;
		var codCidade = $scope.colaborador.cooperator.localTrabalho.cod_cidade;

		$http.get(baseUrlApi()+'feriados/'+ numMes +'/'+ codEstado +'/'+ codCidade)
			.success(function(items){
				$scope.feriados = items;
				getDiasPonte();
			})
			.error(function(data, status, headers, config){
				if(status === 404) {
					getDiasPonte();
				}
			});
	}

	function loadDayFields() {
		$scope.arrDiasMes = getDaysArray(parseInt(moment().format('YYYY'), 10), parseInt(moment().format('M'),10), $scope.feriados, $scope.diasPonte, $scope.programacaoCompensacoes);

		getRegistrosHorarioColaborador();

		$timeout(function() {
			if($('.input-timepicker').length > 0) {
				initializeTimepickerInputs();
			}
		}, 0);
	}

	function getTiposRegistroHorario() {
		$http.get(baseUrlApi()+'tipos/registro/horario')
			.success(function(items) {
				$scope.tiposRegistroHorario = items;
			});
	}

	function getDiasPonte() {
		$http.get(baseUrlApi()+'dia-ponte/programacao?col->cod_colaborador=' + $scope.colaborador.cooperator.cod_colaborador +"&dta_dia_ponte[exp]=BETWEEN '"+ moment().startOf('month').format('YYYY-MM-DD') +"' and '"+ moment().endOf('month').format('YYYY-MM-DD') +"'")
			.success(function(items) {
				$scope.diasPonte = items;
				getProgramacaoCompensacoes();
			})
			.error(function(data, status, headers, config){
				if(status === 404) {
					getProgramacaoCompensacoes();
				}
			});
	}

	function getProgramacaoCompensacoes() {
		$http.get(baseUrlApi()+'dia-ponte/programacao?col->cod_colaborador=' + $scope.colaborador.cooperator.cod_colaborador +"&'"+ moment().format('MM') +"'[exp]=BETWEEN DATE_FORMAT(pdp.dta_inicio_compensacao, '%m') AND DATE_FORMAT(pdp.dta_termino_compensacao, '%m')")
			.success(function(items) {
				$scope.programacaoCompensacoes = items;
				loadDayFields();
			})
			.error(function(data, status, headers, config){
				if(status === 404) {
					loadDayFields();
				}
			});
	}

	function getRegistrosHorarioColaborador() {
		$http.get(baseUrlApi()+'colaborador/registros/horario?cod_colaborador=' + $scope.colaborador.cooperator.cod_colaborador)
			.success(function(items) {
				$.each($scope.arrDiasMes, function(idxDiaMes, diaMes) {
					var idxItem = getIndexInArray(items, 'dta_registro', moment(diaMes.cptDate + ' 00:00:00', 'YYYY/M/D HH:mm:ss').format("YYYY-MM-DD HH:mm:ss"));

					if(idxItem != null && idxItem != -1) {
						$scope.arrDiasMes[idxDiaMes]['flg_registrado'] = true;
						var recordOfDiaMes = items[idxItem];

						$.each(diaMes, function(fieldOfDiaMes, valueOfDiaMes) {
							$.each(recordOfDiaMes, function(fieldOfRecord, valueOfRecord) {
								if(fieldOfDiaMes === fieldOfRecord){
									$scope.arrDiasMes[idxDiaMes][fieldOfDiaMes] = valueOfRecord;
								}
							});
						});
					}
				});

				calcTotaisHoraExtra();
			});
	}

	function getDaysArray(year, month, feriados, diasPonte, compensacoes) {
		var numDaysInMonth, daysInWeek, daysIndex, index, i, l, daysArray;

		numDaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		daysInWeek = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
		daysIndex = { 'Sun': 0, 'Mon': 1, 'Tue': 2, 'Wed': 3, 'Thu': 4, 'Fri': 5, 'Sat': 6 };
		index = daysIndex[(new Date(year, month - 1, 1)).toString().split(' ')[0]];
		daysArray = [];

		for (i = 0, l = numDaysInMonth[month - 1]; i < l; i++) {
			idx = index++;

			var objDay = {
				cod_registro_horario: 0,
				hor_entrada: "0:00",
				hor_saida_intervalo: "0:00",
				hor_retorno_intervalo: "0:00",
				hor_saida: "0:00",
				hor_extra: "0:00",
				numDate: (i + 1),
				nmeDate: daysInWeek[idx],
				cptDate: year + '/' + month + '/' + (i + 1),
				flg_fim_semana: (daysInWeek[idx] == 'Sábado' || daysInWeek[idx] == 'Domingo'),
				flg_feriado: false,
				flg_registrado: false,
				flg_compensacao: false,
				qtd_tempo_compensacao: 0,
				qtd_hora_adicional_noturno: 0,
				qtd_hora_extra_dia_inicio: 0,
				qtd_hora_extra_dia_fim: 0,
				qtd_horas_trabalhadas: 0,
				qtd_total_hora_extra: 0,
				qtd_horas_negativas: 0,
				flg_hora_extra: false,
				flg_terminou_mesmo_dia: false,
				nme_anexo: "",
				pth_anexo: "",
				dsc_tipo_anexo: ""
			};

			if(feriados.length > 0) {
				$.each(feriados, function(y, feriado) {
					if(parseInt(feriado.num_dia_feriado, 10) === objDay.numDate) {
						objDay.flg_feriado = true;
						objDay.nmeHoliday = feriado.nme_feriado;
						objDay.nmeTipoHoliday = feriado.nme_tipo_feriado;
						objDay.cod_tipo_registro_horario = 2;
					}
					else
						objDay.cod_tipo_registro_horario = 1;
				});
			}
			else
				objDay.cod_tipo_registro_horario = 1;

			if(diasPonte.length > 0) {
				$.each(diasPonte, function(z, diaPonte) {
					if(parseInt(moment(diaPonte.dta_dia_ponte, 'YYYY-MM-DD').format("D"),10) === objDay.numDate) {
						objDay.flgBridgeDay = true;
						objDay.nmeBridgeDay = "DIA PONTE";
						objDay.cod_tipo_registro_horario = 2;
					}
				});
			}

			daysArray.push(objDay);

			if (index == 7) index = 0;
		}

		if(compensacoes.length > 0) {
			$.each(compensacoes, function(z, compensacao) {
				var valIni = parseInt(moment(compensacao.dta_inicio_compensacao, 'YYYY-MM-DD').format("D"),10)-1;
				var valFim = parseInt(moment(compensacao.dta_termino_compensacao, 'YYYY-MM-DD').format("D"),10)-1;

				for(var i = valIni; i <= valFim; i++) {
					var objDay = daysArray[i];

					if(!objDay.flg_fim_semana && !objDay.flg_feriado && !objDay.flgBridgeDay) {
						objDay.flg_compensacao 		= true;
						objDay.nmeCompensation 		= "COMPENSAÇÃO ("+ compensacao.qtd_horas_dia_compensacao +" h)";
						objDay.qtd_tempo_compensacao = parseInt(compensacao.qtd_horas_dia_compensacao, 10);
					}

					daysArray[i] = objDay;
				}
			});
		}

		return daysArray;
	}

	getProgramacaoGradeHorario();
	getEscalaHoraExtraSindicato();
	getFaixaHoraExtraSindicato();
	getDadosLocalTrabalhoColaborador();
	getTiposRegistroHorario();
});