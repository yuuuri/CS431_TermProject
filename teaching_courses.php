
<?php
//making db connection
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
//Time for that query
$sql = "SELECT * FROM SECTIONS WHERE P_ID = p_id";

$records = mysqli_query($con, $sql);

?>

<!-- <?php
	/*session_start();
	include 'define_class.php';*/
	
?>
<<<<<<< HEAD

<?php

    //$course_id = $_POST["Course_ID"];
    //$course_title = $_POST["Course_Title"];
   // $course_des = $_POST["Description"];
    //$original_course_id = $_SESSION["course_id"];
    
?>

 -->
=======
<?php

    $course_id = $_POST["Course_ID"];
    $course_title = $_POST["Course_Title"];
    $course_des = $_POST["Description"];
    $original_course_id = $_SESSION["course_id"];
    
?>
>>>>>>> 49805ced9ae1ccd17489951caa1e3d54ac29e330
<!DOCTYPE html>
<html>
<head>
    <title>Your Courses</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_your_courses">
        <h2> Your Courses </h2>
        </div>
    </header>
<main>
    <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section</th>
                    <th>Course    </th>
					<th>Meeting Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
			   <?php

                    //$db = connectDB();
					//facultyCourses($db, $p_id);

                    while($tClass = mysqli_fetch_assoc($records)){
                        echo "<tr>";
                        echo "<td>".$tClass['Section_ID']."</td>";
                        echo "<td>".$tClass['Course_ID']."</td>";
                        echo "<td>".$tClass['Meeting_Date']."</td>";
                        echo "<td>".$tClass['Start_Time']."</td>";
                        echo "<td>".$tClass['End_Time']."</td>";
                        echo "</tr>";

                    }

                ?>
            </tbody>
        </table>
    </div>
	
    <br /> 
    <br />

    <h3>Course Details: </h3>
                <form class="form-inline" form action="course_details.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Course ID: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="course_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form>
	
</main>
<footer>
            <br>
            <br>
			<form action = "faculty_page.php" method = "post">
				<input name = "BackButton" type="submit" values="Back">
			</form>

</footer>
</body>
</html>
