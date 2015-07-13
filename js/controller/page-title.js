app.controller('PageTitleCtrl', function($scope, $http){
	$scope.page = {};

	function loadPageDetails() {
		var thisPage = document.location.pathname.split('/')[document.location.pathname.split('/').length-1];

		$http.get(baseUrlApi()+'modulos?url_modulo='+ thisPage)
			.success(function(pageData) {
				$scope.page = pageData[0];
			});
	}

	loadPageDetails();
});