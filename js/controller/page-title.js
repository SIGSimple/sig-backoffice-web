app.controller('PageTitleCtrl', function($scope, $http){
	$scope.page = {};

	function loadPageDetails() {
		$http.get('http://localhost/sig-backoffice-api/modulos')
			.success(function(items) {
				$scope.menuItems = items;
				buildMenuTree();
			});
	}
});