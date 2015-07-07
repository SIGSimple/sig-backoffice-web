app.controller('PageTitleCtrl', function($scope, $http){
	$scope.page = {};

	function loadPageDetails() {
		var thisPage = document.location.pathname.split('/')[2];

		$http.get(baseUrlApi()+'modulos?url_modulo='+ thisPage)
			.success(function(pageData) {
				$scope.page = pageData[0];
			});
	}

	loadPageDetails();
});