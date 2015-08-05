<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListEntidadesCtrl">
	<div class="panel-body">
		<div id="toolbar">
			<a href="form-new-entidades" class="btn btn-success btn-labeled fa fa-plus-square">
				Cadastrar Novo
			</a>
		</div>
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/entidades.json"
			data-search="true"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-page-list="[5, 10, 20]"
			data-page-size="5"
			data-pagination="true"
			data-side-pagination="server"
			data-show-pagination-switch="true">
			<thead>
				<tr>
					<th data-visible="true" data-sortable="true" data-field="nme_entidade">Nome</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->