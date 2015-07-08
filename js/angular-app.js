var app = angular.module('sig_backoffice', ['ui.bootstrap', 'flow', 'rcWizard'], function($httpProvider) {
	// Use x-www-form-urlencoded Content-Type
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

	var param = function(obj) {
		var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

		for(name in obj) {
			value = obj[name];

			if(value instanceof Array) {
				for(i=0; i<value.length; ++i) {
					subValue = value[i];
					fullSubName = name + '[' + i + ']';
					innerObj = {};
					innerObj[fullSubName] = subValue;
					query += param(innerObj) + '&';
				}
			}
			else if(value instanceof Object) {
				for(subName in value) {
					subValue = value[subName];
					fullSubName = name + '[' + subName + ']';
					innerObj = {};
					innerObj[fullSubName] = subValue;
					query += param(innerObj) + '&';
				}
			}
			else if(value !== undefined && value !== null)
				query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
		}

		return query.length ? query.substr(0, query.length - 1) : query;
	};

	$httpProvider.defaults.transformRequest = [function(data) {
		return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
	}];
});

app.directive("fileread", [function () {
	return {
		scope: {
			fileread: "="
		},
		link: function (scope, element, attributes) {
			element.bind("change", function (changeEvent) {
				var reader = new FileReader();
				reader.onload = function (loadEvent) {
					scope.$apply(function () {
						scope.fileread = loadEvent.target.result;
					});
				}
				reader.readAsDataURL(changeEvent.target.files[0]);
			});
		}
	}
}]);

app.directive('appFilereader', function($q) {
	var slice = Array.prototype.slice;

	return {
		restrict: 'A',
		require: '?ngModel',
		link: function(scope, element, attrs, ngModel) {
				if (!ngModel) return;

				ngModel.$render = function() {};

				element.bind('change', function(e) {
					var element = e.target;

					$q.all(slice.call(element.files, 0).map(readFile))
						.then(function(values) {
							if (element.multiple) ngModel.$setViewValue(values);
							else ngModel.$setViewValue(values.length ? values[0] : null);
						});

					function readFile(file) {
						var deferred = $q.defer();

						var reader = new FileReader();
						reader.onload = function(e) {
							var data = {
								file_data: e.target.result,
								file_obj: file
							};
							
							deferred.resolve(data);
						};
						reader.onerror = function(e) {
							deferred.reject(e);
						};
						reader.readAsDataURL(file);

						return deferred.promise;
					}

				}); //change

			} //link
	}; //return
});