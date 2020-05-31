// This function Increments/Decrements the hours
function hourBlur(obj)
{
   var inField = obj;
   var x = Number(inField.value);
   inField.style.backgroundColor = "White";

   if(isNaN(x))
   {
        x="";
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
   }
   if(x > 12)
   {
        x=12;
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
   }
   if(x < 1)
   {
        x=1;
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
   }
   return;
}
// This function Increments/Decrements the Minutes
function minBlur(obj)
{
   var inField = obj;
   var x = Number(inField.value);
   inField.style.backgroundColor = "White";

   if(isNaN(x))
   {
        x="00";
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
   }
   if(x > 59)
   {
        x=59;
        inField.style.backgroundColor = "Red";
   }
   if(x < 0)
   {
        x=0;
        inField.style.backgroundColor = "Red";
   }
   var min = String(x);
   if(min.length < 2) min = "0" + min;
   inField.value = min;
   return;
}

//  This function Toggles am/pm
function apBlur(obj)
{
   var inField = obj;
   var x = inField.value;
   inField.style.backgroundColor = "White";

   if(x != "am" && x != "pm")
   {
        x = "am";
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
   }
   return;
}

//  This function Verifies year input
function yearBlur(obj)
{
   var inField = obj;
   var x = Number(inField.value);
   inField.style.backgroundColor = "White";

   if(isNaN(x))
   {
        x="2015";
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
        return;
   }
   if(x < 2015 || x > 2099)
   {
        x = 2015;
        inField.value = String(x);
        inField.style.backgroundColor = "Red";
        return;
   }
   return;
}

//  This function Verifies month input
function monthBlur(obj)
{
   var inField = obj;
   var x = Number(inField.value);
   inField.style.backgroundColor = "White";

   if(isNaN(x))
   {
        inField.value = "01";
        inField.style.backgroundColor = "Red";
        return;
   }
   if(x < 1 || x > 12)
   {
        inField.value = "01";
        inField.style.backgroundColor = "Red";
        return;
   }

   var min = String(x);
   if(min.length < 2) min = "0" + min;
   inField.value = min;
   return;
}
//  This function Verifies day input
function dayBlur(obj)
{
   var inField = obj;
   var x = Number(inField.value);

   var mon = document.getElementById('month');
   var monthVal = Number(mon.value);

   var year = document.getElementById('year');
   var yearVal = Number(year.value);

   var maxDays = 31;

   inField.style.backgroundColor = "White";

   // Figure out how many days in this month
   switch (monthVal)
{
   case 4,6,9,11:
       maxDays = 30;
       break;
   case 2:
       maxDays = 28;
       if(yearVal % 4 == 0) maxDays = 29;
       break;
   default:
       maxDays = 31;
       break;
}

   if(isNaN(x))
   {
        inField.value = "01";
        inField.style.backgroundColor = "Red";
        return;
   }

   if(x < 1 || x > maxDays)
   {
        inField.value = "01";
        inField.style.backgroundColor = "Red";
        return;
   }

   var min = String(x);
   if(min.length < 2) min = "0" + min;
   inField.value = min;
   return;
}