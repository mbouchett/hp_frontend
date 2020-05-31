





function checkForm(e) {
	e.preventDefault();
	// Payment Variables
	var ccNum = document.getElementById("cardNum");
	var newCardNum = document.getElementById('newCardNum'); 
	var newCardMonth = document.getElementById('newCardMonth'); 
	var newCardYear = document.getElementById('newCardYear');
	var newCardCVV2 = document.getElementById('newCardCVV2');  
	var newCardLine1 = document.getElementById('newCardLine1');  
	var newCardZip = document.getElementById('newCardZip');	

	// Shipping Variables
	var hfp = document.getElementById('hold');
	var sba = document.getElementById('bill');
	var sna = document.getElementById('newShip');
	var naLine1 = document.getElementById('naLine1');
	var naZip = document.getElementById('naZip');

	// both Checkout switches must be true to submit
 	var pay = true;
 	var ship = true;
 	var cc = true;

	
 	// Check That Payment option Is selected and filled
 	if (nc.checked == true) {
 		
 		if(ccValid(newCardNum.value)) {
 			ccNum.style.backgroundColor = "rgba(50,255,130,1.00)"
 		}else {
  			pay = false;
 			cc = false;
 			ccNum.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}
 		
 		if(month.value.length < 1) {
 			pay = false;
 			cc = false;
 			month.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			month.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 		/*
 		if(year.value.length < 4) {
 			pay = false;
 			cc = false;
 			year.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			year.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 		
 		if(cvv.value.length < 3) {
 			pay = false;
 			cc = false;
 			cvv.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			cvv.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 		
 		if(line1.value.length < 5) {
 			pay = false;
 			cc = false;
 			line1.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			line1.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 		
 		if(zip.value.length < 5) {
 			pay = false;
 			cc = false;
 			zip.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			zip.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}*/
 	}
	
 	// Check That Ship option Is selected and filled 
 	if (hfp.checked == true) {
 		ship = true;
 	}
 	if (sba.checked == true && cc == true) {
 		ship = true;
 	}
 	if (sna.checked == true) {
 		ship = true;
 		if (naLine1.value.length < 5) {
 			ship = false;
 			naLine1.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			naLine1.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 		
 		if(naZip.value.length < 5) {
 			ship = false;
 			naZip.style.backgroundColor = "rgba(249,143,143,1.00)";
 		}else {
 			naZip.style.backgroundColor = "rgba(229,229,229,1.00)";
 		}
 	}
	alert(pay+' - '+ship);
	if (pay && ship) {
		document.getElementById('checkout').submit();
		return;
	}	
	return;
}