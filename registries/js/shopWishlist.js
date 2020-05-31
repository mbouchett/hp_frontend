//shopWishlist.js

function contribute(item, wish, idx, wcust) {
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
	
	window.location.href = '../cart/processAddToCart.php?item=' + item + '&amt=' + amt + '&wish=' + wish + '&wcust=' + wcust;
}

function addToCart(item, wish, idx, wcust) {
	var qty = document.getElementsByName('qty');
	window.location.href = '../cart/processAddToCart.php?item=' + item + '&qty=' + qty[idx].value + '&wish=' + wish + '&wcust=' + wcust;
}