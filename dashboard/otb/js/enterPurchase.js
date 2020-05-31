// enterPurchase.js

function deletePurch(otb_ID,floor){
	if (confirm("Are you sure, your sure, your sure???")) {
    	window.location = "processDeletePurchase.php?otb_ID="+otb_ID+"&floor="+floor;
    }
    return;
}