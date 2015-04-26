<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	$course_id = $_POST["Course_ID"];
	$course_title = $_POST["Course_Title"];
	$course_des = $_POST["Description"];
	$original_course_id = $_SESSION["course_id"];
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>View All Sessions</title>
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
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
               
			   <?php

                    $db = connectDB();
					display_course($db, $original_course_id);
					modify_course($db, $original_course_id, $course_id, $course_title, $course_des);
                ?>
            </tbody>
        </table>
    </div>
	<br><br>

	
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
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
               
			   <?php

                    $db = connectDB();
					
					
					display_course($db, $course_id);

                ?>
            </tbody>
        </table>
    </div>

	
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
