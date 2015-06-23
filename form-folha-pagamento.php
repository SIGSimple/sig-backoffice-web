<div class="panel" ng-controller="FolhaPagamentoCtrl">
	<div class="panel-body">
		<form class="form">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label class="control-label sr-only"></label>
						<input type="text" class="form-control text-center text-bold" disabled="disabled" value="{{ colaborador.num_matricula }} - {{ colaborador.nme_colaborador }}">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label class="control-label text-bold">Cargo:</label>
						<input type="text" class="form-control" disabled="disabled" value="Auxiliar Administrativo">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label class="control-label text-bold">Salário:</label>
						<input type="text" class="form-control text-right" disabled="disabled" value="{{ folhaPagamento.vlrSalarioBruto | currency : 'R$ ' : 2 }}">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th colspan="3" class="text-center text-bold">PROVENTOS</th>
							</tr>
							<tr>
								<th class="text-center text-bold">DESCRIÇÃO</th>
								<th class="text-center text-bold" width="80">REF.</th>
								<th class="text-center text-bold" width="130">VALOR</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="registro in folhaPagamento.registros | filter: { cod_tipo_registro: 1 }">
								<td>{{ registro.dsc_registro }}</td>
								<td class="text-right">
									<span ng-if="registro.cod_unidade_medida == 1">{{ registro.vlr_referencia }}</span>
									<span ng-if="registro.cod_unidade_medida == 2">{{ registro.vlr_referencia }}%</span>
									<span ng-if="registro.cod_unidade_medida == 3">{{ registro.vlr_referencia | date : 'H:mm'}}</span>
								</td>
								<td class="text-right">{{ registro.vlr_total | currency : 'R$ ' : 2 }}</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-lg-6">
					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th colspan="3" class="text-center text-bold">DESCONTOS</th>
							</tr>
							<tr>
								<th class="text-center text-bold">DESCRIÇÃO</th>
								<th class="text-center text-bold" width="80">REF.</th>
								<th class="text-center text-bold" width="130">VALOR</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="registro in folhaPagamento.registros | filter: { cod_tipo_registro: 2 }">
								<td>{{ registro.dsc_registro }}</td>
								<td class="text-right">
									<span ng-if="registro.cod_unidade_medida == 1">{{ registro.vlr_referencia }}</span>
									<span ng-if="registro.cod_unidade_medida == 2">{{ registro.vlr_referencia }}%</span>
									<span ng-if="registro.cod_unidade_medida == 3">{{ registro.vlr_referencia | date : 'H:mm'}}</span>
								</td>
								<td class="text-right">{{ registro.vlr_total | currency : 'R$ ' : 2 }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th></th>
								<th width="80" class="text-center text-bold">TOTAL</th>
								<th width="130" class="text-right text-bold">{{ folhaPagamento.vlrTotalProventos | currency : 'R$ ' : 2 }}</th>
							</tr>
							<tr>
								<th>Base IRRF:</th>
								<th colspan="2">Base INSS Empresa e FGTS:</th>
							</tr>
							<tr>
								<td class="text-right">{{ folhaPagamento.vlrBaseIRRF | currency : 'R$ ' : 2 }}</td>
								<td colspan="2" class="text-right">{{ folhaPagamento.vlrTotalProventos | currency : 'R$ ' : 2 }}</td>
							</tr>
							<tr>
								<td colspan="2">Dedução de IR</td>
								<td class="text-right">{{ folhaPagamento.vlrDeducaoIRRFFaixa | currency : 'R$ ' : 2 }}</td>
							</tr>
							<tr>
								<td colspan="2">Dependentes: ({{ folhaPagamento.qtdDependentes }})</td>
								<td class="text-right">{{ folhaPagamento.vlrDeducaoIRRFDependenteTotal | currency : 'R$ ' : 2 }}</td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="col-lg-6">
					<table class="table table-bordered table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th></th>
								<th width="80" class="text-center text-bold">TOTAL</th>
								<th width="130" class="text-right text-bold">{{ folhaPagamento.vlrTotalDescontos | currency : 'R$ ' : 2 }}</th>
							</tr>
							<tr>
								<th>Base INSS Segurado:</th>
								<th colspan="2">FGTS:</th>
							</tr>
							<tr>
								<td class="text-right">{{ folhaPagamento.vlrTotalProventos | currency : 'R$ ' : 2 }}</td>
								<td colspan="2" class="text-right">{{ folhaPagamento.vlrFGTS | currency : 'R$ ' : 2 }}</td>
							</tr>
							<tr height="58">
								<th class="text-middle" colspan="2">Líquido</th>
								<th class="text-middle text-right">{{ folhaPagamento.vlrSalarioLiquido | currency : 'R$ ' : 2 }}</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>