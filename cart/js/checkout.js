function promo(){
	cardCode = document.getElementById('cardCode').value;
	shipTot = document.getElementById('shipTot').innerHTML;
	giftCardNum = document.getElementById('giftCardNum').innerHTML;
	promoCode = document.getElementById('promoCode').innerHTML;
	var win = window.pageYOffset;

	if (shipTot.length < 2) shipTot = 0;
	
	if (cardCode.length == 16) {
		giftCardNum = cardCode;
	}else {
		promoCode = cardCode;
	}
	window.location.replace('checkout.php?code='+promoCode+'&card='+giftCardNum+'&shipping='+shipTot+'&w='+win)
}

function shipCalc(shipping, z) {

	var card = document.getElementById('giftCardNum').innerHTML;
	var code = document.getElementById('promoCode').innerHTML;
	var win = window.pageYOffset;
	
	if (!card && !code) {
		window.location.replace('checkout.php?shipping='+shipping+'&w='+win+'&z='+z);
		return;
	}
	if (!card) {
		window.location.replace('checkout.php?code='+code+'&shipping='+shipping+'&w='+win+'&z='+z);
		return;
	}
	if (!code) {	
		window.location.replace('checkout.php?&card='+card+'&shipping='+shipping+'&w='+win+'&z='+z);
		return;
	}
	window.location.replace('checkout.php?code='+code+'&card='+card+'&shipping='+shipping+'&w='+win+'&z='+z);
	return;
}

function checkForm(x) {

	// Variables
	var confirmationButton = document.getElementById('confirmationButton');	
	var hold = document.getElementById('hold');
	var bill = document.getElementById('bill');	
	var card = document.getElementById('giftCardNum').innerHTML;
	var code = document.getElementById('promoCode').innerHTML;
	
	// both Checkout switches must be true to submit
 	var pay = false;
 	var ship = false;
 	
 	// validate shipping
	if (hold.checked) ship = true; 	
	if (bill.checked) ship = true;
	if (!hold.checked && !bill.checked) ship = true;
	
	// validate payment
	
 	if (pay && ship) {
 		confirmationButton.style.display = 'inline-block';
 	}else {
 		confirmationButton.style.display = 'none';
 	}
 	//alert(pay+' - '+ship);
 	return;
}

function sendForm() {
	document.getElementById("checkout").submit();
}