app.service('FilterSrvc', function($window){
	this.KEY = 'App.FilterData',
	this.camposFiltro = [
		{
			cod_campo: "1", 
			dsc_campo: "Venceu ou pagou no período"
		},{
			cod_campo: "2", 
			dsc_campo: "Vence no período"
		},{
			cod_campo: "3", 
			dsc_campo: "Pago no período"
		}
	],
	this.tiposDespesa = [
		{
			cod_tipo_lancamento: '0', 
			nme_tipo_despesa: "Todos"
		},{
			cod_tipo_lancamento: '1', 
			nme_tipo_despesa: "Receitas"
		},{
			cod_tipo_lancamento: '2', 
			nme_tipo_despesa: "Despesas"
		}
	],
	this.filter = {},
	this.registerFilter = function(filter) {
		this.filter = filter;
		this.storeFilterData();
	},
	this.storeFilterData = function() {
		$window.sessionStorage.setItem(this.KEY, JSON.stringify(this.filter));
	}
	this.getFilter = function() {
		var storedData = $window.sessionStorage.getItem(this.KEY);
		
		if(storedData) {
			this.filter = JSON.parse(storedData);
		}

		if(Object.keys(this.filter).length == 0) { // pre-initilyze data
			this.filter = {
				dta_inicio: getFirstDateOfMonthString(),
				dta_fim: getLastDateOfMonthString(),
				dsc_lancamento: "",
				num_nota_fatura: "",
				dsc_lancamento: "",
				vlr_inicial: "",
				vlr_final: "",
				cod_tipo_lancamento: this.tiposDespesa[0].cod_tipo_lancamento,
				favorecido: {
					data: {},
					type: "",
					label: ""
				},
				cod_natureza_operacao: "",
				cod_campo_filtro: this.camposFiltro[0].cod_campo
			};

			this.registerFilter(this.filter);
		}

		return this.filter;
	},
	this.getCamposFiltro = function() {
		return this.camposFiltro;
	},
	this.getTiposDespesa = function() {
		return this.tiposDespesa;
	}
});