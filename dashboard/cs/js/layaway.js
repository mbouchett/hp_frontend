function pop_clear()
{
  document.getElementById("addLayPay").style.visibility  = "hidden";
  document.getElementById("addLayItem").style.visibility  = "hidden";
  document.getElementById("screen").style.visibility  = "hidden";
}
function popAdd()
{
  //var doc_width = document.documentElement.clientWidth;
  //doc_width = doc_width/2-300;
  //document.getElementById("pop").style.left = doc_width+"px";
  //document.getElementById("pop").style.top = "100px";
  document.getElementById("addLayItem").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("laydep").focus();
}
function popPay()
{
  //var doc_width = document.documentElement.clientWidth;
  //doc_width = doc_width/2-300;
  //document.getElementById("pop").style.left = doc_width+"px";
  //document.getElementById("pop").style.top = "100px";
  document.getElementById("addLayPay").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("paytrans").focus();
}
function ringIn()
{
  var amt = document.getElementById("pay_amount").value;
  var x = amt/1.07;
  var y = x.toFixed(2);
  document.getElementById("ring").innerHTML = "Pre-Tax: " + y.toString() ;
}