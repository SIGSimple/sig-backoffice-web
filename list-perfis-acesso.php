<div class="panel" ng-controller="ListPerfisAcessoCtrl">
	<div class="panel-body">
		<div id="toolbar">
			<div class="form-inline" role="form">
				<div class="form-group">
					<a href="form-new-perfil-acesso" class="btn btn-success btn-labeled fa fa-plus-square">
						Cadastrar Novo
					</a>
				</div>
			</div>
		</div>

		<table class="bootstrap-table table-condensed table-striped" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/perfis.json"
			data-search="true"
			data-toolbar="#toolbar"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-page-list="[5, 10, 20, 50, 100]"
			data-page-size="10"
			data-pagination="true"
			data-side-pagination="server"
			data-show-pagination-switch="true">
			<thead>
				<tr>
					<th data-visible="true" data-align="center" data-formatter="editFormater" data-width="20">Ações</th>
					<th data-visible="true" data-sortable="true" data-field="nme_perfil">Descrição</th>
					<th data-visible="true" data-sortable="true" data-field="flg_ativo" data-formatter="ativoFormatter" data-width="80" data-align="center">Ativo?</th>
				</tr>
			</thead>
		</table>
	</div>
</div>