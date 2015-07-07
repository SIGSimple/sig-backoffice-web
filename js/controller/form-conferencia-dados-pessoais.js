app.controller('ConferenciaDadosPessoaisCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador 	= UserSrvc.getUserLogged();
});