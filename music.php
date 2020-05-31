<?php
//includes
include "/home/homeportonline/crc/2018.php";

date_default_timezone_set('America/New_York');
$artist = stripcslashes($artist);
$album = stripcslashes($album);
$song = stripcslashes($song);

$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    $sql = 'SELECT * FROM `music` ORDER BY `recno` DESC' ;               //Create The Search Query
    $result = mysqli_query($db, $sql);          //Initiate The Query
    $songCount=mysqli_num_rows($result);        //Count The Query Matches
    mysqli_close($db);                          //Close The Connection
//Store the Results To A Local Array
    for($i=0; $i<$songCount; $i++){             //Iniate The Loop
        $songs[$i]= mysqli_fetch_assoc($result);    //Fetch The Current Record
    }

if($songCount > 150){
    //Delete a record
    $db= new mysqli('localhost', $db_user, $db_pw, $db_db);
    for($i = 150; $i < $songCount; $i++){
        //perform the delete
        $sql = "DELETE FROM `music` WHERE `recno` = '".$songs[$i]['recno']."';";
        $result = mysqli_query($db, $sql); // create the query object
    }
    mysqli_close($db); //close the connection
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
  <meta http-equiv="refresh" content="30">
  <link rel="SHORTCUT ICON" href="images/music.ICO">
  <title>What's Playing At Homeport</title>
  <style>
		td {
			border-style: solid;
			border-color: black;
			border-width: 1px;		
		}  
  </style>
</head>

<body>

<div class="centercontent">
<b>Now Playing At Homeport</b><br>
ARTIST: <?= $songs[0]['artist'] ?><br>
ALBUM: <?= $songs[0]['album'] ?><br>
SONG: <?= $songs[0]['song'] ?><br>
<br />
<table class="list" >
<tr class="nowheader"><td>ARTIST</td><td>ALBUM</td><td>SONG</td><td>TIME</td></tr>
<?php for($i=1; $i<149; $i++){ ?>
<tr><td><?= $songs[$i]['artist'] ?></td><td><?= $songs[$i]['album'] ?></td><td><?= $songs[$i]['song'] ?></td><td><?= $songs[$i]['date'] ?></td></tr>
<?php } ?>
</table>
</div>

</body>

</html>