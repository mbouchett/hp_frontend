// validate usrEditProfile.php


function checkForm(e) {
	e.preventDefault();
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var email = document.getElementById('email').value;
	if (!validateEmail(email)) {
		alert("Invalid Email");
		return false;
	}

	if (!email || !fname || !lname) {
		alert("All Feilds Are Required");
		return false;
	}
	document.getElementById("usrEditProfile").submit();
}


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}