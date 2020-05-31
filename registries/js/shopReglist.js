//shopReglist.js

function contribute(item, reg, idx, cust) {
	var pitchIn = document.getElementsByName('pitchIn');
	var bal = document.getElementsByName('bal');
	var bamt = bal[idx].value;
	var amt = pitchIn[idx].value;
	
	var a = Number(amt);
	var b = Number(bamt);
	
	if (isNaN(amt) || amt < 1) {
		pitchIn[idx].value = '';
		return;
	}
	
	if(a > b) amt = bamt;

	window.location.href = '../cart/processAddToCart.php?item=' + item + '&amt=' + amt + '&reg=' + reg+ '&cust=' + cust;
}

function addToCart(item, reg, idx, cust) {
	var qty = document.getElementsByName('qty');
	window.location.href = '../cart/processAddToCart.php?item=' + item + '&qty=' + qty[idx].value + '&reg=' + reg+ '&cust=' + cust;
}