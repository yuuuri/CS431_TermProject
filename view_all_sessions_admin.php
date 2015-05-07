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
        <h2> View All Sessions </h2>
        </div>
    </header>
<main>
    <div class = "all_sessions_tbl_div">
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
					display_all_sections($db);

                ?>
            </tbody>
        </table>
    </div>
    
    <br> <br>
    <div class = "bottom_buttons" >
                    <form class="form-inline" form action="delete_section.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Delete Section </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder=" Enter Session ID" name="del_sec" maxlength = "8">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_del_sec']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_del_sec'].'</i></font>';
                            }
                            unset($_SESSION['message_del_sec']); // clear the value so that it doesn't display again
                        ?>
    </div>
	
	<br> <br>
	
	<div class = "bottom_buttons" >
                    <form class="form-inline" form action="add_session.php" method="POST">
                        <div class="form-group">

                            <button type="submit" class="btn btn-info">Add Session</button>
                        </div>
                    </form>

    </div>
	
</main>
<footer>
            <br>
            <br>
			<form action = "admin.php" method = "post">
				<input name = "BackButton" type="submit" value ="Back">
			</form>
			
			<?php
				if(isset($_SESSION['message3'])){
						echo '<font color = "red"><i>'.$_SESSION['message3'].'</i></font>';
				}
				unset($_SESSION['message3']); // clear the value so that it doesn't display again
			?>

</footer>
</body>
</html>
