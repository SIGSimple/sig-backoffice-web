app.controller('LoginCtrl', function($scope, $http){
	$scope.dadosLogin = {};

	$scope.login = function() {
		console.log($scope.dadosLogin);
	}
});