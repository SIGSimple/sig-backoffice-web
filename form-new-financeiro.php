<div class="panel" ng-controller="CadastroFinanceiroCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-lg-2 control-label">Número da Nota/Fatura</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="financeiro.num_nota_fatura">
				</div>

				<label class="col-lg-2 control-label">Número do Banco</label> 
				<div class="col-lg-1">
					<input type="text" class="form-control" ng-model="financeiro.num_documento_banco">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Emissão</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="financeiro.dta_emissao">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>

				<label class="col-lg-2 control-label">Data de Competência</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="financeiro.dta_competencia">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
			</div>
				
			<div class="form-group">
				<label class="col-lg-2 control-label">Data de Vencimento</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="financeiro.dta_vencimento">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
			
				<label class="col-lg-2 control-label">Data de Pagamento</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input type="text" class="form-control" ng-model="financeiro.dta_pagamento">
						<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
					</div>
				</div>
			</div>
		
			<div class="form-group">
				<label class="col-lg-2 control-label">Natureza</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ cadastroNatureza.financeiro.cod_natureza_operacao }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('financeiros', 'financeiro')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Conta Contábil</label>
				<div class="col-lg-2">
					<select class="form-control" ng-model="financeiro.cod_conta_contabil">
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="radio-inline"><input type="radio" ng-click="favorecido = 'empresas'" ng-checked="(favorecido == 'empresas')">Empresa</label>
				<label class="radio-inline"><input type="radio" ng-click="favorecido = 'colaboradores'" ng-checked="(favorecido == 'colaboradores')">Colaborador</label>
				<label class="radio-inline"><input type="radio" ng-click="favorecido = 'terceiros'" ng-checked="(favorecido == 'terceiros')">Terceiros</label>
				<div class="col-lg-2">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Favorecido</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.favorecido.label }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('FAVORECIDO')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="radio-inline"><input type="radio" ng-click="titularMovimento = 'empresas'" ng-checked="(titularMovimento == 'empresas')">Empresa</label>
				<label class="radio-inline"><input type="radio" ng-click="titularMovimento = 'colaboradores'" ng-checked="(titularMovimento == 'colaboradores')">Colaborador</label>
				<label class="radio-inline"><input type="radio" ng-click="titularMovimento = 'terceiros'" ng-checked="(titularMovimento == 'terceiros')">Terceiros</label>
				<div class="col-lg-2">
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Titular do Movimento</label>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.titularMovimento.label }}">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" ng-click="abreModal('TITULAR_MOVIMENTO')">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-2 control-label">Origem Despesa</label>
				<div class="col-lg-2">
					<select class="form-control" ng-model="financeiro.cod_origem_despesa">
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-2 control-label">Valor Previsto</label> 
				<div class="col-lg-2">
					<input type="text" class="form-control" ng-model="financeiro.vlr_previsto">
				</div>

				<label class="col-lg-2 control-label">Valor Realizado</label> 
				<div class="col-lg-2">
					<input type="text" class="form-control" ng-model="financeiro.vlr_realizado">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-2 control-label">Observações</label>
				<div class="col-lg-6">
					<textarea class="form-control" rows="5"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-lg-2 control-label">Anexos</label> 
				<div class="col-lg-6">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nome do Arquivo</th>        				
								<th>
									<span class="pull-left btn btn-default btn-file">
										Selecionar... <input type="file">
									</span>
								</th>		
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div class="panel-footer clearfix">
			<div class="pull-right">
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>

	<div class="modal fade" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="modalItemsLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalItemsLabel"></h4>
				</div>
				<div class="modal-body">
					<table id="mytable">
					</table>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>