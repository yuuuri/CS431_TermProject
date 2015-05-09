<?php
    session_start();
    include 'define_class.php';
    $student_id = $_SESSION['id'];

            function display_my_grades($link_db, $student_id){

                    $select = 'SELECT CG.Section_ID, SE.Course_ID, CG.HW_Grade, CG.Term_Grade, CG.Course_Grade ';
                    $from = 'FROM CLASS_GRADES as CG, SECTIONS as SE ';
                    $where = 'WHERE CG.S_ID = '.$student_id.' and CG.Section_ID = SE.Section_ID;';
                    $query = $select.$from.$where;
                    //$querty = 'SELECT Section_ID FROM CLASS_GRADES;';

                    $result = $link_db->query($query) or die("ERROR: " . mysqli_error($link_db));
                    if($result->num_rows === 0){
                        echo "<p>No records found</p>";
                        //exit();
                    }else {
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td>" . $row['Section_ID'] . "</td>";
                                echo "<td>" . $row['Course_ID'] ."</td>";
                                echo "<td>" . $row['HW_Grade'] . "</td>";
                                echo "<td>" . $row['Term_Grade'] . "</td>";
                                echo "<td>" . $row['Course_Grade']."</td>";
                                echo "</tr>";
                            }//end of while

                        //$result->free();
                        //$link_db->close();

                    }//end of else
            }//end of function display_my_grades
?>


<!DOCTYPE html>
<html>
<head>
    <title>View My Grades</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_my_grades_header">
            <h2> My Grades </h2>
        </div>
    </header>
<main>
    <div class = "my_grades_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section ID</th>
                    <th>Course Name</th>
                    <th>Homework Grade</th>
                    <th>Term Grade</th>
                    <th>Course_Grade<th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
                <?php
                    //echo 'The content of $_SESSION[\'session_var\'] is'.$_SESSION['sess_var'].'<br />';
                    //echo '$student_id is '.$student_id;

                    //local variable to connect to database    
                    $db = connectDB();
                    display_my_grades($db, $student_id);

                ?>
            </tbody>
        </table>
    </div>
    <br><br>
<br><br>
</main>
<footer>
        <br>
        <br>
        <div class = "bottom_buttons" >
            <form action = 'view_my_classes.php' method = 'POST'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
        </div>
</footer>
</body>
</html>
