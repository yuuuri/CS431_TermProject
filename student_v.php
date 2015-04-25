<?php 
 session_start();
    //declare CWID variable
    $student_id = $_POST['s_id'];
	include 'define_class.php';
	$_SESSION['id'] = $_POST['s_id'];
	$account = 'STUDENT';
	
    //======== BIGIN INPUT PARSING ===========
    //check for user input errors such as missing CWID or less than 9 digits
    //if error is found, kick the user back to index, following an error msg

    if(!$student_id){
        $_SESSION['message1'] = "Please enter Student ID.";
        header("Location: index.php");
    }elseif(strlen($student_id) < 9){
        $_SESSION['message1'] = "Student ID must be 9 digits.";
        header("Location: index.php");
    }elseif(!is_numeric($student_id)){
        $_SESSION['message1'] = "Please enter numeric 9 digits.";
        header("Location: index.php");
    }
	elseif(!checkCWID($student_id, $account)){
		$_SESSION['message1']= "ID entered not valid.";
		header("Location: index.php");
	}
	
	$student_fname = getFname($student_id, $account);
	$student_lname = getLname($student_id, $account);
	

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
    <h2> Student Page </h2>
    </div>
</header>
<main>
    <div class = "student_greeting">
        <?php

        echo '<h3 >Hello! '.$student_fname.' '.$student_lname.' Student ID: '.$student_id.'<h3>';

        ?>
    </div>
    <br>
    <br>
    <br>
    <div class = "student_pg_buttons">
        <form action = "view_all_sessions.php" method = "post">
            <input class = "btn btn-primary btn-lg" type = "submit" value = "View All Sessions"/>
        </form>
    

        <br>
        <br>
        <br>


        <form action = "view_my_classes.php" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" value = "View My Classes" />
        </form>
    </div>

</main>

</body>
</html>

       
