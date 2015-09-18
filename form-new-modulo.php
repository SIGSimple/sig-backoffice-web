<div class="panel" ng-controller="CadastroModuloCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-lg-2 control-label">Nome</label> 
				<div class="col-lg-3">
					<input type="text" class="form-control" ng-model="modulo.nme_modulo">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Título</label> 
				<div class="col-lg-3">
					<input type="text" class="form-control" ng-model="modulo.tit_modulo">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">URL</label> 
				<div class="col-lg-3">
					<input type="text" class="form-control" ng-model="modulo.url_modulo">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Classe Icone</label> 
				<div class="col-lg-2">
					<input type="text" class="form-control" ng-model="modulo.icn_modulo">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">PAI</label>
				<div class="col-lg-2">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ cadastroPai.modulo_perfil.cod_modulo_pai }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('modulos_perfil', 'modulo_perfil')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>

			<fieldset>
				<legend>Perfil</legend>

				<div class="form-group">
					<label class="col-lg-2 control-label"></label>
					<div class="col-lg-2">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<th>Nome</th>
								<th width="20">
									<button type="button" class="btn btn-xs btn-primary" ng-click="abreModalPerfil()">
										<i class="fa fa-plus-circle"></i>
									</button>
								</th>
							</thead>
							<tbody>
								<tr ng-repeat="perfil in modulo.modulos">
									<td>{{ modulo.cod_modulo }}</td>
									<td>{{ modulo.cod_perfil }}</td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>	
			</fieldset>
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

<div class="modal fade" id="modalAddPerfil" tabindex="-1" role="dialog" aria-labelledby="modalAddPerfilLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalAddPerfilLabel">Inclusão de Perfil</h4>
			</div>


				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-default btn-labeled fa fa-times-circle" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="addPerfil()">Salvar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>