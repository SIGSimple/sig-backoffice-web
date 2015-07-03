app.controller('HomeCtrl', function($scope, $http, UserSrvc){
	$scope.colaborador 	= UserSrvc.getUserLogged();

	if(window.logged)
		window.logged++;
	else
		window.logged = 1;

	if(window.logged == 1) {
		var fvisit  = setTimeout(function(){
			showNotification('Olá '+ $scope.colaborador.user.nme_usuario.split(" ")[0] +',', 'Seja bem-vindo de volta!', 'fa-thumbs-up fa-lg', 'floating');
			clearTimeout(fvisit);
		}, 3000);
	}
});