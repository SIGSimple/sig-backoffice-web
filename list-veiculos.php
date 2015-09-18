<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListVeiculosCtrl">
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/veiculos.json"
			data-search="true"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-page-list="[5, 10, 20, 50, 100]"
			data-page-size="10"
			data-pagination="true"
			data-side-pagination="server"
			data-show-pagination-switch="true">
			
		</table>
	</div>
</div>
<!--===================================================-->