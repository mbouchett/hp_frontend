// CreateReg.js

var phonePattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/

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
	mmObj.style.backgroundColor = "rgba(255,255,255,1.00)";
	return false;
}

function yyCheck() {
	var yyObj = document.getElementById('yyyy');
	var yy = yyObj.value;
	var d = new Date();
	year = Number(d.getFullYear());
	yyNum = 0;
	
	if (yy.length == 4) {
		yyNum = Number(yy);
		if (yyNum >= year) { 
			yyObj.style.backgroundColor = "rgba(50,255,130,1.00)";
			return true; 
		}
	}
	
	yyObj.style.backgroundColor = "rgba(255,255,255,1.00)";
	return false;
	
}

function ddCheck() {
	var ddObj = document.getElementById('dd');
	var dd = ddObj.value;
	
	if (dd.length < 2) {
		ddObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	
	ddObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;
}

function phoneCheck(){
	var phoneObj = document.getElementById('phone');
	var phone = phoneObj.value;
	
	
	var isPhone = phonePattern.test( phone ) === true;
	
	if (!isPhone) {
		phoneObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	
	phoneObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;
}

function fnCheck() {
	var fnObj = document.getElementById('fn');
	var fn = fnObj.value;
	
	if (fn.length < 3) {
		fnObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	
	fnObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;
}

function lnCheck() {
	var lnObj = document.getElementById('ln');
	var ln = lnObj.value;
	
	if (ln.length < 3) {
		lnObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	
	lnObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;	
}

function saCheck() {
	var naObj = document.getElementById('addr1');
	var na = naObj.value;
	
	if (na.length < 5) {	
		naObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	naObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;
}

function zipCheck() {
	var zipObj = document.getElementById('zip');
	var zip = zipObj.value;
	
	if (zip.length < 5) {	
		zipObj.style.backgroundColor = "rgba(255,255,255,1.00)";
		return false;
	}
	zipObj.style.backgroundColor = "rgba(50,255,130,1.00)";
	return true;
}

function validate() {
	var r_addShip = document.getElementById('radio_addShip');	
	var submit = document.getElementById('submit');
	
	submit.style.display = "none";
	
	if(!mmCheck()) return false;
	if(!ddCheck()) return false;
	if(!yyCheck()) return false;
	if(!phoneCheck()) return false;
	if(!fnCheck()) return false;
	if(!lnCheck()) return false;
	
	if (r_addShip.checked) {
		if (!saCheck()) return false;
		if (!zipCheck()) return false;
	}
	
	submit.style.display = "inline-block";
}
function loadCheck() {
	var na01 = document.getElementById('na01');
	var na02 = document.getElementById('na02');
	var r_addShip = document.getElementById('radio_addShip');
	
	if (r_addShip.checked) {
		na01.style.display = "flex";
		na02.style.display = "flex";
	}else{
		na01.style.display = "none";
		na02.style.display = "none";
	}
	
	validate();
}