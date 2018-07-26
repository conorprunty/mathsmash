<?php 
/*
* edit_account.php *
* Rev 1 *
* 18/04/2015 *
*
* @reference (PHP) http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html *
* @author (HTML) Eoin Sutton, Conor Prunty, David Byrne, Ciaran Byrne, Kevin Clarke *
*/ 
    // Get common DB connection
    require("common.php"); 
     
    // check if user logged in
    if(empty($_SESSION['user'])) 
    { 
        // if not go to login
        header("Location: index.php"); 
         
        // needed statement
        die("Redirecting to index.php"); 
    } 
	else
    {
        require("topMenu.php");
    } 
     
    // check if edit form submitted
    if(!empty($_POST)) 
    { 
        // ensure valid email address 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            echo '<script language="javascript">';
			echo 'alert("Invalid Email Address")';
			echo '</script>'; 
        } 
         
        // check if email entered is not already in DB
        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            // Define SQL query 
            $query = " 
                SELECT 
                    1 
                FROM users 
                WHERE 
                    email = :email 
            "; 
             
            // Define our query parameter values 
            $query_params = array( 
                ':email' => $_POST['email'] 
            ); 
             
            try 
            { 
                // run query
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("This E-Mail address is already in use"); 
            } 
        } 
         
        // If the user entered a new password, we need to hash it and generate a fresh salt 
        if(!empty($_POST['password'])) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $password = hash('sha256', $_POST['password'] . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 
            // If the user did not enter a new password we will not update their old one. 
            $password = null; 
            $salt = null; 
        } 
         
        // Initial query parameter values 
        $query_params = array( 
            ':email' => $_POST['email'], 
            ':user_id' => $_SESSION['user']['id'], 
        ); 
         
        // If the user is changing their password, then we need parameter values 
        // for the new password hash and salt too. 
        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
        } 
         
        // first half of query
        $query = " 
            UPDATE users 
            SET 
                email = :email 
        "; 
         
        // if user changing password, include the below
        if($password !== null) 
        { 
            $query .= " 
                , password = :password 
                , salt = :salt 
            "; 
        } 
         
        // finish query
        $query .= " 
            WHERE 
                id = :user_id 
        "; 
         
        try 
        { 
            // Run query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
       
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // update session info with new email
        $_SESSION['user']['email'] = $_POST['email']; 
         
        // redirect user to main menu
        header("Location: mainmenu.php"); 
         
        // must call die
        // die("Redirecting to mainmenu.php"); 
    } 
     
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
	<link href=
    "http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel=
    "stylesheet">
    <script type="text/javascript">
var actualUser = <?php echo json_encode(htmlentities($_SESSION['user']['username'])); ?>;
    </script>
    <script type="text/javascript">
var myscore = <?php echo $row["score"];?>;
    var levelNew = <?php echo $row["level"];?>;
    </script>
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src=
    "http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="jquery-2.1.1.min.js" type="text/javascript"></script>
    <link href="style.css" rel="stylesheet" type="text/css">
	<script src="js/commonJS.js" type="text/javascript"></script>
	<script src="js/profile.js" type="text/javascript"></script>

    <title>Edit Account</title>
</head>

<body onload="setIcon()">
    <div class="page">
        <header>
                <div id="icon"></div>

                <p id="lvlnum">Level: <?php echo $row["level"];?></p><a href=
                "logout.php" id="logout"><img src="images/logout_icon.png"
                style="width:50px;height:50px;border:0"></a>
            </header>

        <div class="content">
            <form action="edit_account.php" method="post">
                <div id="profileName">
                    <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
				
				<p>E-Mail Address:</p><input name="email" type="text" value=
                " <?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?> " <br>

                <p>Password:</p><input name="password" type="password" value=
                ""><br>

                <p style="font-style: italic">(leave blank if you do not want
                to change your password)</p>
                <!-- <input type="submit" value="Update Account" /> -->
                <input class="button" type="submit" value="Update">
            </form>
        </div>

			<footer>
				<a href="mainmenu.php"><img src="images/home_button.png" style=
				"width:50px;height:50px;border:0"></a>
				<img onclick="back()" src="images/backButton.png" style= 
				"width:50px;height:50px;border:0"></img>
			</footer>
    </div>
</body>
</html>