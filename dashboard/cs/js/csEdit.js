function iDate(obj, today){
	if (obj.value != "") {
		return;
	}
	obj.value = today;
}

function popMail(c){
	var newwindow;
	newwindow=window.open('popMail.php?cust_ID='+c,'name','height=300,width=500');
	if (window.focus) {newwindow.focus()}
}
function pop_clear(){
  document.getElementById("pop").style.visibility  = "hidden";
  document.getElementById("pop2").style.visibility  = "hidden";
  document.getElementById("screen").style.visibility  = "hidden";
}
function pop(){
  var doc_width = document.documentElement.clientWidth;
  doc_width = doc_width/2-300;
  document.getElementById("pop").style.left = doc_width+"px";
  document.getElementById("pop").style.top = "100px";
  document.getElementById("pop").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
}
function pop2(){
  var doc_width = document.documentElement.clientWidth;
  doc_width = doc_width/2-300;
  document.getElementById("pop2").style.left = doc_width+"px";
  document.getElementById("pop2").style.top = "100px";
  document.getElementById("pop2").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
}
function zerobal(mc){
   if(mc > 0){
   document.getElementById("mcbut").style.backgroundColor  = "#CCCC66";
   }
}

function prt(){
     var printContents = document.getElementById("prtstuff").innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
function laypop(layaway_ID){
      var laywin = window.open('layaway.php?layaway_ID='+layaway_ID,'popUpWindow','height=450,width=600,left=150,top=150,resizable=yes,scrollbars=no,menubar=no,directories=no,status=yes')
      laywin.focus();
}
function delmc(mc_ID, amount, cust_ID){
    if(confirm('Are you for real about deleting this :' + amount)){

        window.open('processDelMc.php?mc_ID='+mc_ID+'&cust_ID='+cust_ID, "_self");
    }
}
function pickup(x){
	window.open('whPickup.php?ci_ID=' + x, "_self");
	return false;
}
