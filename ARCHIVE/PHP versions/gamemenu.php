<!--<?php

    // connect to DB
    require("common.php");

    // Check whether user is logged in
    if(empty($_SESSION['user']))
    {
        // If they are not, redirect to the login page.
        header("Location: login.php");

        // this statement is needed
        die("Redirecting to login.php");
    }

?>
Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?> Logged in<br />
<a href="logout.php">Logout</a>-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="jquery-2.1.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>
      Maths Mash
    </title>
  </head>
  <body>

    <div class="page">
	
		<div>
			<a href="snap.php">
				<img class="gameicons" src="images/Snap.png" alt="SNAP" >
			</a>
		</div>
		
		<div>
			<a href="sequence.php">
				<img class="gameicons" src="images/Sequence.png" alt="SEQUENCE">
			</a>
		</div>
		
		<div>
			<a href="operator.php">
				<img class="gameicons" src="images/Operators.png" alt="OPERATOR" >
			</a>
		</div>
		
		<div>
			<a href="higherLower.php">
				<img class="gameicons" src="images/HigherLower.png" alt="HIGHER OR LOWER">
			</a>
		</div>
		
		<br>
		
	  <a href="mainmenu.php">
          <img src="images/HomeButton.jpg" alt="HIGHER OR LOWER" style="width:50px;height:50px;border:0">
        </a>
      <br>
    </div>
  </body>
</html>