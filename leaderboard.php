<?php
/*
* leaderboard.php *
* Rev 1 *
* 18/04/2015 *
*
* @author Eoin Sutton, Conor Prunty, David Byrne, Ciaran Byrne, Kevin Clarke *
*/ 

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
    else
    {
     //get score from DB for leaderboard
       $query = " 
            SELECT 
                id,
                username, 
                score, level
            FROM users
            ORDER BY score DESC;
        "; 
         
        /*// parameter
        $query_params = array( 
            ':username' => $_SESSION['user']['username']
        );*/
         
        try 
        { 
            // run query
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
                $row = $stmt->fetch(); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
            
    } 
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="js/profile.js" type="text/javascript"></script>
    <script type="text/javascript">
var myscore = <?php echo $row["score"];?>;
    var levelNew = <?php echo $row["level"];?>;
    </script>
	<script src="js/commonJS.js" type="text/javascript"></script>

    <title>Leaderboard</title>
</head>

<body onload="setIcon()">
    <div class="page">
        <header>
            <div id="icon"></div>

            <p id="lvlnum" style="padding-top:11px; !important">Level: <?php echo $row["level"];?></p><a href=
            "logout.php" id="logout"><img src="images/logout_icon.png" style=
            "width:50px;height:50px;border:0"></a>
        </header>

        <div class="content">
            <div class="ldrbrd" style="text-align: center">
                <br>

                <h1>Leaderboard</h1><br>
                <br>
                <?php 
                            if($row)
                            {
                                echo "<table><tr><th>Pos.</th><th>Name</th><th>Score</th><th>Level</th></tr>";
                                $count = 1;
                                // output data of first row
                                echo "<tr><td>" . $count. "</td><td>" . $row["username"]. "</td><td> " . $row["score"]. "</td><td>" . $row["level"]. "</td></tr>";
                                // output data of next rows
                                while($row = $stmt->fetch()) {
                                    $count++;
                                    echo "<tr><td>" . $count. "</td><td>" . $row["username"]. "</td><td> " . $row["score"]. "</td><td>" . $row["level"]. "</td></tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "0 results";
                            }
                        
                        ?>
            </div><br>

            <div style="text-align: center">
                <a href="mainmenu.php"><img src="images/home_button.png" style=
                "width:50px;height:50px;border:0"></a>
				<img onclick="back()" src="images/backButton.png" style= 
			"width:50px;height:50px;border:0"></img>
            </div>
        </div>
    </div>
</body>
</html>