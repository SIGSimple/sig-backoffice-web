app.controller('MenuCtrl', function($scope, $http){
	$scope.menuItems = [];

	$scope.activeSub = function(url) {
		return ($scope.activeLink(url).length > 0) ? 'active-sub active' : '';
	}	

	$scope.collapseIn = function(url) {
		return ($scope.activeLink(url).length > 0) ? 'in' : '';
	}

	$scope.activeLink = function(url) {
		var thisPage = document.location.pathname.split('/')[document.location.pathname.split('/').length-1];
		var cssClass = (thisPage === url) ? 'active-link' : '';
		
		if(cssClass != "")
			$("li.active-link").parent().addClass("in").parent().addClass("active-sub active")

		return cssClass;
	}

	function loadMenu() {
		$http.get(baseUrlApi()+'modulos')
			.success(function(items) {
				$scope.menuItems = items;
				buildMenuTree();
			});
	}

	function buildMenuTree() {
		var html = "";

		$.each($scope.menuItems, function(i, item) {
			html += '<li class="list-header">'+ item.nme_modulo +'</li>';

			if(item.children != null && item.children.length > 0) {
				$.each(item.children, function(x, xitem) {
					html += '<li class="active-sub active">';
					html += 	'<a href="#">';
					html += 		'<i class="fa fa-briefcase"></i>';
					html += 		'<span class="menu-title">'+ xitem.nme_modulo +'</span>';
					html += 		'<i class="arrow"></i>';
					html += 	'</a>';

					if(xitem.children != null && xitem.children.length > 0) {
						html += '<ul class="collapse in">';

						$.each(xitem.children, function(y, yitem) {
							html += '<li class="'+ $scope.activeLink(yitem.url_modulo) +'"><a href="?page='+ yitem.url_modulo +'">'+ yitem.nme_modulo +'</a></li>';
						})

						html += '</ul>';
					}

					html += '</li>';
				});
			}
		});

		$("#mainnav-menu").append(html);

		/*<li class="list-header"></li>
		<li class="active-sub">
			<a href="#">
				<i class="fa fa-briefcase"></i>
				<span class="menu-title"></span>
				<i class="arrow"></i>
			</a>
			<ul class="collapse in">
				<li class="active-link"><a href="?page="></a></li>
			</ul>
		</li>

		<li class="list-divider"></li>*/
	}
});