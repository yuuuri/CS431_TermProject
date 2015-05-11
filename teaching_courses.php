<?php

session_start();
//$facultyId = $_POST['p_id'];
$_SESSION['section_id'] = isset($_POST['section_id']) ? $_POST['section_id'] : "";
$section_id = $_SESSION['section_id'];
include 'define_class.php';
$p_id = $_SESSION['id'];
$account = 'PROFESSOR';

//making db connection
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
//Time for that query
$sql = "SELECT * FROM SECTIONS WHERE P_ID = '$p_id'";

$records = mysqli_query($con, $sql);

?>


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
            <tbody> 
			   <?php

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

    <h3>Update Scores: </h3>
                <form class="form-inline" form action="faculty_view_scores.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Section ID: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="section_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form>

    <h3>Upload/Download Files: </h3>
                <form class="form-inline" form action="faculty_file_upload.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Section ID: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="section_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form>
	
</main>
<footer>
            <br>
            <br>
            <?php
            // Echo a link back to the main page
            echo '<p>Click <a href="index.php">here</a> to go back</p>';
            ?>

</footer>
</body>
</html>
