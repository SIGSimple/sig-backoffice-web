<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListSindicatosCtrl">
	<div class="panel-body">
		<div id="toolbar">
			<a href="form-new-sindicatos" class="btn btn-success btn-labeled fa fa-plus-square">
				Cadastrar Novo
			</a>
		</div>
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/sindicatos.json"
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
					<th data-visible="true" data-sortable="true" data-field="nme_sindicato">Nome</th>
					<th data-visible="true" data-sortable="true" data-field="num_percentual_adicional_notuno">Adicional Noturno</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->