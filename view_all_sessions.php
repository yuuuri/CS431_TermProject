<?php
    session_start();
    $student_id = $_SESSION['id'];
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
                    <th>Professor First Name</th>
                    <th>Professor Last Name</th>
                    <th>Meeting Date</th>
                    <th>Starting Time</th>
                    <th>End Time</th>
                    <th>Unit(s)</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
                <?php

                    class view_all_sections {
                        function connect() {
                        $host = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'TermProject';
                        
                        @ $db = mysqli_connect($host, $username, $password, $database);
                        if (mysqli_connect_errno()) {
                            echo "Error connecting to database.  Please try again.";
                            exit;
                        }
                            return $db;
                        }
                        function display_all_sections($link_db){

                            $select = 'SELECT s.Section_ID, s.Course_ID, p.Fname, p.Lname, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit ';
                            $from = 'FROM SECTIONS as s, PROFESSOR as p, COURSE as c ';
                            $where = 'WHERE s.P_ID = p.P_ID and s.Course_ID = c.Course_ID;';

                            $query = $select.$from.$where;

                            $result = $link_db->query($query) or die("ERROR: " . mysqli_error($link_db));
                            if($result->num_rows === 0){
                                echo "<p>No records found</p>";
                                //exit();
                            }else {
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['Section_ID'] . "</td>";
                                        echo "<td>" . $row['Course_ID'] . "</td>";
                                        echo "<td>" . $row['Fname'] . "</td>";
                                        echo "<td>" . $row['Lname'] . "</td>";
                                        echo "<td>" . $row['Meeting_Date'] . "</td>";
                                        echo "<td>" . $row['Start_Time']."</td>";
                                        echo "<td>" . $row['End_Time']."</td>";
                                        echo "<td>" . $row['Course_Unit']."</td>";
                                        echo "</tr>";
                                    }//end of while

                                $result->free();
                                $link_db->close();

                            }//end of else
                        }//end of function display_all_sections
                    }//end of class view_all_sections
  
                    $v = new view_all_sections();
                    $link_db = $v->connect();
                    $v->display_all_sections($link_db);


                ?>
            </tbody>
        </table><br><br>
    </div>
    <div class = "bottom_buttons" >
                    <form class="form-inline" form action="view_course_details.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Type Course-ID to View Details of a Course: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter a Course ID" name="course_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_c']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_c'].'</i></font>';
                            }
                            unset($_SESSION['message_c']); // clear the value so that it doesn't display again
                        ?>
                    <br><br>
                    <form class="form-inline" form action="enroll.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Enter Session-ID to enroll: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter Section ID" name="session_id" maxlength = "5">
                            <button type="submit" class="btn btn-warning">Enroll</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_e']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_e'].'</i></font>';
                            }
                            unset($_SESSION['message_e']); // clear the value so that it doesn't display again
                        ?>
    </div>
</main>
<footer>
            <br>
            <br>
    <div class = "bottom_buttons" >
            <form action = 'student.php' method = 'LINK'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
    </div>        
</footer>
</body>
</html>
