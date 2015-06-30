app.controller('PageTitleCtrl', function($scope, $http){
	$scope.page = {};

	function loadPageDetails() {
		var query = getQueryParams(document.location.search);
		var thisPage = query.page;

		$http.get(baseUrlApi()+'modulos?url_modulo='+ thisPage)
			.success(function(pageData) {
				$scope.page = pageData[0];
			});
	}

	loadPageDetails();
});