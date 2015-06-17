app.controller('NavBarDropDownCtrl', function($scope, $http, UserSrvc){
	$scope.usuario = UserSrvc.getUserLogged();
});