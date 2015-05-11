<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	//$course_id = $_POST["Course_ID"];
	$course_title = $_POST["Course_Title"];
	$course_des = $_POST["Description"];
	$course_unit = $_POST["units"];
	$course_id = $_SESSION["course_id"];
	

	if (!$course_title){
		$_SESSION['message_confirm_edit'] = "Please enter Course Title";
		header("Location: edit_course_schedule.php");
		exit;	
	} elseif (!$course_des) {	
		$_SESSION['message_confirm_edit'] = "Please enter Course Description";
		header("Location: edit_course_schedule.php");
		exit;	
	} elseif (!$course_unit) {
		$_SESSION['message_confirm_edit'] = "Please enter Course Units";
		header("Location: edit_course_schedule.php");
		exit;	
	} elseif(!is_numeric($course_unit)) {
		$_SESSION['message_confirm_edit'] = "Please enter numeric value for Course Units";
		header("Location: edit_course_schedule.php");
		exit;
	}
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Course Change</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> Previous Course Information </h2>
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

                    $db = connectDB();
					display_course($db, $course_id);
					mysqli_close($db);  //close database
                ?>
            </tbody>
        </table>
    </div>
	<br><br>

	<?php
		/********** Modify course details ***********/
		$db = connectDB();
		modify_course($db, $course_id, $course_title, $course_des, $course_unit);
	?>
	
</main>
<header>
        <div class = "view_all_sessions_header">
        <h2> Updated Course Information </h2>
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

                    $db = connectDB();
					display_course($db, $course_id);
					mysqli_close($db);
                ?>
            </tbody>
        </table>
    </div>

	
</main>
<footer>
            <br>
            <br>
			<form action = "view_course_schedule.php" method = "post">
				<input name = "BackButton" type="submit" value="Back">
			</form>

</footer>
</body>
</html>
