// This function clears all of the input fields
function clearEntries(){
	var ohNodes = document.getElementsByClassName('oh');
	var oqNodes = document.getElementsByClassName('oq');
	var nodeCount = ohNodes.length;

    for(var i=0; i < nodeCount; i++){
    	ohNodes[i].value = "";
    	oqNodes[i].value = "";
    }
    ohNodes[0].focus();
    return false;
}

function focus(){
	var nodes = document.getElementsByTagName('input');
	nodes[1].focus();
}

function ohCatch(e,nd) {
	 var mynodes = document.getElementsByTagName('input');
    if (e.keyCode == 13) {
    	  mynodes[nd+1].value = "";
        mynodes[nd+1].focus();
        return false;
    }
}

function oqCatch(e,nd) {
	 var mynodes = document.getElementsByTagName('input');
	 var ndCount = mynodes.length;
    if (e.keyCode == 13) {
    	if ((nd+2) == ndCount) { 
			return true;	    		
    	}
    	  mynodes[nd+2].value = "";
        mynodes[nd+2].focus();
        return false;
    }
}

function areYouSure() {
	var x = confirm("Are you sure\nyou want to\nprocess the order?");
	if (x){
		return true;
	}else {
		return false;
	}
}