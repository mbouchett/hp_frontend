function setFocus(){
     document.getElementById("theSku").focus();
}
function price(){
     x=document.getElementById("cost").value;
     y=document.getElementById("multi").value;
     z=x*y;document.getElementById("retail").value=z;
}
function pop_clear(){
  document.getElementById("pop").style.visibility  = "hidden";
  document.getElementById("pop2").style.visibility  = "hidden";
  document.getElementById("popHist").style.visibility  = "hidden";
  document.getElementById("screen").style.visibility = "hidden";
}

function pop(recno){
  var doc_width = document.documentElement.clientWidth;
  doc_width = doc_width/2-300;
  document.getElementById("pop").style.left = doc_width+"px";
  document.getElementById("pop").style.top = "100px";
  document.getElementById("pop").style.visibility  = "visible";
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("recspan").innerHTML  = "Record# "+ recno.toString();
  document.getElementById("record").value  = recno;
}
function pop2(recno, i){
  var ih=document.getElementsByClassName("details")[i+1].getAttribute("title");
  var doc_width = document.documentElement.clientWidth;
  var thePop = document.getElementById("pop2");
  doc_width = doc_width/2-300;
  thePop.style.left = doc_width+"px";
  thePop.style.top = "100px";
  thePop.style.visibility  = "visible";
  document.getElementById("theDet").innerHTML = ih;
  document.getElementById("screen").style.visibility  = "visible";
  document.getElementById("recspan2").innerHTML  = "Record# "+ recno.toString();
  document.getElementById("record2").value  = recno;
}
function popHist(recno,qty,h1,h2,h3,h4,h5,h6,h7,h8) {
	var doc_width = document.documentElement.clientWidth;
	var thePop = document.getElementById("popHist");
	doc_width = doc_width/2;
	var dLeft = doc_width/2-150;
	var hq = document.getElementById('hq');
	var vh1 = document.getElementById('h1');
	var vh2 = document.getElementById('h2');
	var vh3 = document.getElementById('h3');
	var vh4 = document.getElementById('h4');
	var vh5 = document.getElementById('h5');
	var vh6 = document.getElementById('h6');
	var vh7 = document.getElementById('h7');
	var vh8 = document.getElementById('h8');
	var hist = document.getElementById('hist');
	
	thePop.style.left = dLeft+"px";
   thePop.style.top = "100px";
   thePop.style.width = doc_width+"px";
   thePop.style.visibility  = "visible";
	document.getElementById("screen").style.visibility  = "visible";
	
	hist.value = recno;
	hq.value = qty;
	vh1.value = h1;
	vh2.value = h2;
	vh3.value = h3;
	vh4.value = h4;
	vh5.value = h5;
	vh6.value = h6;
	vh7.value = h7;
	vh8.value = h8;
}
function checkSku(){
    var sku = document.getElementById('theSku');
    var inputs = document.getElementsByTagName('input');
    for(var i=0; i<inputs.length; i++){
        if(inputs[i].name.slice(0,3) == "sku"){
            inputs[i].style.backgroundColor = "#FFFFFF";
            if(inputs[i].value == sku.value.toUpperCase()){
                alert("This SKU is already In Use");
                inputs[i].style.backgroundColor = "#FF99CC";
                sku.value = "";
                inputs[i].focus();
            }
        }
    }
}
function catPop(){
  var divSelect = document.getElementById('departments');
  var pack = document.getElementById('pack');
  divSelect.style.visibility = "visible";
}
function catUnPop(){
  var divSelect = document.getElementById('departments');
  setTimeout(function(){divSelect.style.visibility = "hidden";pack.focus();},500);;
}
function putCat(cat){
 var divSelect = document.getElementById('deptAdd');
 divSelect.value = cat;
}
function retailCalc(obj, e){
	var costField = obj;
	var costName = costField.name;
	var nodes = document.getElementsByTagName("input");
	var multi = document.getElementById("multi").value;
	var nodeCount = nodes.length;
	var retailName = "";
	for(var i=0; i < nodeCount; i++){
		retailName = nodes[i].name;
		if(retailName == costName){
			var sourceNode = i;
			var targetNode = i+1;
			break;
		}
	}
	var cost = nodes[sourceNode].value;
	var retail = cost * multi;
	nodes[targetNode].value = retail.toFixed(2);
    return false;
}
// this function submits the form to delete the current vendor
// it is only available if there  are no items associated with the vendor
function deleteVendor(v){

    // display and get the confirmation
    var confrimed = confirm("Delete this vendor?\nThis action is not reversable!");

    // if confirmed submit the form
    if(confrimed){
		window.location = "processVendorDelete.php?vendor_ID=" + v;
		return false;

    }
}
function visvend(){	
	var vnd = document.getElementsByClassName("vnd");
	var nodeCount = vnd.length;
	for(var i=0; i < nodeCount; i++){
		vnd[i].style.display = "inline";
	}
}