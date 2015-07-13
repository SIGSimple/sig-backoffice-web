app.controller('ConferenciaDadosPessoaisCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador 	= UserSrvc.getUserLogged();
	$scope.colaborador.novosDados = {};
	$scope.tmpModal = { flg_removido: false };

	$scope.enviarDadosParaAtualizacao = function() {
		$http.post(baseUrlApi()+'colaborador/conferencia/dados', $scope.colaborador)
			.success(function(message, status, headers, config){
				console.log(message);
			})
			.error(function(message, status, headers, config){
				console.log(message, status);
			})
	}

	$scope.abreModalTelefone = function() {
		$("#modalAddTelefone").modal("show");
	}

	$scope.abreModalEmail = function() {
		$("#modalAddEmail").modal("show");	
	}

	$scope.addTelefone = function(){
		$scope.colaborador.cooperator.telefones.push( angular.copy($scope.tmpModal) );
		$scope.tmpModal = {};
		$("#modalAddTelefone").modal("hide");
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

	loadTiposTelefone();
	habilitaTodosOsItens();
});