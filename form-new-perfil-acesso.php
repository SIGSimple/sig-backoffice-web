<div class="panel" ng-controller="CadastroPerfilAcessoCtrl">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-7">
				<div class="panel panel-bordered-primary">
					<div class="panel-body" style="min-height: 388px; overflow-y: scroll;">
						<div class="form">
							<div class="form-group">
								<div class="col-xs-10">
									<label class="control-label">Descrição</label>
									<div class="controls">
										<input type="text" class="form-control" ng-model="perfil.nme_perfil">
									</div>
								</div>

								<div class="col-xs-2">
									<label class="control-label">Ativo?</label>
									<div class="controls">
										<input type="checkbox" class="input-switch" ng-model="perfil.flg_ativo">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-5">
				<div class="panel panel-bordered-dark">
					<div class="panel-heading">
						<h3 class="panel-title">Módulos</h3>
					</div>
					<div class="panel-body" style="min-height: 300px; max-height: 300px; overflow-y: scroll;">
						<div class="modulos-tree"></div>
					</div>
					<div class="panel-footer">
						Módulos selecionados: {{ perfil.modulos.length }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-footer clearfix">
		<div class="pull-right">
			<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="save()" data-loading-text="Aguarde...">Salvar</button>
		</div>
	</div>
</div>