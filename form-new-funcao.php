<div class="panel" ng-controller="CadastroFuncaoCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">

			<div class="form-group">
				<label class="control-label col-lg-2">Nome</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" ng-model="funcao.nme_funcao">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Número</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="funcao.num_funcao">
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Função</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" ng-model="funcao.dsc_funcao">
					</div>
			</div>


		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>
</div>
