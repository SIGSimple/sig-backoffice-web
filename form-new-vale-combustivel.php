<div class="panel" ng-controller="CadastroValeCombustivelCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="radio-inline"><input type="radio" ng-click="beneficiario = 'colaboradores'" ng-checked="(colaborador == 'colaboradores')">Colaborador</label>
				<label class="radio-inline"><input type="radio" ng-click="beneficiario = 'terceiros'" ng-checked="(terceiro == 'terceiros')">Terceiro</label>
				<div class="col-lg-2">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Nome</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ valeCombustivel.beneficiario.label }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal()">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Disponibilização</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="abastecimento.dta_disponibilizacao">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
				
				<label class="col-lg-1 control-label">Valor</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="abastecimento.vlr_disponibilizado">
				</div>
			</div>
			

			<div class="panel-footer clearfix">
				<div class="pull-right">
					<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
				</div>
			</div>
	</form>

	<div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="modalItemsLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalItemsLabel"></h4>
				</div>
				<div class="modal-body">
					<table id="mytable">
					</table>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>