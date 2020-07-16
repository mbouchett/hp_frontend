// This script captures the enter key in the On-Hand field and moves the focus to the Order field
function changeStat(po, stat){
	x = parseInt(stat);
	x = x + 1;
	if (x > 5) { 
		x = 1;
	 }
	window.location.href = "processClosePo.php?po=" + po + "&stat=" + x;	
}