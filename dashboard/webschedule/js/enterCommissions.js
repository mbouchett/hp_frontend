//enterCommissions.js

function validate(){
	var nme = document.getElementById('name');
	var des = document.getElementById('desc');
	var amt = document.getElementById('amt');
	var tra = document.getElementById('trans');
	var sub = document.getElementById('submit');
	
	sub.disabled = false;
	if (nme.value.length < 4) sub.disabled = true;
	if (des.value.length < 4) sub.disabled = true;
	if (amt.value.length < 4) sub.disabled = true;
	if (tra.value.length < 4) sub.disabled = true;
	return;
}

function deleteCom(com_ID, cname, amt, trans) {

	if (confirm('Are You Sure you\'re Sure\n' + cname + ': ' + amt + ' -> ' + trans)) {
		window.location.replace('processDeleteCommission.php?com_ID='+com_ID);	
	}
	return;
}