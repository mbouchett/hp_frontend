function addPunch(datePart) //make the add punch window visible
{
    document.getElementById('addP').style.visibility = "visible";
    document.getElementById('dateTitle').innerHTML = datePart;
    document.getElementById('hideDate').value = datePart;
    document.getElementById('addTime').focus();

    return;
}

function closeAddP() //close the add punch window
{
    document.getElementById('addP').style.visibility = "hidden";
}

function addLunch(card, ppPrev)
{
   var datePart = document.getElementById('dateTitle').innerHTML;
   window.location.href = 'processAddLunch.php?card=' + card + '&ppPrev=' + ppPrev + '&date=' + datePart;
}
function fixTime(obj, event, card, ppPrev, recno)
{
    var char = event.keyCode;
    var theTime = obj.value;
    if (char==13)
    {
       //alert(theTime + '-' + card + '-' + ppPrev + '-' + recno + '-' + theDate);
       window.location.href = 'processFixTime.php?card=' + card + '&ppPrev=' + ppPrev + '&recno=' + recno + '&time=' + theTime;
    }
}

function addDay(theDay, card, ppPrev)
{
    //alert(theDay + " - " + card);
    window.location.href = 'processAddDay.php?card=' + card + '&ppPrev=' + ppPrev + '&theDay=' + theDay;
}