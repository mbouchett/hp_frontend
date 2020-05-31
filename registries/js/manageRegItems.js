function copy() {
  /* Get the text field */
  var text = document.getElementById("regAddr");
  text.style.visibility = "visible";

  /* Select the text field */
  text.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  text.style.visibility = "hidden"; 

  /* Alert the copied text */
  alert("Copied the link: " + text.value);
  
	window.scrollTo(0, 0);  
  
  return;
}

function submit() {
	document.getElementById("pmwi").submit(); 
}

function checkKey(e) {
	if (e == "Enter") {
		document.getElementById("pmwi").submit();
	}
}