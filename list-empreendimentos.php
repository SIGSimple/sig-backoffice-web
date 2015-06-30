<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListEmpreendimentosCtrl">
	<div class="panel-heading">
		<h3 class="panel-title">Listagem de Empreendimentos</h3>
	</div>
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/empreendimentos.json"
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
					<th data-visible="true" data-sortable="true" data-field="num_empreendimento">Número</th>
					<th data-visible="true" data-sortable="true" data-field="nme_empreendimento">Nome</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->