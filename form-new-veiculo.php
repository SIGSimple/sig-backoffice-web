<div class="panel" ng-controller="CadastroVeiculoCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-lg-2 control-label">Placa</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="veiculo.num_placa">
				</div>
				<label class="col-lg-2 control-label">Número do Renavam</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="veiculo.num_renavam">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Locadora</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ cadastroVeiculo.empresa.nme_fantasia }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('empresas', 'empresa')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Montadora</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ cadastroVeiculo.montadora_veiculo.nme_fantasia }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('montadoras-veiculo', 'montadora-veiculo')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>
						

			<div class="form-group">
				<label class="col-lg-2 control-label">Modelo</label> 
				<div class="col-lg-4">
					<input type="text" class="form-control" ng-model="veiculo.nme_modelo">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Ano/Modelo</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="veiculo.ano_modelo">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
				
				<label class="col-lg-1 control-label">Ano/Fabricação</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="veiculo.ano_fabricacao">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Cor</label>
				<div class="col-lg-2">
					<select class="form-control" ng-model="veiculo.cod_cor">
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="checkbox">
  					<label class="col-lg-2 control-label">
  						<input type="checkbox" value="">Seguro Incluso</label>
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