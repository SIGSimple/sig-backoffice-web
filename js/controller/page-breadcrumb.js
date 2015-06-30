app.controller('PageBreadCrumbCtrl', function($scope, $http){
	$scope.menuItems = [];

	function loadMenu() {
		$http.get(baseUrlApi()+'modulos')
			.success(function(items) {
				$scope.menuItems = items;
				buildMenuTree($scope.menuItems);
			});
	}

	function buildMenuTree(arr) {
		var html = "";

		$.each(arr, function(i, item) {
			if(item.children == null || item.children.length == 0) {
				var query = getQueryParams(document.location.search);
				var page = query.page;

				if(item.url_modulo == page)
					$("ol.breadcrumb").append('<li><a href="'+ item.url_modulo +'"><i class="'+ item.icn_modulo +'"></i> '+ item.nme_modulo +'</a></li>');
			}
			else
				$("ol.breadcrumb").append('<li><a href="'+ item.url_modulo +'"><i class="'+ item.icn_modulo +'"></i> '+ item.nme_modulo +'</a></li>');

			if(item.children != null && item.children.length > 0) {
				buildMenuTree(item.children);
			}
		});
	}

	loadMenu();
});