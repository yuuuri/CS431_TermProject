<?php
	session_start();
	include 'define_class.php';
	
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
        <h2> View Course Schedule </h2>
        </div>
    </header>
<main>
    <div class = "my_classes_tbl_div">
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
					display_course_schedule($db);
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
	
</main>
<footer>
        <br>
        <br>
        <div class = "bottom_buttons" >
            <form action = 'admin.php' method = 'POST'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
        </div>
</footer>
</body>
</html>

</body>
</html>
