<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	$course_id = $_POST["del_course"];

	$validcourse = checkCourse($course_id);
	
	if (!$course_id){
		$_SESSION['message_del'] = "Please enter Course ID";
		header("Location: view_course_schedule.php");
		exit;	
	} elseif (!$validcourse) {	
		$_SESSION['message_del'] = "Please enter a valid Course ID";
		header("Location: view_course_schedule.php");
		exit;
	} 
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Course Deletion</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> Course Deleted </h2>
        </div>
    </header>
<main>
    <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Course ID</th>
                    <th>Course Title    </th>
					<th>Course Description</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
               
			   <?php

                    $db = connectDB();
                    display_course($db, $course_id);
                    
                    
					if (delete_course($db, $course_id)) {
						$confirmdelete = "Course successfully deleted from database";
					} else {
						echo "Error deleting course detail!  Please try again <br />";
					}
					//display_course($db, $original_course_id);
					//modify_course($db, $original_course_id, $course_id, $course_title, $course_des);
                ?>
            </tbody>
        </table>
    </div>
	<br><br>

	
</main>
<?php
	if ($confirmdelete) {
		echo $confirmdelete;
	}
	
?>

<footer>
            <br>
            <br>
			<form action = "view_course_schedule.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
