
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

function utf8_encode ( string ) {
 
    string = (string+'').replace(/\r\n/g, "\n").replace(/\r/g, "\n");
 
    var utftext = "";
    var start, end;
    var stringl = 0;
 
    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;
 
        if (c1 < 128) {
            end++;
        } else if((c1 > 127) && (c1 < 2048)) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {
            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc != null) {
            if (end > start) {
                utftext += string.substring(start, end);
            }
            utftext += enc;
            start = end = n+1;
        }
    }
 
    if (end > start) {
        utftext += string.substring(start, string.length);
    }
 
    return utftext;
}

function md5(str) {
  //  discuss at: http://phpjs.org/functions/md5/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Jack
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Brett Zamir (http://brett-zamir.me)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //  depends on: utf8_encode
  //   example 1: md5('Kevin van Zonneveld');
  //   returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'

  var xl;

  var rotateLeft = function(lValue, iShiftBits) {
    return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
  };

  var addUnsigned = function(lX, lY) {
    var lX4, lY4, lX8, lY8, lResult;
    lX8 = (lX & 0x80000000);
    lY8 = (lY & 0x80000000);
    lX4 = (lX & 0x40000000);
    lY4 = (lY & 0x40000000);
    lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
    if (lX4 & lY4) {
      return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
    }
    if (lX4 | lY4) {
      if (lResult & 0x40000000) {
        return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
      } else {
        return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
      }
    } else {
      return (lResult ^ lX8 ^ lY8);
    }
  };

  var _F = function(x, y, z) {
    return (x & y) | ((~x) & z);
  };
  var _G = function(x, y, z) {
    return (x & z) | (y & (~z));
  };
  var _H = function(x, y, z) {
    return (x ^ y ^ z);
  };
  var _I = function(x, y, z) {
    return (y ^ (x | (~z)));
  };

  var _FF = function(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _GG = function(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _HH = function(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _II = function(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var convertToWordArray = function(str) {
    var lWordCount;
    var lMessageLength = str.length;
    var lNumberOfWords_temp1 = lMessageLength + 8;
    var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
    var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
    var lWordArray = new Array(lNumberOfWords - 1);
    var lBytePosition = 0;
    var lByteCount = 0;
    while (lByteCount < lMessageLength) {
      lWordCount = (lByteCount - (lByteCount % 4)) / 4;
      lBytePosition = (lByteCount % 4) * 8;
      lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
      lByteCount++;
    }
    lWordCount = (lByteCount - (lByteCount % 4)) / 4;
    lBytePosition = (lByteCount % 4) * 8;
    lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
    lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
    lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
    return lWordArray;
  };

  var wordToHex = function(lValue) {
    var wordToHexValue = '',
      wordToHexValue_temp = '',
      lByte, lCount;
    for (lCount = 0; lCount <= 3; lCount++) {
      lByte = (lValue >>> (lCount * 8)) & 255;
      wordToHexValue_temp = '0' + lByte.toString(16);
      wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
    }
    return wordToHexValue;
  };

  var x = [],
    k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
    S12 = 12,
    S13 = 17,
    S14 = 22,
    S21 = 5,
    S22 = 9,
    S23 = 14,
    S24 = 20,
    S31 = 4,
    S32 = 11,
    S33 = 16,
    S34 = 23,
    S41 = 6,
    S42 = 10,
    S43 = 15,
    S44 = 21;

  str = this.utf8_encode(str);
  x = convertToWordArray(str);
  a = 0x67452301;
  b = 0xEFCDAB89;
  c = 0x98BADCFE;
  d = 0x10325476;

  xl = x.length;
  for (k = 0; k < xl; k += 16) {
    AA = a;
    BB = b;
    CC = c;
    DD = d;
    a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
    d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
    c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
    b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
    a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
    d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
    c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
    b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
    a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
    d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
    c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
    b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
    a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
    d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
    c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
    b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
    a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
    d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
    c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
    b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
    a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
    d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
    c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
    b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
    a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
    d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
    c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
    b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
    a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
    d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
    c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
    b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
    a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
    d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
    c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
    b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
    a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
    d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
    c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
    b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
    a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
    d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
    c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
    b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
    a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
    d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
    c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
    b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
    a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
    d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
    c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
    b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
    a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
    d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
    c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
    b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
    a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
    d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
    c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
    b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
    a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
    d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
    c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
    b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
    a = addUnsigned(a, AA);
    b = addUnsigned(b, BB);
    c = addUnsigned(c, CC);
    d = addUnsigned(d, DD);
  }

  var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);

  return temp.toLowerCase();
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
		//var a = document.URL;
		//a = a.split(".br");
		//return a[0] + ".br/api/";
    return document.URL.split("/")[0] + "//" + document.URL.split("/")[2] + "/api/";
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
