function hey(ven) {
	var loc = "updatePrintCount.php?vendor_ID="+ven;	
	alert("Count Has Been Printed");
	window.open(loc,"_self");
}

function checkCounter(ctr,ven) {
	if(ctr == "unassigned"){
		var cp = window.prompt("...and know this,\n you are taking responsibility for this count...\n Now, who be ye?");
		if(cp == null || cp == "") {
			alert("Count Not Printed!");
			window.history.back();
			return;
		}
		window.location.href = 'processCounter.php?cp='+cp+'&ven='+ven+'&branch=pc';
	}
}