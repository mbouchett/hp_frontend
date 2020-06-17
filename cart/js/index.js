function submit() {
	document.getElementById("pmwi").submit(); 
}

function checkKey(e, index) {
	var field = document.getElementsByClassName('qty');
	var qty = field[index].value;
	var x = e.keyCode;
	if (e.key == "Enter" && qty > 0) {
		document.getElementById("pmwi").submit();
	}
	
	if (x < 48) field[index].value = "";
	if (x > 105) field[index].value = "";
	if (x > 57 && x < 96) field[index].value = "";
}
function cookieCheck() {
	if (navigator.cookieEnabled) return true;

	// set and read cookie
	alert("Our Shopping Cart Requires Cookies to be enabled,\n
	Otherwise items will not transfer to checkout");
	return ret;
}