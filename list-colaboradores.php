<div class="panel" ng-controller="ListColaboradoresCtrl">
	<div class="panel-body">
		<div id="toolbar">
			<a href="form-new-colaborador" class="btn btn-success btn-labeled fa fa-plus-square">
				Cadastrar Novo
			</a>
		</div>
		<table class="bootstrap-table" 
			data-toggle="table"
			data-url="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sig-backoffice-api/colaboradores.json"
			data-toolbar="#toolbar"
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
					<th data-visible="true" data-align="center" data-formatter="editFormater"></th>
					<th data-visible="true" data-align="center" data-field="pth_arquivo_foto" data-formatter="fotoFormatter"></th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_matricula" data-field="num_matricula">Matricula</th>
					<th data-visible="true" data-sortable="true" data-sort-name="nme_colaborador" data-field="nme_colaborador">Nome</th>
					<th data-visible="true" data-sortable="true" data-sort-name="nme_funcao_medicao" data-field="nme_funcao_medicao">Função Medição</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_fantasia" data-field="nme_fantasia">Contratante</th>
					<th data-visible="true" data-sortable="true" data-sort-name="dsc_origem" data-field="dsc_origem">Origem</th>	
					<th data-visible="true" data-sortable="true" data-sort-name="vlr_slario_clt" data-field="vlr_slario_clt" data-formatter="currencyFormatter">Salário</th>						
					<th data-visible="true" data-sortable="true" data-sort-name="nme_departamento" data-field="nme_departamento">Depto</th>
					<th data-visible="false" data-sortable="true" data-sort-name="flg_cm" data-field="flg_cm">C/M</th>
					<th data-visible="true" data-sortable="true" data-sort-name="nme_local_trabalho" data-field="nme_local_trabalho">Local de Trabalho</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_grade_horario" data-field="nme_grade_horario">Horário</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dta_admissao" data-field="dta_admissao">Dta. Admissão</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dta_demissao" data-field="dta_demissao">Dta. Demissão</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_ctps" data-field="num_ctps">CTPS</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_serie_ctps" data-field="num_serie_ctps">Serie CTPS</th>
					<th data-visible="false" data-sortable="true" data-sort-name="sgl_estado_ctps" data-field="sgl_estado_ctps">Estado</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dta_emissao_ctps" data-field="dta_emissao_ctps">Emissão CTPS</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_rg" data-field="num_rg">RG</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_cpf" data-field="num_cpf">CPF</th>	
					<th data-visible="false" data-sortable="true" data-sort-name="num_pis" data-field="num_pis">PIS</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_titulo_eleitor" data-field="num_titulo_eleitor">Título de eleitor</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_zona_eleitoral" data-field="num_zona_eleitoral">Zona eleitoral</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_secao_eleitoral" data-field="num_secao_eleitoral">Seção eleitoral</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_reservista" data-field="num_reservista">Reservista</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dsc_endereco" data-field="dsc_endereco">Endereço</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_endereco" data-field="num_endereco">Número</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_bairro" data-field="nme_bairro">Bairro</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dsc_complemento" data-field="dsc_complemento">Complemento</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_cidade_moradia" data-field="nme_cidade_moradia">Cidade</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_cep" data-field="num_cep">CEP</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dta_nascimento" data-field="dta_nascimento">Nascimento</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_cnh" data-field="num_cnh">CNH</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_categoria_cnh" data-field="nme_categoria_cnh">Categoria</th>
					<th data-visible="false" data-sortable="true" data-sort-name="dta_validade_cnh" data-field="dta_validade_cnh">Validade</th>
					<th data-visible="false" data-sortable="true" data-sort-name="flg_sexo" data-field="flg_sexo">M/F</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_banco" data-field="nme_banco">Banco</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_agencia" data-field="num_agencia">Agência</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_digito_agencia" data-field="num_digito_agencia">Número</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_conta_corrente" data-field="num_conta_corrente">Conta corrente</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_digito_conta_corrente" data-field="num_digito_conta_corrente">Número</th>
					<th data-visible="false" data-sortable="true" data-sort-name="nme_entidade" data-field="nme_entidade">Entidade</th>
					<th data-visible="false" data-sortable="true" data-sort-name="num_entidade" data-field="num_entidade">Número</th>
					<th data-visible="true" data-sortable="true" data-sort-name="nme_funcao_clt" data-field="nme_funcao_clt">Função CLT</th>
					<th data-visible="true" data-sortable="true" data-sort-name="flg_ativo" data-field="flg_ativo" data-formatter="ativoFormatter">Ativo?</th>
				</tr>
			</thead>
		</table>
	</div>
</div>