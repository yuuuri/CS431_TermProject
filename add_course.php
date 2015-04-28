<?php
	session_start();
	include 'define_class.php';
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Course Details</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> 
		<?php
			echo "Add Course ";
		?>


		</h2>
        </div>
    </header>
<main>
	<div class = "add_class" >
	    <form class="form-inline" form action="confirm_add_course.php" method="POST">
			<div class="form-group">
			<tr>
			<label for="exampleInputName2"><td>Course ID </td></label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="" name="Course_ID" maxlength = "8"> <br />
			</tr>
			<label for="exampleInputName2">Course Title </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="" name="Course_Title" maxlength = "30"> <br />
			
			<label for="exampleInputName2">Course Description </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="" name="Description" maxlength = "500"> <br />
			<input name = "SubmitButton" type = "submit" value = "Submit Changes "
		</div>
		
		<?php
            if (isset($_SESSION['message_add'])) {
                echo '<font color = "red"><i>'.$_SESSION['message_add'].'</i></font>';
            }
            unset($_SESSION['message_add']); // clear the value so that it doesn't display again
        ?>
    </div>
		
		
		
	</div>


	
</main>
<footer>
            <br>
            <br>
			<br>
			<form action = "view_course_schedule.php" method = "post">
				<input name = "BackButton" type="submit" value ="Back">
			</form>

</footer>
</body>
</html>
