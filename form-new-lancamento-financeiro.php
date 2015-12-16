<div class="panel" ng-controller="CadastroFinanceiroCtrl">
	<form class="form form-horizontal">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-lg-2 control-label">Tipo de Lançamento?</label>
				<div class="col-lg-4">
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.cod_tipo_lancamento = 1; lancamentoFinanceiro.tipoLancamento = 'Receita';" ng-checked="(lancamentoFinanceiro.cod_tipo_lancamento == 1 || lancamentoFinanceiro.tipoLancamento == 'Receita')">Receita</label>
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.cod_tipo_lancamento = 2; lancamentoFinanceiro.tipoLancamento = 'Despesa'" ng-checked="(lancamentoFinanceiro.cod_tipo_lancamento == 2 || lancamentoFinanceiro.tipoLancamento == 'Despesa')">Despesa</label>
				</div>
			</div>

			<!--Dados do Documento-->
			<fieldset>
				<legend>Dados do Documento</legend>

				<div class="form-group">
					<label class="radio-inline first"><input type="radio" ng-click="lancamentoFinanceiro.favorecido.type = 'empresas'" ng-checked="(lancamentoFinanceiro.favorecido.type == 'empresas')">Empresa</label>
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.favorecido.type = 'colaboradores'" ng-checked="(lancamentoFinanceiro.favorecido.type == 'colaboradores')">Colaborador</label>
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.favorecido.type = 'terceiros'" ng-checked="(lancamentoFinanceiro.favorecido.type == 'terceiros')">Terceiros</label>
					<div class="col-lg-2">
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label">Favorecido</label>
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.favorecido.label }}" ng-click="abreModal('FAVORECIDO', 'lancamentoFinanceiro', true)">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" ng-click="abreModal('FAVORECIDO', 'lancamentoFinanceiro', true)">
									<i class="fa fa-search"></i>
								</button>
								<button type="button" class="btn btn-default" tooltip="Limpar seleção" ng-click="lancamentoFinanceiro.favorecido = {}">
									<i class="fa fa-times"></i>
								</button>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="element-group">
						<label class="col-lg-2 control-label {{ (lancamentoFinanceiro.tipoLancamento == 'Receita') ? 'hide' : '' }}" for="num_nota_fatura">No. Nota/Fatura</label> 
						<div class="col-lg-2 {{ (lancamentoFinanceiro.tipoLancamento == 'Receita') ? 'hide' : '' }}">
							<input type="text" id="num_nota_fatura" class="form-control" ng-model="lancamentoFinanceiro.num_nota_fatura">
						</div>
					</div>

					<label class="col-lg-2 control-label" for="num_lancamento_contabil">Cód. Lanç. Contábil</label> 
					<div class="col-lg-2">
						<input type="text" id="num_lancamento_contabil" class="form-control" ng-model="lancamentoFinanceiro.num_lancamento_contabil">
					</div>

					<label class="col-lg-1 control-label" for="num_documento_banco">No. Banco</label> 
					<div class="col-lg-2">
						<input type="text" id="num_documento_banco" class="form-control" ng-model="lancamentoFinanceiro.num_documento_banco">
					</div>
				</div>

				<div class="form-group element-group">
					<label class="col-lg-2 control-label" for="dsc_lancamento"><strong>Descrição</strong></label>
					<div class="col-lg-9">
						<input type="text" id="dsc_lancamento" class="form-control" ng-model="lancamentoFinanceiro.dsc_lancamento">
					</div>
				</div>

				<div class="form-group">
					<div class="element-group">
						<label class="col-lg-2 control-label" for="dta_emissao"><strong>Emissão</strong></label>
						<div class="col-lg-2">
							<div class="input-group date">
								<input type="text" id="dta_emissao" class="form-control" ng-model="lancamentoFinanceiro.dta_emissao">
								<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
							</div>
						</div>
					</div>

					<label class="col-lg-1 control-label" for="dta_competencia">Competência</label>
					<div class="col-lg-2">
						<div class="input-group date">
							<input type="text" id="dta_competencia" class="form-control" ng-model="lancamentoFinanceiro.dta_competencia">
							<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label" for="cod_conta_contabil">Conta Contábil</label>
					<div class="col-lg-9">
						<select id="cod_conta_contabil" name="cod_conta_contabil" 
							chosen class="chosen" options="planosConta"
							ng-model="lancamentoFinanceiro.cod_conta_contabil"
							ng-options="item.cod_item as ('(' + item.num_item + ') ' + item.dsc_item) for item in planosConta">
						</select>
					</div>
				</div>

				<div class="form-group element-group">
					<label class="col-lg-2 control-label" for="cod_natureza_operacao">Natureza da Operação</label>
					<div class="col-lg-9">
						<select id="cod_natureza_operacao" name="cod_natureza_operacao"
							chosen class="chosen" options="planosConta"
							ng-model="lancamentoFinanceiro.cod_natureza_operacao"
							ng-options="item.cod_item as ('(' + item.num_item + ') ' + item.dsc_item) for item in planosConta">
						</select>
					</div>
				</div>
			</fieldset>

			<!--Dados de Pagamento-->
			<fieldset>
				<legend>Dados de Pagamento</legend>
			
				<div class="form-group">
					<div class="element-group">
						<label class="col-lg-1 control-label" for="vlr_orcado"><strong>Orçado</strong></label> 
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_orcado" class="form-control" ng-model="lancamentoFinanceiro.vlr_orcado" ui-number-mask>
							</div>
						</div>
					</div>

					<label class="col-lg-1 control-label" for="vlr_previsto">Empenhado<br/><small><strong>(A)</strong></small></label> 
					<div class="col-lg-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" id="vlr_previsto" class="form-control" ng-model="lancamentoFinanceiro.vlr_previsto" ng-blur="calculaValorRealizado(true)" ui-number-mask>
						</div>
					</div>

					<div class="col-lg-1">
						<button type="button" class="btn btn-primary"
							tooltip="Copiar Valor Previsto" 
							tooltip-placement="right" 
							ng-click="copyValorPrevistoEmpenhado()">
							<i class="fa fa-copy"></i>
						</button>
					</div>

					<div class="element-group">
						<label class="col-lg-3 control-label" for="dta_vencimento"><strong>Vencimento</strong></label>
						<div class="col-lg-2">
							<div class="input-group date">
								<input type="text" id="dta_vencimento" class="form-control" ng-model="lancamentoFinanceiro.dta_vencimento">
								<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-1 control-label" for="vlr_juros">Juros<br/><small><strong>(B)</strong></small></label> 
					<div class="col-lg-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" id="vlr_juros" class="form-control" ng-model="lancamentoFinanceiro.vlr_juros" ng-blur="calculaValorRealizado(true)" ui-number-mask>
						</div>
					</div>

					<label class="col-lg-1 control-label" for="vlr_desconto">Desconto<br/><small><strong>(C)</strong></small></label> 
					<div class="col-lg-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" id="vlr_desconto" class="form-control" ng-model="lancamentoFinanceiro.vlr_desconto" ng-blur="calculaValorRealizado(true)" ui-number-mask>
						</div>
					</div>

					<label class="col-lg-1 control-label" for="vlr_realizado">Realizado<br/><small><strong>((A+B)-C-D)</strong></small></label> 
					<div class="col-lg-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" id="vlr_realizado" class="form-control" ng-model="lancamentoFinanceiro.vlr_realizado" ui-number-mask readonly="readonly">
						</div>
					</div>

					<label class="col-lg-1 control-label" for="dta_pagamento">Pagamento</label>
					<div class="col-lg-2">
						<div class="input-group date">
							<input type="text" id="dta_pagamento" class="form-control" ng-model="lancamentoFinanceiro.dta_pagamento" ng-change="calculaValorRealizado(true)">
							<span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
						</div>
					</div>
				</div>
			</fieldset>

			<!--Apuração de Impostos-->
			<!--<fieldset ng-show="(lancamentoFinanceiro.favorecido.type == 'empresas' && lancamentoFinanceiro.favorecido.data != null)">
				<legend>Apuração de Impostos</legend>

				<div class="form-group">
					<label class="col-lg-2 control-label">Apurar impostos?</label>
					<div class="col-lg-2">
						<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.flg_apurar_impostos = true; calculaValorRealizado(true);" ng-checked="(lancamentoFinanceiro.flg_apurar_impostos == true)">Sim</label>
						<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.flg_apurar_impostos = false; clearTaxValues();" ng-checked="(lancamentoFinanceiro.flg_apurar_impostos == false)">Não</label>
					</div>
				</div>

				<div class="impostos" ng-show="(lancamentoFinanceiro.flg_apurar_impostos == true)">
					<div class="form-group">
						<label class="col-lg-1 control-label">ISS</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_iss" class="input-switch" ng-model="lancamentoFinanceiro.flg_iss">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_iss" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_iss"
									ng-blur="calculaImposto('flg_iss')"
									ng-readonly="(!lancamentoFinanceiro.flg_iss)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_iss" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_iss"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-1 control-label">IRRF</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_irrf" class="input-switch" ng-model="lancamentoFinanceiro.flg_irrf">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_irrf" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_irrf"
									ng-blur="calculaImposto('flg_irrf')"
									ng-readonly="(!lancamentoFinanceiro.flg_irrf)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_irrf" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_irrf"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-1 control-label">CSLL</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_csll" class="input-switch" ng-model="lancamentoFinanceiro.flg_csll">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_csll" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_csll"
									ng-blur="calculaImposto('flg_csll')"
									ng-readonly="(!lancamentoFinanceiro.flg_csll)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_csll" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_csll"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-1 control-label">INSS</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_inss" class="input-switch" ng-model="lancamentoFinanceiro.flg_inss">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_inss" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_inss"
									ng-blur="calculaImposto('flg_inss')"
									ng-readonly="(!lancamentoFinanceiro.flg_inss)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_inss" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_inss"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-1 control-label">PIS/PASEP</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_pis" class="input-switch" ng-model="lancamentoFinanceiro.flg_pis">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_pis" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_pis"
									ng-blur="calculaImposto('flg_pis')"
									ng-readonly="(!lancamentoFinanceiro.flg_pis)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_pis" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_pis"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-1 control-label">COFINS</label>
						<div class="col-lg-1">
							<input type="checkbox" name="flg_cofins" class="input-switch" ng-model="lancamentoFinanceiro.flg_cofins">
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<input type="text" id="num_percentual_cofins" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.num_percentual_cofins"
									ng-blur="calculaImposto('flg_cofins')"
									ng-readonly="(!lancamentoFinanceiro.flg_cofins)"
									ui-number-mask>
								<span class="input-group-addon">%</span>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_cofins" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_cofins"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2"></div>
						<label class="col-lg-2 control-label">Total Impostos<br/><small><strong>(D)</strong></small></label>
						<div class="col-lg-2">
							<div class="input-group">
								<span class="input-group-addon">R$</span>
								<input type="text" id="vlr_total_impostos" class="form-control text-right" 
									ng-model="lancamentoFinanceiro.vlr_total_impostos"
									readonly="readonly" ui-number-mask>
							</div>
						</div>
					</div>
				</div>
			</fieldset>-->

			<!--Recorrência-->
			<fieldset>
				<legend>Recorrência</legend>

				<div class="form-group">
					<div class="element-group">
						<label class="col-lg-2 control-label" for="qtd_dias_recorrencia">Se repete?</label>
						<div class="col-lg-3" ng-show="canUpdateRecorrencia">
							<select id="qtd_dias_recorrencia" name="qtd_dias_recorrencia" 
								chosen class="chosen" options="recorrencias"
								ng-model="lancamentoFinanceiro.qtd_dias_recorrencia" ng-change="alteraFlagRecorrencia()"
								ng-options="item.qtd_dias_recorrencia as item.dsc_recorrencia for item in recorrencias">
							</select>
						</div>
						<div class="col-lg-3" ng-hide="canUpdateRecorrencia">
							<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.dsc_recorrencia }}">
						</div>
					</div>

					<div class="element-group {{ (lancamentoFinanceiro.qtd_dias_recorrencia == 0) ? 'hide' : '' }}">
						<div class="element-group">
							<label class="col-lg-1 control-label">Tipo</label>
							<div class="col-lg-1"  name="cod_tipo_recorrencia" ng-show="canUpdateRecorrencia">
								<label class="radio-inline">
									<input type="radio" ng-click="lancamentoFinanceiro.cod_tipo_recorrencia = 1" ng-checked="(lancamentoFinanceiro.cod_tipo_recorrencia == 1)">Projeção
								</label>
								<label class="radio-inline" style="padding-left: 10px;">
									<input type="radio" ng-click="lancamentoFinanceiro.cod_tipo_recorrencia = 2" ng-checked="(lancamentoFinanceiro.cod_tipo_recorrencia == 2)">Parcelado
								</label>
							</div>
							<div class="col-lg-2" ng-hide="canUpdateRecorrencia">
								<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.dsc_tipo_recorrencia }}">
							</div>
						</div>
					</div>

					<div class="element-group {{ (lancamentoFinanceiro.qtd_dias_recorrencia == 0) ? 'hide' : '' }}">
						<label class="col-lg-1 control-label" for="qtd_parcelas">Qtd.</label> 
						<div class="col-lg-1">
							<input type="text" id="qtd_parcelas" class="form-control" ng-model="lancamentoFinanceiro.qtd_parcelas" ng-readonly="!canUpdateRecorrencia">
						</div>
					</div>
				</div>

				<div class="form-group {{ (!lancamentoFinanceiro.lancamentosVinculados) ? 'hide' : '' }}">
					<label class="col-lg-2 control-label">Lançamento Vinculados</label>
					<div class="col-lg-4">
						<table class="table table-condensed table-hover">
							<thead>
								<th class="text-center text-middle" width="10">Nø.</th>
								<th class="text-center text-middle">Venc./Pgto.</th>
								<th class="text-right text-middle">Valor</th>
								<th class="text-center text-middle" width="10">Status</th>
							</thead>
							<tbody>
								<tr ng-repeat="(index, item) in lancamentoFinanceiro.lancamentosVinculados" 
									class="{{ (item.cod_lancamento_financeiro == lancamentoFinanceiro.cod_lancamento_financeiro) ? 'warning' : '' }}">
									<td class="text-center text-middle">{{ (index+1) }}ø</td>
									<td class="text-center text-middle">{{ item.dta_vencimento | date : 'dd/MM/yyyy' }}</td>
									<td class="text-right text-middle">{{ (item.vlr_realizado > 0) ? item.vlr_realizado : ((item.vlr_previsto > 0) ? item.vlr_previsto : item.vlr_orcado) | currency : 'R$ ' : 2 }}</td>
									<td class="text-center text-middle">
										<span class="label label-table {{ (item.dta_pagamento) ? 'label-success' : 'label-warning' }}" 
											tooltip=" {{ (item.dta_pagamento) ? 'Lançamento pago' : 'Lançamento previsto' }}" tooltip-placement="right">
											<i class="fa {{ (item.dta_pagamento) ? 'fa-check-circle text-success' : 'fa-calendar text-warning' }}"></i>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</fieldset>

			<!--Informações Adicionais-->
			<fieldset>
				<legend>Informações Adicionais</legend>

				<div class="form-group">
					<label class="col-lg-2 control-label">Abrir Lançamento?</label>
					<div class="col-lg-2">
						<label class="radio-inline"><input type="radio" ng-model="lancamentoFinanceiro.flg_lancamento_aberto" ng-click="lancamentoFinanceiro.flg_lancamento_aberto = true" ng-checked="(lancamentoFinanceiro.flg_lancamento_aberto == true)">Sim</label>
						<label class="radio-inline"><input type="radio" ng-model="lancamentoFinanceiro.flg_lancamento_aberto" ng-click="lancamentoFinanceiro.flg_lancamento_aberto = false" ng-checked="(lancamentoFinanceiro.flg_lancamento_aberto == false)">Não</label>
					</div>
				</div>

				<div class="form-group {{ (lancamentoFinanceiro.flg_lancamento_aberto) ? 'hide' : '' }}">
					<label class="radio-inline first"><input type="radio" ng-click="lancamentoFinanceiro.titularMovimento.type = 'empresas'" ng-checked="(lancamentoFinanceiro.titularMovimento.type == 'empresas')">Empresa</label>
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.titularMovimento.type = 'colaboradores'" ng-checked="(lancamentoFinanceiro.titularMovimento.type == 'colaboradores')">Colaborador</label>
					<label class="radio-inline"><input type="radio" ng-click="lancamentoFinanceiro.titularMovimento.type = 'terceiros'" ng-checked="(lancamentoFinanceiro.titularMovimento.type == 'terceiros')">Terceiros</label>
					<div class="col-lg-2">
					</div>
				</div>

				<div class="form-group {{ (lancamentoFinanceiro.flg_lancamento_aberto) ? 'hide' : '' }}">
					<label class="col-lg-2 control-label">Titular do Movimento</label>
					<div class="col-lg-9">
						<div class="input-group">
							<input type="text" class="form-control" readonly="readonly" value="{{ lancamentoFinanceiro.titularMovimento.label }}" ng-click="abreModal('TITULAR_MOVIMENTO', 'lancamentoFinanceiro', true)">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" ng-click="abreModal('TITULAR_MOVIMENTO', 'lancamentoFinanceiro', true)">
									<i class="fa fa-search"></i>
								</button>
								<button type="button" class="btn btn-default" tooltip="Limpar seleção" ng-click="lancamentoFinanceiro.titularMovimento = {}">
									<i class="fa fa-times"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group {{ (lancamentoFinanceiro.flg_lancamento_aberto) ? 'hide' : '' }}">
					<label class="col-lg-2 control-label">Origem Despesa</label>
					<div class="col-lg-4">
						<select class="form-control" ng-model="lancamentoFinanceiro.cod_origem_despesa">
							<option></option>
							<option ng-repeat="item in contratos" value="{{ item.cod_origem }}">{{ item.dsc_origem }}</option>
						</select>
					</div>
				</div>

				<div class="form-group {{ (!lancamentoFinanceiro.flg_lancamento_aberto) ? 'hide' : '' }}">
					<label class="col-lg-2 control-label">Titulares do Movimento</label>
					<div class="col-lg-10">
						<table class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<th class="text-middle" width="300">Titular do Movimento</th>
								<th class="text-middle text-center">Origem da Despesa</th>
								<th class="text-middle" width="200">Informação Adicional</th>
								<th class="text-middle text-center">Valor Respectivo</th>
								<th class="text-middle text-center" width="40">
									<input type="text" class="form-control input-xs" ng-model="qtdItensToAddTable">
									<div class="clearfix"></div>
									<button type="button" class="btn btn-xs btn-primary" ng-click="addItemTabela('favorecidos')">
										<i class="fa fa-plus-square"></i>
									</button>
								</th>
							</thead>
							<tbody>
								<tr ng-repeat="item in lancamentoFinanceiro.favorecidos | filter: { flg_removido: false }">
									<td>
										<div class="input-group">
											<input type="text" class="form-control input-xs" readonly="readonly" value="{{ item.titularMovimento.label }}" ng-click="abreModal('TITULAR_MOVIMENTO', item, false)">
											<span class="input-group-btn">
												<button class="btn btn-xs btn-default" type="button" ng-click="abreModal('TITULAR_MOVIMENTO', item, false)">
													<i class="fa fa-search"></i>
												</button>
											</span>
										</div>
										<div class="radios">
											<label class="radio-inline" style="font-size: 10px; padding-left: 10px;"><input type="radio" style="margin-left: -12px;" ng-click="item.titularMovimento.type = 'empresas'" ng-checked="(item.titularMovimento.type == 'empresas')">Empresa</label>
											<label class="radio-inline" style="font-size: 10px; padding-left: 5px;"><input type="radio" style="margin-left: -12px;" ng-click="item.titularMovimento.type = 'colaboradores'" ng-checked="(item.titularMovimento.type == 'colaboradores')">Colaborador</label>
											<label class="radio-inline" style="font-size: 10px; padding-left: 5px;"><input type="radio" style="margin-left: -12px;" ng-click="item.titularMovimento.type = 'terceiros'" ng-checked="(item.titularMovimento.type == 'terceiros')">Terceiros</label>
										</div>
									</td>
									<td>
										<select class="form-control input-xs" 
											ng-model="item.cod_origem_correspondente"
											ng-options="item.cod_origem as item.dsc_origem for item in contratos">
										</select>
									</td>
									<td>
										<input type="text" class="form-control input-xs" ng-model="item.dsc_observacao_adicional">
									</td>
									<td>
										<input type="text" class="form-control input-xs text-right" ng-model="item.vlr_correspondente" ui-number-mask ng-blur="confereValorTotalRespectivo()">
									</td>
									<td class="text-center">
										<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(item);">
											<i class="fa fa-trash-o"></i>
										</button>
									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td class="text-right" colspan="3">Total</td>
									<td class="text-right {{ (validateVlrTotalRespectivo()) ? 'danger' : '' }}">
										<span class="{{ (validateVlrTotalRespectivo()) ? 'text-danger' : '' }}"
											tooltip-placement="left"
											tooltip="{{ (validateVlrTotalRespectivo()) ? 'O valor total dos itens está acima do valor total do lançamento!' : '' }}">
											{{ lancamentoFinanceiro.vlrTotalRespectivo | currency : 'R$ ' : 2 }}
										</span>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label">Observações</label>
					<div class="col-lg-9">
						<textarea class="form-control" rows="5" ng-model="lancamentoFinanceiro.dsc_observacao"></textarea>
					</div>
				</div>
			</fieldset>

			<!--<div class="form-group">
				<label class="col-lg-2 control-label">Anexos</label> 
				<div class="col-lg-8">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<th>Nome do arquivo</th>
							<th>Observações</th>
							<th class="text-right" colspan="2">
								<button type="button" class="btn btn-xs btn-primary"  ng-click="addItemTabela('anexos')"><i class="fa fa-plus-square"></i> Adicionar</button>
							</th>
						</thead>
						<tbody>
							<tr ng-repeat="item in lancamentoFinanceiro.anexos | filter: { flg_removido: false }">
								<td>
									blablabla.xls
								</td>
								<td>
									<input type="text" class="form-control input-xs">
								</td>
								<td width="40" class="text-middle">
									<span class="pull-left btn btn-xs btn-default btn-file">
										Selecionar... <input type="file">
									</span>
								</td>
								<td width="40" class="text-center">
									<button type="button" class="btn btn-xs btn-danger" ng-click="desabilitaItem(item)">
										<i class="fa fa-trash-o"></i> Remover
									</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>-->
		</div>

		<div class="panel-footer clearfix">
			<div class="pull-left">
				<button type="button" class="btn btn-danger btn-labeled fa fa-trash-o" data-toggle="modal" data-target='#modalExcluiLancamento'>Excluir Lançamento</button>
			</div>
			<div class="pull-right">
				<a href="list-lancamentos-financeiros" class="btn btn-default">Voltar p/ Listagem de Lançamentos</a>
				<button type="submit" class="btn btn-primary btn-labeled fa fa-save" data-loading-text="Aguarde, salvando..." ng-click="saveRecords()">Salvar</button>
			</div>
		</div>
	</form>

	<div class="modal fade" id="modalExcluiLancamento" tabindex="-1" role="dialog" aria-labelledby="modalExcluiLancamentoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirma exclusão?</h4>
				</div>
				<div class="modal-body">
					<p class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 1) ? 'hide' : '' }}">
						Confirma a exclusão do lançamento [<strong>{{ lancamentoFinanceiro.dsc_lancamento }}</strong>], com vencimento em [<strong>{{ (lancamentoFinanceiro.dta_vencimento) ? (lancamentoFinanceiro.dta_vencimento | date : 'dd/MM/yyyy' ) : (lancamentoFinanceiro.dta_pagamento | date : 'dd/MM/yyyy') }}</strong>]?
					</p>
					<p class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 0) ? 'hide' : '' }}">
						Este registro faz parte de um provisionamento com outras parcelas, deseja excluir este e os próximos lançamentos?
					</p>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<div class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 1) ? 'hide' : '' }}">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(false)">Sim</button>
						</div>

						<div class="{{ (lancamentoFinanceiro.flg_lancamento_recorrente == 0) ? 'hide' : '' }}">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(true)">Sim, este e os próximos</button>
							<button type="button" class="btn btn-default" ng-click="deleteRecord(false)">Não, apenas este</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalAtualizaReferencias" tabindex="-1" role="dialog" aria-labelledby="modalAtualizaReferenciasLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirma atualização?</h4>
				</div>
				<div class="modal-body">
					<p>
						Este registro faz parte de um provisionamento com outras parcelas, deseja atualizar este e os próximos lançamentos?
					</p>
					<p>
						Os seguintes campos serão replicados:
						<ul>
							<li>Valor Orçado</li>
							<li>Valor Empenhado</li>
							<li>Valor Realizado</li>
						</ul>
					</p>
				</div>
				<div class="modal-footer clearfix">
					<div class="pull-right">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-default" ng-click="deleteRecord(true)">Sim, este e os próximos</button>
						<button type="button" class="btn btn-default" ng-click="deleteRecord(false)">Não, apenas este</button>
					</div>
				</div>
			</div>
		</div>
	</div>

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