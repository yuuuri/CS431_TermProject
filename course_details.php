<?php
	session_start();
	include 'define_class.php';
	
?>

/*<?php

    $course_id = $_SESSION['course_id'];
    $course_title = $_POST["Course_Title"];
    $course_des = $_POST["Description"];
   // $original_course_id = $_SESSION["course_id"];
    
?>*/

<!DOCTYPE html>
<html>
<head>
    <title>Your Course Detail</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_your_courses">
        <h2> Your Course Detail </h2>
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
    
    <div class = "bottom_buttons" >
                    <form class="form-inline" form action="edit_course_schedule.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Modify Details of a Course: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder=" Enter Course ID" name="edit_course" maxlength = "8">
                            <button type="submit" class="btn btn-info">Edit</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message'].'</i></font>';
                            }
                            unset($_SESSION['message']); // clear the value so that it doesn't display again
                        ?>
    </div>
    <br /> <br />
    
    <div class = "bottom_buttons" >
                    <form class="form-inline" form action="modify_course_schedule.php" method="POST">
                        <div class="form-group">

                            <button type="submit" class="btn btn-info">Add/Delete a Course</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_c']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_c'].'</i></font>';
                            }
                            unset($_SESSION['message_c']); // clear the value so that it doesn't display again
                        ?>
    </div>

	<br /> 
    <br />

	
</main>
<footer>
            <br>
            <br>
			<form action = "facultyPage.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
