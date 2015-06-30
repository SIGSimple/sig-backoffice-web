function printDiv(id, pg) {
	var contentToPrint, printWindow;

	contentToPrint = window.document.getElementById(id).innerHTML;
	printWindow = window.open(pg);

    printWindow.document.write("<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>");
	printWindow.document.write("<link href='css/font-awesome.min.css' rel='stylesheet'>");
	printWindow.document.write("<link href='css/pace.css' rel='stylesheet'>");
	printWindow.document.write("<link href='css/endless.min.css' rel='stylesheet'>");
	printWindow.document.write("<link href='css/endless-skin.css' rel='stylesheet'>");

	printWindow.document.write("<style type='text/css' media='print'>@page { size: landpage; } </style>");

	printWindow.document.write(contentToPrint);

	printWindow.window.print();
	printWindow.document.close();
	printWindow.focus();
}

function formatDate(dta) {
	var arr_date_first = dta.split('/');
	if(arr_date_first.length == 1)
		var arr_date_first = dta.split('-');

	var date= arr_date_first[2]+'-'+arr_date_first[1]+'-'+arr_date_first[0];

	return date;
}

function formatDateBR(dta) {
	var arr_date_first = dta.split(' ');
	arr_date_first = arr_date_first[0];
	arr_date_first = arr_date_first.split('-');
	var date= arr_date_first[2]+'/'+arr_date_first[1]+'/'+arr_date_first[0];

	return date;
}

function numdias(mes,ano) {
    if((mes<8 && mes%2==1) || (mes>7 && mes%2==0)) return 31;
    if(mes!=2) return 30;
    if(ano%4==0) return 29;
    return 28;
}

function somadias(data, dias) {
   data=data.split('/');
   diafuturo=parseInt(data[0])+dias;
   mes=parseInt(data[1]);
   ano=parseInt(data[2]);
   while(diafuturo>numdias(mes,ano)) {
       diafuturo-=numdias(mes,ano);
       mes++;
       if(mes>12) {
           mes=1;
           ano++;
       }
   }

   if(diafuturo<10) diafuturo='0'+diafuturo;
   if(mes<10) mes='0'+mes;

   return diafuturo+"/"+mes+"/"+ano;
}

function subtraiData(dataAtual, dias) {
	var myDate = new Date(dataAtual);
	var dayOfMonth = myDate.getDate();
	myDate.setDate(dayOfMonth - dias);

	return(myDate.toISOString().substr(0,10));
}

function getDate(op,day,format){
	var dataAtual = new Date();
	var dayOfMonth = dataAtual.getDate();

	if(op == '-')
		dataAtual.setDate(dayOfMonth - day);
	else if(op == '+')
		dataAtual.setDate(dayOfMonth + day);

    if(dataAtual.getDate() < 10 ){
    	var dia =  '0' + dataAtual.getDate();
    }else{
    	var dia = dataAtual.getDate();
    }

    if((dataAtual.getMonth()+1) < 10){
    	var mes = '0' + (dataAtual.getMonth()+1);
    }else{
    	var mes =  dataAtual.getMonth()+1;
    }

    var ano = dataAtual.getFullYear();
    var hora = dataAtual.getHours();
    var minuto = dataAtual.getMinutes();
    var segundo = dataAtual.getSeconds();

    if(format == null)
   		 var data = ano+'-'+mes+'-'+dia;
	else if(format = 'pt')
		 var data = dia+'/'+mes+"/"+ano;

    return data ;
}

function baseUrl(){
	var pos   = window.location.pathname.lastIndexOf("/");
	var pasta = "";
	if(window.location.hostname == "localhost" || location.hostname.indexOf("192.168.") != -1){
		pasta = "/sig-backoffice-web";
	}
	//var pasta = window.location.pathname.substring(0,pos);
	return location.protocol + "//" + location.hostname+pasta+"/";

}

function baseUrlApi(){
    if(location.hostname.indexOf("192.168.") != -1)
        return "http://"+ location.hostname +"/sig-backoffice-api/";
	else if(location.hostname == 'localhost')
		return "http://localhost/sig-backoffice-api/";
	else {
		var a = document.URL;
		a = a.split(".br");

		return a[0] + ".br/api/";

		//return 'http://www.consorciointermultiplas.com.br/api/';
	}
}

function cloneArray(arr,arr_exceto){
	var arr_saida = {} ;
	$.each(arr,function(a,val){
		if(!in_array(a,arr_exceto))
			arr_saida[a] = val;
	});

	return arr_saida;

}

function in_array(val,arr){
	var b = false ;
	$.each(arr,function(a,value){
		if(val == value){
			b = true
		}
	});
	return b ;
}

function ultimoDiaDoMes(ObjetoDate){
 	return (new Date(ObjetoDate.getFullYear(), ObjetoDate.getMonth() + 1, 0) ).getDate();
}


function numberFormat(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k).toFixed(prec);
		};

		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}

		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}

		return s.join(dec);
};

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        //vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }

    return vars;
}

function empty(vlr){
	if(vlr == undefined || vlr == null || vlr == '' || vlr == 0)
		return true;
	else
		return false;
}

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}

function getFirstDateOfMonthString() {
	var dtaAtual = new Date();
	var actualMonth = parseInt(dtaAtual.getMonth() + 1);
	if(actualMonth < 10)
		actualMonth = "0" + actualMonth;
	var actualYear = dtaAtual.getFullYear();

	return "01/" + actualMonth + "/" + actualYear;
}

function getLastDateOfMonthString() {
	var dtaAtual = new Date();
	var actualMonth = parseInt(dtaAtual.getMonth() + 1);
	if(actualMonth < 10)
		actualMonth = "0" + actualMonth;
	var actualYear = dtaAtual.getFullYear();
	var lastDay = parseInt(ultimoDiaDoMes(new Date()));
	if(lastDay < 10)
		lastDay = "0" + lastDay;

	return lastDay + "/" + actualMonth + "/" + actualYear;
}

function getFirstDateOfMonth() {
	var dtaAtual = new Date();
	var actualMonth = parseInt(dtaAtual.getMonth() + 1);
	if(actualMonth < 10)
		actualMonth = "0" + actualMonth;
	var actualYear = dtaAtual.getFullYear();

	return new Date(actualYear + "/" + actualMonth + "/01");
}

function getLastDateOfMonth() {
	var dtaAtual = new Date();
	var actualMonth = parseInt(dtaAtual.getMonth() + 1);
	if(actualMonth < 10)
		actualMonth = "0" + actualMonth;
	var actualYear = dtaAtual.getFullYear();
	var lastDay = parseInt(ultimoDiaDoMes(new Date()));
	if(lastDay < 10)
		lastDay = "0" + lastDay;

	return new Date(actualYear + "/" + actualMonth + lastDay);
}

function NOW(format){
	format = format == null ? 'pt-br' : 'en' ;
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; 
	var yyyy = today.getFullYear();

	if(dd<10) {
	    dd='0'+dd;
	} 

	if(mm<10) {
	    mm='0'+mm;
	} 

	today = format == 'pt-br' ? dd+'/'+mm+'/'+yyyy : yyyy+'-'+mm+'-'+dd;
	return today;
}

String.prototype.trim = function () {
	return this.replace(/^\s+|\s+$/g,"");
}

//left trim
String.prototype.ltrim = function () {
	return this.replace(/^\s+/,"");
}

//right trim
String.prototype.rtrim = function () {
	return this.replace(/\s+$/,"");
}

$(function(){
	$('#invoicePrint').on("click", function() {
		printDiv("main-container", "");
	});
});

 function FormatMilhar(value,groupSeparator){
        var num = value.length == undefined ? value.toString() : num ;
        var groupSeparator = groupSeparator == null ? '.' : groupSeparator ;       
        if(num.length > 3){
             return  num.substr(0, num.length - 3) + groupSeparator + num.substr(num.length - 3);
        }else{
        	return num ;
        }
 }
