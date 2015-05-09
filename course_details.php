

<?php

session_start();
$course_id = $_POST['course_id'];
include 'define_class.php';
$_SESSION['course_id'] = $_POST['course_id'];
$account = 'PROFESSOR';


//making db connection
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
//Time for that query
$sql = "SELECT * FROM COURSE WHERE Course_ID = '$course_id'";
$records = mysqli_query($con, $sql);

?>

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
            <tbody> 
			   <?php
                    while($cDetails = mysqli_fetch_assoc($records)){
                        echo "<tr>";
                        echo "<td>".$cDetails['Course_ID']."</td>";
                        echo "<td>".$cDetails['Course_Title']."</td>";
                        echo "<td>".$cDetails['Description']."</td>";
                        echo "</tr>";
                    }

                ?>
            </tbody>
        </table>
    </div>

    <br /> 
    <br />
    
<!--     <h3>Course Details: </h3>
                <form class="form-inline" form action="course_details.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Course ID: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="course_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form>

	<br /> 
    <br /> -->

	
</main>
<footer>
            <br>
            <br>
			<form action = "teaching_courses.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
