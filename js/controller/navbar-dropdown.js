app.controller('NavBarDropDownCtrl', function($scope, $http, UserSrvc){
	$scope.usuario = UserSrvc.getUserLogged();

	$scope.getFirstAndLastName = function(nmeUsuario) {
		return UserSrvc.getFirstAndLastName(nmeUsuario);
	}
});