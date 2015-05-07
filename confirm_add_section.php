<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	$section_id = $_POST["section_id"];
	$course_id = $_POST["course_id"];
	$prof_id = $_POST["prof_id"];
	$meeting_date = $_POST["meeting_date"];
	$class_start = $_POST["start_time"];
	$class_end = $_POST["end_time"];
	
	$validsection = checkSection($section_id);
	
	if (!$section_id){
		$_SESSION['message_add_sec'] = "Please enter Section ID";
		header("Location: add_session.php");
		exit;	
	} elseif ($validsection) {	
		$_SESSION['message_add_sec'] = "Section ID already exists!";
		header("Location: add_session.php");
		exit;
	} elseif (!$meeting_date) {
		$_SESSION['message_add_sec'] = "Please enter Meeting Date";
		header("Location: add_session.php");
		exit;
	} elseif (!$class_start) { 
		$_SESSION['message_add_sec'] = "Please enter class start time";
		header("Location: add_session.php");
		exit;
	} elseif (!$class_end) { 
		$_SESSION['message_add_sec'] = "Please enter class end time";
		header("Location: add_session.php");
		exit;		
	} 
	$connect = connectDB();
	$p_id = getP_ID($connect, $prof_id);
	mysqli_close($connect);
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Section Confirmation</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> New Section Added </h2>
        </div>
    </header>
<main>
    <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section ID</th>
                    <th>Course ID</th>
                    <th>Professor Name</th>
                    <th>Meeting Date</th>
                    <th>Starting Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
               
			   <?php   
			   		/******  Connect to database and add course ********/
				$db = connectDB();
				
    			if (add_section($db, $section_id, $course_id, $p_id, $meeting_date, $class_start, $class_end)) {
   				} else { echo "Error adding section!";
    			}	      
                 
                 /*******  Display new course added in system ******/
                    $db = connectDB();
					display_section($db, $section_id);
					mysqli_close($db);  //close database
                ?>
            </tbody>
        </table>
    </div>
	<br><br>


</main>
</body>

<footer>
            <br>
            <br>
			<form action = "view_all_sessions_admin.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
