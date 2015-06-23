app.controller('PageTitleCtrl', function($scope, $http){
	$scope.page = {};

	function loadPageDetails() {
		var query = getQueryParams(document.location.search);
		var thisPage = query.page;

		$http.get('http://192.168.0.12/sig-backoffice-api/modulos?url_modulo='+ thisPage)
			.success(function(pageData) {
				$scope.page = pageData[0];
			});
	}

	loadPageDetails();
});