<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListFuncoesCtrl">
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/funcoes.json"
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
					<th data-visible="true" data-sortable="true" data-field="num_funcao">Numero</th>
					<th data-visible="true" data-sortable="true" data-field="nme_funcao">Nome</th>
					<th data-visible="true" data-sortable="true" data-field="dsc_funcao">Função</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->