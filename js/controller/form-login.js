app.controller('LoginCtrl', function($scope, $http, $timeout){
	$scope.dadosLogin = {};
	$scope.users = [];
	$scope.errorMessage = "";

	$scope.login = function() {
		$http.get(baseUrlApi()+'usuarios?nme_login='+$scope.dadosLogin.nme_login+'&nme_senha='+$scope.dadosLogin.nme_senha)
			.success(function(items) {
				$scope.users = items.rows;
			})
			.error(function(data, status, headers, config){
				if(status === 404)
					$scope.errorMessage = data;
			});
	}

	$scope.cancelLogin = function() {
		$scope.dadosLogin = {};
		$scope.users = [];
		$scope.errorMessage = "";
	}

	$scope.getFirstAndLastName = function(nmeUsuario) {
		return nmeUsuario.split(" ")[0] + " " + nmeUsuario.split(" ")[nmeUsuario.split(" ").length-1];
	}
});