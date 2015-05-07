<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	$course_id = $_POST["Course_ID"];
	$course_title = $_POST["Course_Title"];
	$course_des = $_POST["Description"];
	$course_unit = $_POST["course_units"];

	$validcourse = checkCourse($course_id);
	
	if (!$course_id){
		$_SESSION['message_add_course'] = "Please enter Course ID";
		header("Location: add_course.php");
		exit;	
	} elseif ($validcourse) {	
		$_SESSION['message_add_course'] = "Course ID already exists!";
		header("Location: add_course.php");
		exit;
	} elseif (!$course_title) {
		$_SESSION['message_add_course'] = "Please enter Course Title";
		header("Location: add_course.php");
		exit;
	} elseif (!$course_des) { 
		$_SESSION['message_add_course'] = "Please enter Course Description";
		header("Location: add_course.php");
		exit;		
	} elseif(strlen($course_id) != 8) {
		$_SESSION['message_add_course'] = "Course ID must be 8 characters";
		header("Location: add_course.php");
		exit;
	} elseif(!is_numeric($course_unit)) {
		$_SESSION['message_add_course'] = "Please enter numeric";
		header("Location: add_course.php");
		exit;
	}
	
	

	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Course Confirmation</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> New Course Added </h2>
        </div>
    </header>
<main>
    <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Course ID</th>
                    <th>Course Title    </th>
					<th>Course Description</th>
					<th>Course Units</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
               
			   <?php   
			   		/******  Connect to database and add course ********/
				$db = connectDB();
	
    			if (add_course($db, $course_id, $course_title, $course_unit, $course_des)) {
   				} else { echo "Error adding course!";
    			}	      
                 
                 /*******  Display new course added in system ******/
                    $db = connectDB();
					display_course($db, $course_id);
					mysqli_close($db);  //close database
                ?>
            </tbody>
        </table>
    </div>
	<br><br>


</main>


<footer>
            <br>
            <br>
			<form action = "view_course_schedule.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
