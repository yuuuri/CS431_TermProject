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
$p_id = $_SESSION['id'];
$account = 'PROFESSOR';

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

                    if(!$section_id || !$s_id)
                    {
                        echo 'You have not entered all the required field. Try Again. <br />';
                        exit;
                    }
                    if(!get_magic_quotes_gpc())
                    {
                        $section_id = addslashes($section_id);
                        $s_id = addslashes($s_id);
                        $hw_grade = addslashes($hw_grade);
                        $term_grade = addslashes($term_grade);
                        $course_grade = addslashes($course_grade);
                    }

                    //Time for that query
                    $sql = "insert into CLASS_GRADES values
                            ('".$section_id."', '".$s_id."', '".$hw_grade."', '".$term_grade."', '".$course_grade."')";

                    $records = $con->query($sql);
                    if ($records)
                        echo $con->affected_rows.' scores updated.';

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

                    $con->close();

                ?>
            </tbody>
        </table>
    </div>
	
    <br /> 
    <br />

    <h3>Select Class: </h3>
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
