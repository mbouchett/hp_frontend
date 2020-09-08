<?php
@include "/home/homeportonline/crc/2018.php";

// get Signatures
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql  = 'SELECT *  FROM `petition_behave`';
$result = mysqli_query($db, $sql);
$sigCount = mysqli_num_rows($result);

for($i=0; $i<$sigCount; $i++){
	$sig[$i] = mysqli_fetch_assoc($result);
}		
mysqli_close($db);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Letter regarding public behavior</title>
</head>
<body>

To The Senators of Chittenden County,<br><br>
 
	We are writing to you to express a growing concern regarding safety and civility on our public streets in Burlington. <br>
	The issues of public intoxication, open drug use, public urination and defecation, public sex acts, aggressive and harassing behavior, <br>
	commandeering and blocking public thoroughfares, and sleeping or camping in both private and public spaces have always been with us. <br>
	Furthermore, community spaces like The Church Street Marketplace have always been especially attractive to people who demonstrate <br>
	these sorts of behaviors but sadly incidences like these have risen to an intolerable level.<br><br>

	The remedies available to the community for curbing these sorts of activities have been limited to misdemeanor citations and <br>
	nominal fines. This approach has always been ineffective and remains so. Some of us have actually witnessed a citation ripped to pieces <br>
	and thrown in the air in the face of the officer who issued it. The fact is that there are no meaningful consequences for anti-social <br>
	or criminal behavior for those engaged in these activities.<br><br>
		
	We want to be clear that we are not concerned with a class of individuals here or any individual for that matter. What we are concerned <br>
	about is how people behave in shared and public places. We respect the rights of all kinds of people to utilize and enjoy these spaces <br>
	in a respectful manner; however, we also believe that our staffs, which are composed largely of young women, have a right to walk to and from <br>
	their jobs in safety and unharassed. We don’t think that citizens and visitors to our town, who often come <br>
	with their children, ought be subject to aggressive behavior or witness to people’s private bodily functions. <br><br>

	To this end what we are asking for is a point at which a number of misdemeanor citations might be elevated to a criminal citation <br>
	that cannot be ignored in the way these lesser deterrents have been. We know this is how many other states handle these matters and <br>
	they are much better deterrents to aggressive anti-social behaviors. Allowing this to continue is bad for the residents, bad for the <br>
	workforce, and ultimately harmful to even those engaged in such behavior.<br><br>

	Thank you for considering this.<br><br>
	<?php for($i=0; $i<$sigCount; $i++){ ?>
	&nbsp;&nbsp;&nbsp;<?= $sig[$i]['pb_sig'] ?>, 

	<?php if(($i+1) % 4 == 0){echo "<br>";}	} ?>
<br><br>
This letter was sent to: State senators:<br>
<table >
<tr><td>Senator Tim Ashe</td><td>Chittenden District</td><td>Democrat/Progressive</td></tr>
<tr><td></td><td>Chittenden District</td><td>Democrat/Progressive</td></tr>
<tr><td></td><td>Chittenden District</td><td>Democrat</td></tr>
<tr><td></td><td>Chittenden District</td><td>Democrat</td></tr>
<tr><td></td><td>Chittenden District</td><td>Democrat/Progressive</td></tr>
<tr><td></td><td>Chittenden District</td><td>Democrat</td></tr>
</table>
<br><br>

<form method="post" action="processSignLetter.php">
	<input title="(<?= $sigCount ?>) signatures so far" type="text" name="name" placeholder="fullname and business if applicable" disabled> <input type="submit" value="Sign Form" disabled>
</form>

</body>
</html>