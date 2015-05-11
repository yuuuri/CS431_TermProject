<?php
	session_start();
	include 'define_class.php';
	
?>
<?php

	$section_id = $_POST["del_sec"];

	$validsection = checkSection($section_id);
	$can_del_section = check_del_section($section_id);

	
	if (!$section_id){
		$_SESSION['message_del_sec'] = "Please enter Section ID";
		header("Location: view_all_sessions_admin.php");
		exit;	
	} elseif ($validsection == false) {	
		$_SESSION['message_del_sec'] = "Please enter a valid Section ID";
		header("Location: view_all_sessions_admin.php");
		exit;
	} elseif ($can_del_section == true) {
		$_SESSION['message_del_sec'] = "Student enrolled in Section!  Cannot delete Section!";
		header("Location: view_all_sessions_admin.php");
		exit;
	}	
	
	
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirm Section Deletion</title>
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

                    $db = connectDB();
                    display_section($db, $section_id);
                    
                    
					if (delete_section($db, $section_id)) {
						$confirmdelete = "Section successfully deleted from database";
					} else {
						echo "Error deleting course detail!  Please try again <br />";
					}
					
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
			<form action = "view_all_sessions_admin.php" method = "post">
				<input name = "BackButton" type="submit" value ="Back">
			</form>

</footer>
</body>
</html>
