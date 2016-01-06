<div class="panel" ng-controller="RelatorioDistribuicaoDespesasConsorcioCtrl">
	<div class="panel-body">
		<div class="pad-btm">
			<div class="row">
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
					<label class="control-label">Período</label>
					<div class="controls">
						<div class="input-group date">
							<input type="text" class="form-control" ng-model="dta_selected">
							<span class="input-group-addon btn-default"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<label class="control-label sr-only"></label>
					<div class="controls only-buttons">
						<button type="button" class="btn btn-primary btn-labeled fa fa-cog" ng-click="loadItensConsolidados()">Gerar relatório</button>
						<button type="button" class="btn btn-default btn-labeled fa fa-file-excel-o" ng-click="export('excel');">Exportar p/ Excel</button>
					</div>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-hover table-striped">
				<thead>
					<th class="text-middle">Despesa</th>
					<th class="text-center text-middle" width="150">Total Despesas<br/>Consórcio</th>
					<th class="text-center text-middle" width="150">Parte<br/>Desassoreamento</th>
					<th class="text-center text-middle" width="150">Parte<br/>Intermúltiplas</th>
				</thead>
				<tbody>
					<tr ng-repeat="item in items">
						<td>{{ item.dsc_item }}</td>
						<td class="text-right">{{ item.vlr_consorcio | currency : 'R$ ' : 2 }}</td>
						<td class="text-right">{{ item.vlr_desassoreamento | currency : 'R$ ' : 2 }}</td>
						<td class="text-right">{{ item.vlr_intermultiplas | currency : 'R$ ' : 2 }}</td>
					</tr>
				</tbody>
				<tbody>
					<tr>
						<td class="text-right text-bold">Total</td>
						<td class="text-right text-bold">{{ vlr_total_consorcio | currency : 'R$ ' : 2  }}</td>
						<td class="text-right text-bold">{{ vlr_total_desassoreamento | currency : 'R$ ' : 2  }}</td>
						<td class="text-right text-bold">{{ vlr_total_intermultiplas | currency : 'R$ ' : 2  }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>