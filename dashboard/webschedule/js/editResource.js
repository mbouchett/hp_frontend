function loadPage(){
    document.getElementById("checkNode").checked = false;
    hide();
}
// This function hides the money fields
function hide(){
    var	myNodes = document.getElementsByTagName("td");
    var checkNode = document.getElementById("checkNode");

    var nodeCount = myNodes.length;

    for(var i=0; i < nodeCount; i++){
        if(myNodes[i].className == "hide"){
            if(checkNode.checked) {
                /*myNodes[i].style.border-collapse = "separate";
                myNodes[i].style.display = "inline-block";*/
                myNodes[i].style.display = "table-cell";
            } else {

                myNodes[i].style.display = "none";

            }
        }
    }
    return false;
}