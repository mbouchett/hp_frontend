// validate newaccount.php

function checkForm(e) {
	e.preventDefault();
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	var pw = document.getElementById('pw').value;
	var pwv = document.getElementById('pwv').value;
	if (!validateEmail(email)) {
		alert("Invalid Email");
		return false;
	}
	if(pw != pwv) {
		alert("Passwords Do Not Match");
		return false;
	}
	if (!email || !pw || !pwv || !fname || !lname) {
		alert("All Feilds Are Required");
		return false;
	}
	document.getElementById("newaccount").submit();
}


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}