app.controller('ConferenciaDadosPessoaisCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador 	= UserSrvc.getUserLogged();
	$scope.colaborador.novosDados = {};
	$scope.tmpModal = { flg_removido: false };

	$scope.enviarDadosParaAtualizacao = function() {
		$("button.btn-success.fa-save").button('loading');
		$http.post(baseUrlApi()+'colaborador/conferencia/dados', $scope.colaborador)
			.success(function(message, status, headers, config){
				$("button.btn-success.fa-save").button('reset');
				showNotification("Enviado!", message, null, 'page', status);
			})
			.error(function(message, status, headers, config){
				$("button.btn-success.fa-save").button('reset');
				showNotification(null, message, null, 'page', status);
			})
	}

	$scope.abreModalTelefone = function() {
		$("#modalAddTelefone").modal("show");
	}

	$scope.abreModalEmail = function() {
		$("#modalAddEmail").modal("show");	
	}

	$scope.abreModalDependente = function(isEditMode, item) {
		if(isEditMode){
			$scope.tmpModal = angular.copy(item);
			$scope.tmpModal.$$hashKey = item.$$hashKey;
		}
		$("#modalAddDependente").modal("show");	
	}

	$scope.addTelefone = function(){
		$scope.colaborador.cooperator.telefones.push( angular.copy($scope.tmpModal) );
		$scope.tmpModal = {};
		$("#modalAddTelefone").modal("hide");
	}

	$scope.addDependente = function(){		
		if($scope.tmpModal.$$hashKey == "") {
			$scope.colaborador.cooperator.dependentes.push( angular.copy($scope.tmpModal) );
		}
		else {
			for (var i = 0; i < $scope.colaborador.cooperator.dependentes.length; i++) {
				if($scope.colaborador.cooperator.dependentes[i].$$hashKey == $scope.tmpModal.$$hashKey)
					$scope.colaborador.cooperator.dependentes[i] = angular.copy($scope.tmpModal);
			};
		}

		$scope.tmpModal = {};
		resetSwitchInput();
		$("#modalAddDependente").modal("hide");
	}

	$scope.desabilitaItem = function(item) {
		item.flg_removido = true;
	}

	$scope.addEmail = function(){
		$scope.colaborador.cooperator.emails.push( angular.copy($scope.tmpModal) );
		$scope.tmpModal = {};
		$("#modalAddEmail").modal("hide");
	}

	function habilitaTodosOsItens() {
		if($scope.colaborador.cooperator.telefones != null && $scope.colaborador.cooperator.telefones.length > 0) {
			$.each($scope.colaborador.cooperator.telefones, function(index, telefone) {
				$scope.colaborador.cooperator.telefones[index].flg_removido = false;
			});
		}

		if($scope.colaborador.cooperator.emails != null && $scope.colaborador.cooperator.emails.length > 0) {
			$.each($scope.colaborador.cooperator.emails, function(index, email) {
				$scope.colaborador.cooperator.emails[index].flg_removido = false;
			});
		}

		if($scope.colaborador.cooperator.dependentes != null && $scope.colaborador.cooperator.dependentes.length > 0) {
			$.each($scope.colaborador.cooperator.dependentes, function(index, dependente) {
				$scope.colaborador.cooperator.dependentes[index].flg_removido = false;
			});
		}
	}

	function loadTiposTelefone() {
		$http.get(baseUrlApi()+'tipos/telefone')
			.success(function(items){
				$scope.tiposTelefone = items;
			});
	}

	function loadTiposDependencia() {
		$http.get(baseUrlApi()+'tipos/dependencia')
			.success(function(items){
				$scope.tiposDependencia = items;
			});
	}

	function loadPlanosSaude() {
		$http.get(baseUrlApi()+'planos-saude?nolimit=1')
			.success(function(items){
				$scope.planosSaude = items.rows;
			});
	}

	loadTiposTelefone();
	loadTiposDependencia();
	loadPlanosSaude();
	habilitaTodosOsItens();
});