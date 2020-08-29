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
 
	I am writing to you today to express a growing concern regarding safety and civility on our public streets in Burlington. <br>
	The issues of public intoxication, public urination and defecation, public sex acts, aggressive and harassing behavior, <br>
	commandeering and blocking public thoroughfares, sleeping and camping in both private and public spaces have always been with us. <br>
	Furthermore, community spaces like The Church Street Marketplace have always been especially attractive to people who demonstrate <br>
	these sorts of behaviors and incidence of these has risen to an intolerable level.<br><br>

	The remedies available to the community for curbing these sorts of activities have been limited to misdemeanor citations and <br>
	nominal fines. This approach has always been ineffective and remains so. I have personally witnessed a citation ripped to pieces <br>
	and thrown in the air in the face of the officer who issued it. The fact is that these efforts are completely inconsequential to <br>
	the people engaged in these activities.<br><br>
	
	I want to be clear that I am not concerned with a class of individuals here or any individual for that matter. What I am concerned <br>
	about is how people behave in shared and public places. I believe that my staff, which is composed largely of young women, have a <br>
	right to walk to and from their jobs in safety and unharassed. I don’t think that citizens and visitors to our town, who often come <br>
	with their children, ought be subject to aggressive behavior or witness to people’s private bodily functions. <br><br>

	To this end what I am asking for is a point at which a number of misdemeanor citations might be elevated to a criminal citation <br>
	that cannot be ignored in the way these lesser deterrents have been. <br><br>

	Thank you for considering this.<br><br>
	<?php for($i=0; $i<$sigCount; $i++){ ?>
	&nbsp;&nbsp;&nbsp;<?= $sig[$i]['pb_sig'] ?>,

	<?php if(($i+1) % 4 == 0){echo "<br>";}	} ?>
<br><br>
<form method="post" action="processSignLetter.php">
	<input type="text" name="name" placeholder="fullname and business if applicable"> <input type="submit" value="Sign Form">
</form>

</body>
</html>