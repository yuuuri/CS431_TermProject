<?php
    session_start();
    $student_id = $_SESSION['sess_var'];

    //declare course variable
    $course_id = $_POST['course_id'];
    if(!$course_id){
        $_SESSION['message_c'] = "Please enter Course ID.";
        header("Location: view_all_sessions.php");
    }elseif(strlen($course_id) < 6){
        $_SESSION['message_c'] = "Invalid Course ID, Please enter Course ID.";
        header("Location: view_all_sessions.php");
    }else{
                //local variable to connect to database
                $user = 'root';
                $password = 'root';
                $db = 'TermProject';
                $host = '127.0.0.1';
                $port = 8889;
                $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

                $link = mysqli_init();
                $success = mysqli_real_connect($link, $host, $user, $password, $db, $port, $socket);
                if (mysqli_connect_errno()) {
                    echo "<p>Error: Could not connect to data base.  Try again<p>\n";
                    exit;
                }

                $select = 'SELECT Description ';
                $from = 'FROM COURSE ';
                $where = 'WHERE Course_ID = \''.$course_id.'\';';
                $query = $select.$from.$where;

                $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
				if($result->num_rows === 0){
            	$_SESSION['message_c'] = "Such Course does not exist. Please enter valid course.";
            	header("Location: view_all_sessions.php");
        		}else{

		            $row = $result->fetch_assoc();
		            $course_desc = $row['Description'];
		            $link->close();
		        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Course Detail</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_course_d">
        	<?php
            	echo '<h2>'.$course_id.'</h2>';
            ?>
        </div>
    </header>
<main>
	<div class = "view_course_p">
		<div class="panel panel-default">
			<div class="panel-heading">
			    	<h3 class="panel-title">Course Description</h3>
			</div>
			  	<div class="panel-body">
				    <?php
				    	echo '<p>'.$course_desc.'</p>'
				    ?>
		  		</div>
		</div>
	</div>
    <br>
    <br>
    <br>


</main>
<footer>
        <br>
        <br>
        <div class = "bottom_buttons" >
            <form action = 'view_all_sessions.php' method = 'POST'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
        </div>
</footer>
</body>
</html>