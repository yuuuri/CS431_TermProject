<?php  
session_start();

include 'define_class.php';
$_SESSION['section_id'] = $_POST['section_id'];
$_SESSION['s_id'] = $_POST['s_id'];
$_SESSION['hw_grade'] = $_POST['hw_grade'];
$_SESSION['term_grade'] = $_POST['term_grade'];
$_SESSION['course_grade'] = $_POST['course_grade'];
//===============================================
$section_id = $_SESSION['section_id'];
$s_id = $_SESSION['s_id'];
$hw_grade = $_SESSION['hw_grade'];
$term_grade = $_SESSION['term_grade'];
$course_grade = $_SESSION['course_grade'];
//==============================================
//$p_id = $_SESSION['id'];
// $account = 'PROFESSOR';

//making db connection
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
// //Time for that query
// $sql = "SELECT * FROM CLASS_GRADES WHERE Section_ID = '$section_id'";

// $records = mysqli_query($con, $sql);

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
        <h2> Updated Scores </h2>
        </div>
    </header>
<main>
<!--     <div class = "Course_Schedule_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section</th>
                    <th>Student ID</th>
                    <th>Homework</th>
                    <th>Term Grade</th>
                    <th>Course Grade</th>
                </tr>
            </thead>
            <tbody>  -->
			   <?php

                    // if(!$section_id || !$s_id)
                    // {
                    //     echo 'You have not entered all the required field. Try Again. <br />';
                    //     exit;
                    // }

                    //Time for that query
                    $sql = "INSERT into CLASS_GRADES values
                            ('$section_id', '$s_id', '', '','$hw_grade', '$term_grade', '$course_grade')";

                    $records = mysqli_query($con,$sql);
                    if (!$records)
                        echo mysqli_error($con);
                    else
                        echo "Successfully Inserted";

                    // while($tScores = mysqli_fetch_assoc($records)){
                    //     echo "<tr>";
                    //     echo "<td>".$tScores['Section_ID']."</td>";
                    //     echo "<td>".$tScores['S_ID']."</td>";
                    //     echo "<td>".$tScores['Term_Project']."</td>";
                    //     echo "<td>".$tScores['HW_Grade']."</td>";
                    //     echo "<td>".$tScores['Term_Grade']."</td>";
                    //     echo "<td>".$tScores['Course_Grade']."</td>";
                    //     echo "</tr>";
                    // }

                    // $con->close();

                ?>
   <!--          </tbody>
        </table>
    </div>
	
    <br /> 
    <br />
 -->

	
</main>
<footer>
            <br>
            <br>
            <?php
            // Echo a link back to the main page
            echo '<p>Click <a href="faculty_view_scores.php">here</a> to go back</p>';
            ?>

</footer>
</body>
</html>