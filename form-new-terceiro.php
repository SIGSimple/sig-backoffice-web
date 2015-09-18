<div class="panel" ng-controller="CadastroTerceiroCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-lg-2 control-label">Nome</label> 
				<div class="col-lg-6">
					<input type="text" class="form-control" ng-model="terceiro.nme_terceiro">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Nascimento</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="terceiro.dta_nascimento">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>

				<label class="col-lg-1 control-label">RG</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="terceiro.num_rg">
				</div>

				<label class="col-lg-1 control-label">CPF</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="terceiro.num_cpf">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">CNH</label>
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="terceiro.num_cnh">
				</div>

				<label class="col-lg-1 control-label">Validade</label> 
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="terceiro.dta_validade_cnh">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>	

				<label class="col-lg-1 control-label">Categoria</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="terceiro.nme_categoria_cnh">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Contrato</label>
				<div class="col-lg-2">
					<select class="form-control" ng-model="terceiro.cod_origem">
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Responsável</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ cadastroTerceiro.colaborador.nme_colaborador }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('colaboradores', 'colaborador')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
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