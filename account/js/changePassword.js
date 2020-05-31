// validate newaccount.php

function validate(){
	var op = document.getElementById('oldPW');
	var np = document.getElementById('newPW');
	var rp = document.getElementById('rePW');
	var sb = document.getElementById('savBut');

	var valOP = op.value;
	var valNP = np.value;
	var valRP =	rp.value;
	
	if (valOP.length < 3) {
		sb.disabled = true;
		return;
	}
	if (valNP.length < 3) {
		sb.disabled = true;
		return;
	}
	if (valRP.length < 3) {
		sb.disabled = true;
		return;
	}	
	if (valNP != valRP) {
		sb.disabled = true;
		return;
	}	
	
	sb.disabled = false;
	return;
}