<link rel="stylesheet" href="../css/deptOverlay.css" type="text/css" />
<script>
    /* Open when someone clicks on the span element */
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
</script>

<?php
	//Load Categories for banner
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = 'SELECT * FROM `main_cats` LIMIT 8';
	$result = mysqli_query($db, $sql);
	$catCount = mysqli_num_rows($result);
	mysqli_close($db);
	for($i=0; $i<$catCount; $i++){
		$cat[$i] = mysqli_fetch_assoc($result);
	}
?>
        <div id="myNav" class="overlay">
          <!-- Button to close the overlay navigation -->
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="../departments.php"><img src="../images/compass.png" alt="Homeport Logo">
          <!-- Overlay content -->
            <span class="depttitle">Departments</span></a>
          <div class="overlay-content">
          <?php for($i = 0; $i < $catCount; $i++) { ?>
            <a class="deptbtn" href="../departments.php?selectedDept=<?= $cat[$i]['main_ID'] ?>&keyName=<?= $cat[$i]['main_name'] ?>"><?= $cat[$i]['main_name'] ?></a>
          <?php } ?> 
          <a class="deptbtn" href="../departments.php">See All...</a> 
          </div>
        </div>