app.service('UserSrvc', function($http){
	this.getUserLogged = function() {
		var userLogged = {};
		$.ajax({
			url: baseUrl()+'/php.util/session.php',
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