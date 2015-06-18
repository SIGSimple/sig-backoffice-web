<div class="panel" ng-controller="ListColaboradoresCtrl">
	<div class="panel-body">
		<div id="toolbar">
			<a href="?page=form-new-colaborador" class="btn btn-success btn-labeled fa fa-plus-square">
				Cadastrar Novo
			</a>
		</div>

		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://localhost/sig-backoffice-api/colaboradores.json"
			data-toolbar="#toolbar"
			data-search="true"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-page-list="[5, 10, 20, 50, 100]"
			data-page-size="10"
			data-pagination="true"
			data-side-pagination="server"
			data-show-pagination-switch="true"
			formatSearch="Filtrar">
			<thead>
				<tr>
					<th data-visible="true" data-sortable="true" data-field="num_matricula">Matricula</th>
					<th data-visible="true" data-sortable="true" data-field="nme_colaborador">Nome</th>
					<th data-visible="true" data-sortable="true" data-field="nme_fantasia">Contratante</th>
					<th data-visible="true" data-sortable="true" data-field="nme_departamento">Depto</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_origem">Origem</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_regime_contratacao">Contratação</th>
					<th data-visible="true" data-sortable="true" data-field="flg_cm">C/M</th>
					<th data-visible="false" data-sortable="true" data-field="nme_local_trabalho">Local de Trabalho</th>
					<th data-visible="false" data-sortable="true" data-field="nme_grade_horario">Horário</th>
					<th data-visible="true" data-sortable="true" data-field="dta_admissao">Dta. Admissão</th>
					<th data-visible="false" data-sortable="true" data-field="dta_demissao">Dta. Demissão</th>
					<th data-visible="false" data-sortable="true" data-field="num_ctps">CTPS</th>
					<th data-visible="false" data-sortable="true" data-field="num_serie_ctps">Serie CTPS</th>
					<th data-visible="false" data-sortable="true" data-field="sgl_estado">Estado</th>
					<th data-visible="false" data-sortable="true" data-field="dta_emissao_ctps">Emissão CTPS</th>
					<th data-visible="true" data-sortable="true" data-field="num_rg">RG</th>
					<th data-visible="true" data-sortable="true" data-field="num_cpf">CPF</th>	
					<th data-visible="true" data-sortable="true" data-field="num_pis">PIS</th>
					<th data-visible="false" data-sortable="true" data-field="num_titulo_eleitor">Título de eleitor</th>
					<th data-visible="false" data-sortable="true" data-field="num_zona_eleitoral">Zona eleitoral</th>
					<th data-visible="false" data-sortable="true" data-field="num_secao_eleitoral">Seção eleitoral</th>
					<th data-visible="false" data-sortable="true" data-field="num_reservista">Reservista</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_endereco">Endereço</th>
					<th data-visible="false" data-sortable="true" data-field="num_endereco">Número</th>
					<th data-visible="false" data-sortable="true" data-field="nme_bairro">Bairro</th>
					<th data-visible="false" data-sortable="true" data-field="dsc_complemento">Complemento</th>
					<th data-visible="false" data-sortable="true" data-field="nme_cidade">Cidade</th>
					<th data-visible="false" data-sortable="true" data-field="num_cep">CEP</th>
					<th data-visible="false" data-sortable="true" data-field="dta_nascimento">Nascimento</th>
					<th data-visible="false" data-sortable="true" data-field="num_cnh">CNH</th>
					<th data-visible="false" data-sortable="true" data-field="nme_categoria_cnh">Categoria</th>
					<th data-visible="false" data-sortable="true" data-field="dta_validade_cnh">Validade</th>
					<th data-visible="false" data-sortable="true" data-field="flg_sexo">M/F</th>
					<th data-visible="false" data-sortable="true" data-field="nme_banco">Banco</th>
					<th data-visible="false" data-sortable="true" data-field="num_agencia">Agência</th>
					<th data-visible="false" data-sortable="true" data-field="num_digito_agencia">Número</th>
					<th data-visible="false" data-sortable="true" data-field="num_conta_corrente">Conta corrente</th>
					<th data-visible="false" data-sortable="true" data-field="num_digito_conta_corrente">Número</th>
					<th data-visible="false" data-sortable="true" data-field="nme_entidade">Entidade</th>
					<th data-visible="false" data-sortable="true" data-field="num_entidade">Número</th>
					<th data-visible="true" data-sortable="true" data-field="flg_ativo" data-formatter="ativoFormatter">Ativo?</th>
				</tr>
			</thead>
		</table>
	</div>
</div>