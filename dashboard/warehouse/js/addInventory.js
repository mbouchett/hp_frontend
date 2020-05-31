function processForm(){
	var qty = document.getElementById('qty');
	var desc = document.getElementById('desc');
	var submit = 1;
	if (!qty.value){
		 qty.style.backgroundColor = "pink";
		 submit = 0;
	}
	if (!desc.value){
		desc.style.backgroundColor = "pink";
		submit = 0;
	}
	if (submit == 1) {
		document.getElementById("addInv").submit();
	}else {
		return false;
	}
}