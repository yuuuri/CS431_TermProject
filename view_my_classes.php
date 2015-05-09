<?php
    session_start();
    include 'define_class.php';
    $student_id = $_SESSION['id'];
    
    
    function display_my_classes($link_db, $student_id)
    {
        $select = 'SELECT s.Section_ID, s.Course_ID, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus ';
        $from = 'FROM COURSE as c, SECTIONS as s, ENROLL as en ';
        $where = "WHERE en.S_ID = $student_id and en.Section_ID = s.Section_ID and s.Course_ID = c.Course_ID";
        $query = $select.$from.$where;
        $result = $link_db->query($query) or die("ERROR: " . mysqli_error($link_db));
        if($result->num_rows === 0){
            echo "<p>No records found</p>";
            //exit();
        } else {
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['Section_ID'] . "</td>";
                echo "<td>" . $row['Course_ID'] . "</td>";
                echo "<td>" . $row['Meeting_Date'] . "</td>";
                echo "<td>" . $row['Start_Time']."</td>";
                echo "<td>" . $row['End_Time']."</td>";
                echo "<td>" . $row['Course_Unit']."</td>";
                echo "<td>" . $row['Syllabus']."</td>";
                echo "</tr>";
            }//end of while
        $result->free();
        $link_db->close();
        }//end of else
    }//end of function display_my_classes
    
    
    
    
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>View My Classes</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_my_classes_header">
            <h2> View My Classes </h2>
        </div>
    </header>
<main>
    <div class = "my_classes_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section ID</th>
                    <th>Course ID</th>
                    <th>Meeting Date</th>
                    <th>Starting Time</th>
                    <th>End Time</th>
                    <th>Unit(s)</th>
                    <th>Syllabus</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
                <?php
                    //echo 'The content of $_SESSION[\'session_var\'] is'.$_SESSION['sess_var'].'<br />';
                    //echo '$student_id is '.$student_id;
                    $db = connectDB();
                    display_my_classes($db, $student_id);
                
                ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class = "bottom_buttons" >
        <form action = "view_my_grades.php" method = "post">
            <input class = "btn btn-primary" type = "submit" value = "View My Grades"/>
        </form>

        <br><br>

        <h3>Submitting homework?</h3>
            <form class="form-inline" form action="view_a_class.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputName2">Choose Your Class: </label>
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter Section Number" name="asec_num" maxlength = "5">
                        <button type="submit" class="btn btn-primary">Go To My Class</button>
                    </div>
            </form>             

            <?php
                if(isset($_SESSION['message_aclass']))
                {
                    echo '<font color = "red"><i>'.$_SESSION['message_aclass'].'</i></font>';
                }
                unset($_SESSION['message_aclass']); // clear the value so that it doesn't display again
            ?>

    </div><br><br>
</main>
<footer>
        <br>
        <br>
        <div class = "bottom_buttons" >
            <form action = 'student.php' method = 'POST'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
        </div>
</footer>
</body>
</html>