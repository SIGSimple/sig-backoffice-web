<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListPlanosdeSaudeCtrl">
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/planos-saude.json"
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
					<th data-visible="true" data-sortable="true" data-field="nme_plano_saude">Número</th>
					<th data-visible="true" data-sortable="true" data-field="vlr_custo_empresa">Valor empresa</th>
					<th data-visible="true" data-sortable="true" data-field="vlr_custo_colaborador">Valor colaborador</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->