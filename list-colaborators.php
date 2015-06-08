<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Listagem de Colaboradores</h3>
	</div>
	<div class="panel-body">
		<button id="demo-delete-row" class="btn btn-danger btn-labeled fa fa-times" disabled="disabled">Excluir</button>
		
		<table id="demo-custom-toolbar" class="demo-add-niftycheck" 
			data-toggle="table"
			data-url="data/bs-table.json"
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
					<th data-field="state" 	data-checkbox="true">ID</th>
					<th data-field="id" 	data-sortable="true" data-formatter="invoiceFormatter">ID</th>
					<th data-field="name" 	data-sortable="true">Name</th>
					<th data-field="date" 	data-sortable="true" data-formatter="dateFormatter">Order date</th>
					<th data-field="amount" data-sortable="true" data-sorter="priceSorter" 			data-align="center">Balance</th>
					<th data-field="status" data-sortable="true" data-formatter="statusFormatter" 	data-align="center">Status</th>
					<th data-field="track" 	data-sortable="true" data-formatter="trackFormatter" 	data-align="center">Tracking Number</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->