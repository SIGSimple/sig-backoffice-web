<div class="panel" ng-controller="RegistroHorarioCtrl">
	<div class="panel-body">
		<fieldset>
			<legend>Informações Gerais</legend>
			<form class="form form-horizontal">
				<div class="form-group">
					<label class="control-label col-lg-1">Matricula:</label>
					<div class="col-lg-2">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.num_matricula }}">
					</div>

					<label class="control-label col-lg-1">Nome:</label>
					<div class="col-lg-6">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.nme_colaborador | uppercase }}">
					</div>

					<label class="control-label col-lg-1">Hr./Mês:</label>
					<div class="col-lg-1">
						<input type="text" class="form-control" disabled="disabled" value="{{ colaborador.qtd_horas_contratadas }}">
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
			</form>
		</fieldset>

		<fieldset>
			<legend>Registro de Ponto <span class="pull-right">{{ mesVigente | uppercase }}</span></legend>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<th class="text-center" width="50">Dia</th>
					<th class="text-center">Entrada</th>
					<th class="text-center">Saída p/ Intervalo</th>
					<th class="text-center">Retorno do Intervalo</th>
					<th class="text-center">Saída</th>
					<th class="text-center">Extras</th>
					<th class="text-center" width="200">Visto</th>
				</thead>
				<tbody>
					<tr ng-repeat="(index, item) in arrDiasMes" 
						class="{{ (item.flgWeekend) ? 'danger' : '' }} {{ (getToday() == item.numDate) ? 'warning' : '' }}">
						<td class="text-center text-middle"><strong>{{ item.numDate }}</strong></td>
						<td>
							<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
								ng-disabled="{{ item.flgWeekend }}" ng-model="item.hor_entrada">
						</td>
						<td>
							<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
								ng-disabled="{{ item.flgWeekend }}" ng-model="item.hor_entrada_intervalo">
						</td>
						<td>
							<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
								ng-disabled="{{ item.flgWeekend }}" ng-model="item.hor_retorno_intervalo">
						</td>
						<td>
							<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
								ng-disabled="{{ item.flgWeekend }}" ng-model="item.hor_saida" ng-blur="validaHoraExtra(item)">
						</td>
						<td>
							<input type="text" class="form-control input-sm text-center input-timepicker" value="00:00 AM"
								ng-disabled="{{ true }}" ng-model="item.hor_extra">
						</td>
						<td class="text-center text-middle">
							<strong ng-show="{{ item.flgWeekend }}">{{ item.nmeDate | uppercase }}</strong>
							<strong ng-show="{{ (getToday() == item.numDate) }}">{{ (getToday() == item.numDate) ? 'HOJE' : '' }}</strong>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</div>

	<div class="panel-footer clearfix">
		<div class="pull-right">
			<button class="btn btn-primary btn-labeled fa fa-save">Salvar</button>
		</div>
	</div>
</div>