app.service('UserSrvc', function($http){
	this.getUserLogged = function() {
		var userLogged = {};
		$.ajax({
			url: 'http://192.168.0.12/sig-backoffice-web/php.util/session.php',
			async: false,
			success: function(userData){
				userLogged = userData;
			},
			error: function(error) {
				console.log(error);
			}
		});
		
		return userLogged;
	}
});