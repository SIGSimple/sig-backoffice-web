configBootstrapTable();

function fotoFormatter(value) {
	if(value != null && value != "") {
		if(window.location.hostname == "localhost")
			value = value.replace("/home/consorciointermultip/public_html/files/docs/", "../sig-backoffice-files/");
		else
			value = value.replace("/home/consorciointermultip/public_html/", "");
	}
	else
		value = "img/av1.png";

	console.log(value);
	return (value != null && value != "") ? '<img src="'+ value +'" class="img-profile-table">' : '';
}

app.controller('ListColaboradoresCtrl', function($scope, $http){
	
});