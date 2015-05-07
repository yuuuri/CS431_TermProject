<?php
	session_start();
	include 'define_class.php';

	/****** intialize variables *******/	
	$db = connectDB();
	$proflist = getProflist($db);
	$courselist = getCourselist($db);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Session</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> Add Session
		</h2>
        </div>
    </header>
<main>
	<div class = "add_class" >
	    <form class="form-inline" form action="confirm_add_section.php" method="POST">
			<div class="form-group">
			
			<label for="exampleInputName2">Section ID </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="" name="section_id" maxlength = "5"> <br />
			
			
			<label for="exampleInputName2"><td>Course ID </td></label>
				<select name = "course_id">
					<?php
						foreach($courselist as $id) { 
							echo "<option value = '$id'> $id </option>";
					
						}
					?>

				</select>
				<br>
				
			<label for="exampleInputName2"><td>Professor </td></label>
				<select name = "prof_id">
					<?php 
						foreach($proflist as $name) {
							echo "<option value = '$name'> $name </option>";
						}					
					?>
				
				</select>
				<br>
				
			
			<label for="exampleInputName2">Meeting Date </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex: Tu/Th" name="meeting_date" maxlength = "10"> <br />
			
			<label for="exampleInputName2">Class Start Time </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex: 8:00 AM" name="start_time" maxlength = "8"> <br />
			
			<label for="exampleInputName2">Class End Time </label>
			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex: 12:00 PM" name="end_time" maxlength = "8"> <br />
			
			<br>
			
			<input name = "SubmitButton" type = "submit" value = "Add Section ">
			</div>
			<br><br>
		<?php
            if (isset($_SESSION['message_add_sec'])) {
                echo '<font color = "red"><i>'.$_SESSION['message_add_sec'].'</i></font>';
            }
            unset($_SESSION['message_add_sec']); // clear the value so that it doesn't display again
        ?>
        </form>
    </div>
		
		
		
	</div>


	
</main>
<footer>
            <br>
            <br>
			<br>
			<form action = "view_all_sessions_admin.php" method = "post">
				<input name = "BackButton" type="submit" value ="Back">
			</form>

</footer>
</body>
</html>
