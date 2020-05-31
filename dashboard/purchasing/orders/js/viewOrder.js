function exit(){
	window.location = "sentOrders.php";
	return false;
}
function checkIn(x){
	window.location = "printCheckin.php?order_ID=" + x;
	return false;
}
function faxed(x){
	window.location = "faxedOrder.php?order_ID=" + x;
	return false;
}
function bo(x){
	window.location = "printBackOrder.php?order_ID=" + x;
	return false;
}
function receiveAll() {
  var checkboxes = new Array(); 
  checkboxes = document.getElementsByTagName('input');
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox'){
    	if (checkboxes[i].checked == false){
      	checkboxes[i].checked = true;
      }else {
      	checkboxes[i].checked = false;
      }
    }
  }
}