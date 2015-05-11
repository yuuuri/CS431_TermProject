<?php  
session_start();

include 'define_class.php';
$_SESSION['section_id'] = $_POST['section_id'];
$section_id = $_SESSION['section_id'];
$p_id = $_SESSION['id'];
$account = 'PROFESSOR';

//echo $section_id;
//making db connection
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
//Time for that query
$sql = "SELECT * FROM CLASS_GRADES WHERE Section_ID = '$section_id'";

$records = mysqli_query($con, $sql);

?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Scores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_your_courses">
        <h2> Enter Student Scores </h2>
        </div>
    </header>
<main>
    <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section</th>
                    <th>Student ID</th>
                    <th>Homework</th>
                    <th>Term Grade</th>
                    <th>Course Grade</th>
                </tr>
            </thead>
            <tbody> 
			   <?php

                    while($tScores = mysqli_fetch_assoc($records)){
                        echo "<tr>";
                        echo "<td>".$tScores['Section_ID']."</td>";
                        echo "<td>".$tScores['S_ID']."</td>";
                        //echo "<td>".$tScores['Term_Project']."</td>";
                        echo "<td>".$tScores['HW_Grade']."</td>";
                        echo "<td>".$tScores['Term_Grade']."</td>";
                        echo "<td>".$tScores['Course_Grade']."</td>";
                        echo "</tr>";

                    }

                ?>
            </tbody>
        </table>
    </div>
	
    <br /> 
    <br />

<!--     <h3>Enter Scores: </h3>
                <form class="form-inline" form action="enter_scores.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Student ID: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="s_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form> -->
        <h3>Enter the following data:</h3>

        <form action="enter_scores.php" method="post">
            <table border="0">
                <tr>
                    <td>Section ID:</td>
                    <td><input type="text" name="section_id" maxlength="9" size"9"></td>
                <tr>
                <tr>
                    <td>Student ID:</td>
                    <td><input type="text" name="s_id" maxlength="9" size"9"></td>
                <tr>
                <tr>
                    <td>Homework:</td>
                    <td><input type="text" name="hw_grade" maxlength="9" size"9"></td>
                <tr>
                 <tr>
                    <td>Term Project:</td>
                    <td><input type="text" name="term_grade" maxlength="9" size"9"></td>
                <tr>
                <tr>
                    <td>Course Grade:</td>
                    <td><input type="text" name="course_grade" maxlength="9" size"9"></td>
                <tr>  
                <tr>
                    <td colspan="2"><input type="submit" value="Update Grade"></td>
                </tr>
            </table>
        </form>                                 
	
</main>
<footer>
            <br>
            <br>
            <?php
			// Echo a link back to the main page
            echo '<p>Click <a href="teaching_courses.php">here</a> to go back</p>';
            ?>

</footer>
</body>
</html>