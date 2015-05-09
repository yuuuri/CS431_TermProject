<?php
	session_start();
	include 'define_class.php';
?>

<?php

	$accounttype = 'ADMIN_STAFF';
	//$firstvisit = true;
	
	
	if (isset($_SESSION["id"])) {
		$firstvisit = false;
	} else {
		$firstvisit = true;
	}
	
	/******* Error Checking from login page **********/
	
	if ($firstvisit)
	{
		$_SESSION["id"] = $_POST["a_id"];
		$admin_ID = $_SESSION["id"];
	
		
		if (!$admin_ID){
			$_SESSION['message3'] = "Please enter your Administrator ID";
			header("Location: index.php");	
		} elseif(strlen($admin_ID) < 9) {
			$_SESSION['message3'] = "SSN must be 9 digits";
			header("Location: index.php");
		} elseif(!is_numeric($admin_ID)) {
			$_SESSION['message3'] = "Please enter numeric";
			header("Location: index.php");
		} elseif(!checkCWID($admin_ID,$accounttype)) {	
			$_SESSION['message3'] = "ID entered not valid!";
			header("Location: index.php");
		}
		$admin_fname = getFname($admin_ID, $accounttype);
		$admin_lname = getLname($admin_ID, $accounttype);
		$_SESSION["fname"] = $admin_fname;
		$_SESSION["lname"] = $admin_lname;
	} else {
		$admin_ID = $_SESSION["id"];
		$admin_fname = $_SESSION["fname"];
		$admin_lname = $_SESSION["lname"];
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Page</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
    <div class = "student_greeting">
    <h2> Administrative Staff Page </h2>
    </div>
</header>
<main>
    <div class = "student_greeting">
        
		<?php
			echo '<h3 >Hello! '.$admin_fname.' '.$admin_lname.' <br />Administrative Staff ID: '.$admin_ID.'<h3>';
        ?>
    
	</div>
    <br>
    <br>
    <br>
    <div class = "admin_pg_buttons">
        <form action = "view_course_schedule.php" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" value = "View Course Schedule" />
        </form>        

        <br>
        <br>
        <br>

		<form action = "view_all_sessions_admin.php" method = "post">
            <input class = "btn btn-primary btn-lg" type = "submit" value = "View Course Sessions"/>
        </form>
    	<br><br><br><br><br>
    	

        <a href='logout.php'><h4>Click here to log out</h4></a>
    

    </div>

</main>

</body>
</html>

       
