// This script captures the enter key in the On-Hand field and moves the focus to the Order field
function changeStat(po, stat){
	var yn = false;
	if (stat == "Received") {
		yn = confirm("Are you sure you want to close " + po);
		if(yn){
			window.location.href = "processClosePo.php?po=" + po + "&stat=5";		
		}
	}
	
	if (stat == "Closed") {
		yn = confirm("Are you sure you want to Re-Open " + po);
		if(yn){
			window.location.href = "processClosePo.php?po=" + po + "&stat=4";		
		}		
	}
	
}