<!--Custom Toolbar-->
<!--===================================================-->
<div class="panel" ng-controller="ListEmpresasCtrl">
	<div class="panel-body">
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://192.168.0.12/sig-backoffice-api/empresas.json"
			data-search="true"
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
					<th data-visible="true" data-sortable="true" data-field="num_cnpj">CNPJ</th>
					<th data-visible="true" data-sortable="true" data-field="nme_razao_social">Razão Social</th>
					<th data-visible="true" data-sortable="true" data-field="nme_fantasia">Nome Fantasia</th>
					<th data-visible="false" data-sortable="true" data-field="num_inscricao_estadual">I.E.</th>
					<th data-visible="true" data-sortable="true" data-field="dsc_endereco">Endereço</th>
					<th data-visible="false" data-sortable="true" data-field="nme_bairro">Bairro</th>
					<th data-visible="false" data-sortable="true" data-field="num_cep">CEP</th>
					<th data-visible="true" data-sortable="true" data-field="nme_cidade">Cidade</th>
					<th data-visible="true" data-sortable="true" data-field="sgl_estado">UF</th>
					<th data-visible="true" data-sortable="true" data-field="flg_ativo" data-formatter="ativoFormatter">Ativo?</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<!--===================================================-->