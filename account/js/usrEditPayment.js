//checkout.js
var visaPattern = /^4\d{3}([\ \-]?)\d{4}\1\d{4}\1\d{4}$/;
var mastPattern = /^(?:5[1-5][0-9]{14})$/;
var amexPattern = /^(?:3[47][0-9]{13})$/;
var discPattern = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
var cvvPattern = /^[0-9]{3,4}$/;
var zipPattern =  /^[0-9]{5}$/;
var phonePattern = /^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/;

function ccValid(){
	var newCardNum = document.getElementById("cardNum");
	var ccNum = newCardNum.value;
	
    var isVisa = visaPattern.test( ccNum ) === true;
    var isMast = mastPattern.test( ccNum ) === true;
    var isAmex = amexPattern.test( ccNum ) === true;
    var isDisc = discPattern.test( ccNum ) === true;
    
    if( isVisa  || isMast || isAmex || isDisc) {
		newCardNum.style.backgroundColor = "rgba(50,255,130,1.00)";
		return true;
    }else {
		newCardNum.style.backgroundColor = "rgba(229,229,229,1.00)";
		return false;
	}
}

// validate month
function mmCheck() {
	var mmObj = document.getElementById('mm');
	var mm = mmObj.value;
	
	mmObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	if (mm.length == 2){
		if (mm == '01') { return true; }
		if (mm == '02') { return true; }
		if (mm == '03') { return true; }
		if (mm == '04') { return true; }
		if (mm == '05') { return true; }
		if (mm == '06') { return true; }
		if (mm == '07') { return true; }
		if (mm == '08') { return true; }
		if (mm == '09') { return true; }
		if (mm == '10') { return true; }
		if (mm == '11') { return true; }
		if (mm == '12') { return true; }
	}
	mmObj.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function yyCheck() {
	var yyObj = document.getElementById('yyyy');
	var yy = yyObj.value;
	var d = new Date();
	year = Number(d.getFullYear());
	yyNum = 0;
	
	
	yyObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	if (yy.length == 4) {
		yyNum = Number(yy);
		if (yyNum >= year) { return true; }
	}
	
	yyObj.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
	
}

function cvvCheck() {
	var cvvObj = document.getElementById('cvv');
	var cvv = cvvObj.value;
	cvvObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	var isCVV = cvvPattern.test( cvv ) === true;
	
	if (isCVV) { return true; }
	
	cvvObj.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function zipCheck() {
	var zipObj = document.getElementById('zip');
	var zip = zipObj.value;
	zipObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	var isZip = zipPattern.test( zip ) === true;
	
	if (isZip) { return true; }
	
	zipObj.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function addrCheck() {
	var addr1Obj = document.getElementById('addr1');
	var addr1 = addr1Obj.value;
	addr1Obj.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	if (addr1.length > 5){ return true; }

	addr1Obj.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function phoneCheck(){
	var phone = document.getElementById("phone");
	var pVal = phone.value;
	phone.style.backgroundColor = "rgba(50,255,130,1.00)";
	var isPhone = phonePattern.test( pVal ) === true;
	
	if (isPhone) { return true; }
	
	phone.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function cityCheck(){
	var city = document.getElementById("city");
	var cVal = city.value;
	city.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	if (cVal.length > 2){ return true; }
	
	city.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function stateCheck(){
	var state = document.getElementById("state");
	var sVal = state.value;
	state.style.backgroundColor = "rgba(50,255,130,1.00)";
	
	if (sVal.length > 1){ return true; }
	
	state.style.backgroundColor = "rgba(229,229,229,1.00)";
	return false;
}

function checkForm() {
	var addPmtBut = document.getElementById('addPmtBut');
	
	var cValid = ccValid();
	var cvvValid = cvvCheck();
	var zipValid = zipCheck();
	var mmValid = mmCheck();
	var yyValid =  yyCheck();
	var addr1Valid = addrCheck();
	var phoneValid = phoneCheck();
	var cityValid = cityCheck();
	var stateValid = stateCheck();
	
	if (cValid && zipValid && mmValid && yyValid && addr1Valid && cvvValid && phoneValid && cityValid && stateValid) {
		addPmtBut.style.display = "inline-block";
		return true;
	}else {
		addPmtBut.style.display = "none";
	}
	return false;
}
function sendForm() {
	var form = document.getElementById('addPayment');	
	
	if (checkForm()) {
		form.submit();
	}
}