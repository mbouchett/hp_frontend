<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Homeport Shelf Talkers</title>
  <link rel="stylesheet" type="text/css" href="../style/shelf001.css" />
</head>

<body>
<div id="wrapper">
<?php for($i=0; $i<10; $i++){ ?>
    <div class="row">
      <div class="cell">
        <input class="line1" name="line1" placeholder="line 1" /><br />
        <input class="line" name="line2" placeholder="line 2" /><br />
        <input class="line" name="price" placeholder="line 3" /><br />
      </div>
      <div class="cell">
        <input class="line1" name="line1" placeholder="line 1" /><br />
        <input class="line" name="line2" placeholder="line 2" /><br />
        <input class="line" name="price" placeholder="line 3" /><br />
      </div>
    </div>
<?php }?>
</div>
</body>

</html>