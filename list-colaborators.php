<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListColaboradoresCtrl">
	<div class="panel-heading">
		<h3 class="panel-title">Listagem de Colaboradores</h3>
	</div>
	<div class="panel-body">
		<button id="demo-delete-row" class="btn btn-danger btn-labeled fa fa-times" disabled="disabled">Excluir</button>
		
		<table id="demo-custom-toolbar" class="demo-add-niftycheck" 
			data-toggle="table"
			data-url="http://localhost/sig-backoffice-api/colaboradores.json"
			data-toolbar="#demo-delete-row"
			data-search="true"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-sort-name="id"
			data-page-list="[5, 10, 20]"
			data-page-size="5"
			data-pagination="true"
			data-show-pagination-switch="true">
			<thead>
				<tr>
					<th data-field="num_matricula">Matricula</th>
					<th data-field="nme_colaborador">Nome</th>
					<th data-field="nme_fantasia">Contratante</th>
					<th data-field="nme_departamento">Depto</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->