<div class="panel" ng-controller="CadastroLocalTrabalhoCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">

			<div class="form-group">
				<label class="control-label col-lg-2">Nome</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="localTrabalho.nme_local_trabalho">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Complemento</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" ng-model="localTrabalho.dsc_complemento">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Endereço</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="localTrabalho.nme_endereco">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Bairro</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" ng-model="localTrabalho.nme_bairro">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Complemento do Endereço</label>
					<div class="col-lg-3">
						<input type="text" class="form-control" ng-model="localTrabalho.nme_complemento_endereco">
					</div>
			</div>

		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>
</div>
