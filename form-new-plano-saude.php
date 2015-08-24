<div class="panel" ng-controller="CadastroPlanoSaudeCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			
			<div class="form-group">
				<label class="control-label col-lg-2">Empresa</label>
					<div class="col-lg-4">
						<div class="input-group">
							<input type="text" class="form-control" readonly="readonly" value="{{ planoSaude.empresa.nme_fantasia }}">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" ng-click="abreModal('empresas', 'empresa')">
										<i class="fa fa-search"></i>
									</button>
								</span>								
						</div>
					</div>
			</div>

						
			<div class="form-group">
				<label class="control-label col-lg-2">Descrição</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="planoSaude.nme_plano_saude">
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-lg-2">Valor empresa</label>
					<div class="col-lg-1">
						<input type="text" class="form-control" ng-model="planoSaude.vlr_custo_empresa">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Valor colaborador</label>
					<div class="col-lg-1">
						<input type="text" class="form-control" ng-model="planoSaude.vlr_custo_colaborador">
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-lg-2">Valor dependente</label>
					<div class="col-lg-1">
						<input type="text" class="form-control" ng-model="planoSaude.vlr_custo_dependente">
					</div>
			</div>
					

		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>

</div>

<div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="modalItemsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalItemsLabel"></h4>
			</div>
			<div class="modal-body">
				<table id="mytable"></table>
			</div>
			<div class="modal-footer clearfix">
				<div class="pull-right">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>