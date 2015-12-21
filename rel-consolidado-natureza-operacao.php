<div class="panel" ng-controller="RelatorioConsolidadoNaturezaOperacaoCtrl">
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

		<div class="row loading-data hide">
			<div class="col-xs-12 text-center">
				<i class="fa fa-spin fa-spinner"></i> Aguarde, carregando informações...
			</div>
		</div>

		<div id="output"></div>
	</div>
</div>