<?php
$oldName=$_POST['oldName'];
$newName=$_POST['newName'];
unset($aChange);

$listCount=count($oldName);

for($i=0; $i<$listCount; $i++){
  if($newName[$i]){
    //perform re-name
    rename("data/schedules/$oldName[$i]", "data/schedules/$newName[$i]");
    $aChange=1;
  }
}
if(!$aChange){
    header('Location: renameSchedule.php?message=Nothing Entered Nothing Changed!&messColor=FF0066&messSize=24' );
    die;
}
    header('Location: renameSchedule.php?message=Your Changes Were So Saved -- 2 Thumbs Up!&messColor=009900&messSize=20' );
    die;
?>