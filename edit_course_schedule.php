<?php
	session_start();
	include 'define_class.php';
?>



<?php
	
	if (isset($_SESSION["course_id"])) {
	
		if(isset($_SESSION['message_confirm_edit'])) {
			$visit = true;
			$course_id = $_SESSION["course_id"];
		} else {	
			if ($_POST["edit_course"] != $_SESSION["course_id"]) {	
				$course_id = $_POST["edit_course"];
				$_SESSION["course_id"] = $_POST["edit_course"];
				$visit = false;
			}	
		}
		
	} else {
		$visit = false;
		$course_id = $_SESSION["course_id"];
	}
	
	if (!$visit) {
	
		$course_id = $_POST["edit_course"];
	
		
		if (!$course_id){
			$_SESSION['message_edit_course'] = "Please enter Course ID";
			header("Location: view_course_schedule.php");
			exit;	
		} elseif(!checkCourse($course_id)) {	
			$_SESSION['message_edit_course'] = "Course ID entered not valid!";
			header("Location: view_course_schedule.php");
			exit;
		} 
		
		
		$_SESSION["course_id"] = $_POST["edit_course"];
	}
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
		
			echo "Edit Course: $course_id";
			
			
			
		
		
		?>


		</h2>
        </div>
    </header>
<main>
	<div class = "add_class" >
	    <form class="form-inline" form action="confirm_course_change.php" method="POST">
			<div class="form-group">
			<tr>
			</tr>
			<label for="exampleInputName2">Course Title </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex. Computer Class" name="Course_Title" maxlength = "30"> <br />
			
			<label for="exampleInputName2">Course Description </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex. Description" name="Description" maxlength = "500"> <br />
			
			<label for="exampleInputName2">Course Units </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex. 4" name="units" maxlength = "1"> <br />
				
			<br>
			
			<input name = "SubmitButton" type = "submit" value = "Submit Changes ">
		
		
			</div>
			<br><br>
			
		<?php
            if (isset($_SESSION['message_confirm_edit'])) {
                echo '<font color = "red"><i>'.$_SESSION['message_confirm_edit'].'</i></font>';
            }
            unset($_SESSION['message_confirm_edit']); // clear the value so that it doesn't display again
        ?>
			
			
		</form>
		
		
		
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
