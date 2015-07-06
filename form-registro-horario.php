<div class="panel" ng-controller="RegistroHorarioCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<fieldset>
				<legend>Informações Gerais</legend>
				<div class="form-group">
					<label class="control-label col-lg-1">Matricula:</label>
					<div class="col-lg-2">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.cooperator.num_matricula }}">
					</div>

					<label class="control-label col-lg-1">Nome:</label>
					<div class="col-lg-6">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.cooperator.nme_colaborador | uppercase }}">
					</div>

					<label class="control-label col-lg-1">Hr./Mês:</label>
					<div class="col-lg-1">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.cooperator.qtd_horas_contratadas }}">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-1">Horário:</label>
					<div class="col-lg-7">
						<input type="text" class="form-control" disabled="disabled" value="{{ txtEscalaTrabalho | uppercase }}">
					</div>

					<label class="control-label col-lg-1">Intervalo:</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" disabled="disabled" value="{{ qtdTempoIntervalo | uppercase }}">
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Totalizações</legend>
				<form class="form form-horizontal">
					<div class="form-group">
						<label class="control-label col-lg-2">Adicional Noturno</label>
						<div class="col-lg-1">
							<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.cooperator.qtd_horas_adicional_noturno }}">
						</div>

						<div ng-repeat="item in colaborador.cooperator.horasExtras">
							<label class="control-label col-lg-2">Horas Extras ({{ item.num_percentual_hora_extra }}%)</label>
							<div class="col-lg-1">
								<input type="text" class="form-control" disabled="disabled" value="{{ item.qtd_hora_extra }}">
							</div>
						</div>
					</div>
				</form>
			</fieldset>

			<fieldset>
				<legend>Registro de Ponto <span class="pull-right">{{ mesVigente | uppercase }}</span></legend>
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead>
						<th class="text-center text-middle" width="50">Dia</th>
						<th class="text-center text-middle">Entrada</th>
						<th class="text-center text-middle">Saída p/ Intervalo</th>
						<th class="text-center text-middle">Retorno do Intervalo</th>
						<th class="text-center text-middle">Saída</th>
						<th class="text-center text-middle">Extras</th>
						<th class="text-center text-middle" width="200">Visto</th>
						<th class="text-center text-middle" width="200">Marcar como</th>
						<th class="text-center text-middle">Anexos</th>
					</thead>
					<tbody>
						<tr ng-repeat="(index, item) in arrDiasMes"
							class="{{ ((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.flgBridgeDay && colaborador.cooperator.flg_trabalho_feriado == 0)) ? 'danger' : '' }} {{ (getToday() == item.numDate) ? 'warning' : '' }}">
							<td class="text-center text-middle"><strong>{{ item.numDate }}</strong></td>
							<td class="text-center text-middle">
								<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
									ng-disabled="((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.flgBridgeDay && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.cod_registro_horario > 0 && colaborador.cooperator.flg_ajusta_folha_ponto == 0))"
									ng-model="item.hor_entrada">
							</td>
							<td class="text-center text-middle">
								<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
									ng-disabled="((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.flgBridgeDay && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.cod_registro_horario > 0 && colaborador.cooperator.flg_ajusta_folha_ponto == 0))"
									ng-model="item.hor_saida_intervalo">
							</td>
							<td class="text-center text-middle">
								<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
									ng-disabled="((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.flgBridgeDay && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.cod_registro_horario > 0 && colaborador.cooperator.flg_ajusta_folha_ponto == 0))"
									ng-model="item.hor_retorno_intervalo">
							</td>
							<td class="text-center text-middle">
								<input type="text" class="form-control input-sm text-center input-timepicker txt-hor-saida" value="00:00 AM"
									ng-disabled="((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.flgBridgeDay && colaborador.cooperator.flg_trabalho_feriado == 0) || (item.cod_registro_horario > 0 && colaborador.cooperator.flg_ajusta_folha_ponto == 0))"
									ng-model="item.hor_saida" ng-blur="validaHoraExtra(item, index)">
							</td>
							<td class="text-center text-middle">
								<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
									ng-disabled="{{ true }}" ng-model="item.hor_extra">
							</td>
							<td class="text-center text-middle">
								<strong ng-show="{{ item.flg_fim_semana }}">
									{{ item.nmeDate | uppercase }}
								</strong>
								<strong ng-show="{{ item.flg_feriado }}" tooltip="{{ item.nmeTipoHoliday | uppercase }}">
									{{ item.nmeHoliday | uppercase }}
								</strong>
								<strong ng-show="{{ item.flgBridgeDay }}">
									{{ item.nmeBridgeDay | uppercase }}
								</strong>
								<strong ng-show="{{ item.flg_compensacao }}">
									{{ item.nmeCompensation | uppercase }}
								</strong>
								<strong ng-show="{{ (getToday() == item.numDate) }}">{{ (getToday() == item.numDate) ? 'HOJE' : '' }}</strong>
							</td>
							<td class="text-center text-middle">
								<select class="form-control"
									ng-model="item.cod_tipo_registro_horario"
									ng-disabled="( item.cod_registro_horario > 0 && colaborador.cooperator.flg_ajusta_folha_ponto == 0 )"
									ng-hide="{{ ((item.flg_fim_semana && colaborador.cooperator.flg_trabalho_fim_semana == 0) || (item.flg_feriado && colaborador.cooperator.flg_trabalho_feriado == 0)) }}">
									<option
										ng-repeat="tipo in tiposRegistroHorario" 
										ng-selected="{{ item.cod_tipo_registro_horario == tipo.cod_tipo_registro_horario }}"
										value="{{ tipo.cod_tipo_registro_horario }}"
										label="{{ tipo.nme_tipo_registro_horario }}">
									</option>
								</select>
							</td>
							<td class="text-center text-middle" 
								flow-init="{target:'file-upload.php'}" 
								flow-files-submitted="$flow.upload()"
								flow-file-success="fileUploaded(item, $message)">
								<span class="pull-left btn btn-default btn-file"
									ng-show="(item.pth_anexo == '' && (item.cod_tipo_registro_horario == '3' || item.cod_tipo_registro_horario == '5'))">
									Selecionar... <input type="file" flow-btn>
								</span>
								<button type="button" class="btn btn-default"
									ng-show="(item.cod_registro_horario == 0 && item.pth_anexo.length > 0)"
									ng-click="clearAttachment(item)"
									tooltip="{{ item.nme_anexo }}" tooltip-placement="left">
									<i class="fa fa-times-circle"></i> Excluir anexo
								</button>
								<a class="btn btn-default" 
									href="file-download.php?file-type={{ item.dsc_tipo_anexo }}&file-name={{ item.nme_anexo }}&file-path={{ item.pth_anexo }}"
									ng-show="(item.cod_registro_horario > 0 && item.pth_anexo.length > 0)"
									tooltip="{{ item.nme_anexo }}" tooltip-placement="left">
									<i class="fa fa-download"></i> Baixar anexo
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</div>

		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>
</div>