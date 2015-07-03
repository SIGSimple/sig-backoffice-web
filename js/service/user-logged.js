app.service('UserSrvc', function($http){
	this.getUserLogged = function() {
		var userLogged = {};
		$.ajax({
			url: baseUrl()+'/php.util/session.php',
			async: false,
			success: function(userData){
				userLogged = userData;

				if($.cookie('settings-theme-name') && $.cookie('settings-theme-type')){
					changeTheme($.cookie('settings-theme-name'), $.cookie('settings-theme-type'));
				} else {
					if(userLogged.cooperator != null && userLogged.cooperator.flg_sexo == 'M')
						changeTheme('theme-navy', 'c');
					else if(userLogged.cooperator != null && userLogged.cooperator.flg_sexo == 'F')
						changeTheme('theme-prickly-pear', 'a');
					else
						changeTheme('theme-lime', 'a');
				}
			},
			error: function(error) {
				console.log(error);
			}
		});
		
		return userLogged;
	},
	this.getFirstAndLastName = function(nmeUsuario) {
		return nmeUsuario.split(" ")[0] + " " + nmeUsuario.split(" ")[nmeUsuario.split(" ").length-1];
	}
});