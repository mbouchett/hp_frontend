// editAddress.js

function validate() {
	var line1 = document.getElementById('line1');
	var zip = document.getElementById('zip');
	zip.style.backgroundColor = 'white';
	line1.style.backgroundColor = 'white';
	if (line1.value.length < 5){
		line1.style.backgroundColor = 'pink';
		return false;
	} 
	if (zip.value.length < 5){
		zip.style.backgroundColor = 'pink';
		return false;
	}

	document.getElementById('form').submit();

}