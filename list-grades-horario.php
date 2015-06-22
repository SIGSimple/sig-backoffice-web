<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListGradesHorarioCtrl">
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://localhost/sig-backoffice-api/grades-horario.json"
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
					<th data-visible="true" data-sortable="true" data-field="nme_grade_horario">Nome</th>
					<th data-visible="true" data-sortable="true" data-field="flg_ativo" data-formatter="ativoFormatter">Ativo?</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->