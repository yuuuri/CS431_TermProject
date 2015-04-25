<?php
    session_start();
    $student_id = $_SESSION['sess_var'];
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
                    <th>Syllabus</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
                <?php
                    //echo 'The content of $_SESSION[\'session_var\'] is'.$_SESSION['sess_var'].'<br />';
                    //echo '$student_id is '.$student_id;

                    class view_my_classes {
                        function connect() {
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
                            return $link;
                        }
                        function display_my_classes($link_db){


                            $query = 'SELECT Sec.Section_ID, Sec.Course_ID, Sec.Meeting_Date, Sec.Start_Time, Sec.End_Time, Sec.Syllabus FROM SECTIONS as SEC, ENROLL as EN WHERE EN.S_ID = '.$_SESSION['sess_var'].' and EN.Section_ID = SEC.Section_ID;';
                            $result = $link_db->query($query) or die("ERROR: " . mysqli_error($link_db));
                            if($result->num_rows === 0){
                                echo "<p>No records found</p>";
                                //exit();
                            }else {
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['Section_ID'] . "</td>";
                                        echo "<td>" . $row['Course_ID'] . "</td>";
                                        echo "<td>" . $row['Meeting_Date'] . "</td>";
                                        echo "<td>" . $row['Start_Time']."</td>";
                                        echo "<td>" . $row['End_Time']."</td>";
                                        echo "<td>" . $row['Syllabus']."</td>";
                                        echo "</tr>";
                                    }//end of while

                                $result->free();
                                $link_db->close();

                            }//end of else
                        }//end of function display_all_sections
                    }//end of class view_all_sections

                    $v = new view_my_classes();
                    $link_db = $v->connect();
                    $v->display_my_classes($link_db);

                ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <div class = "bottom_buttons" >
        <form action = "view_my_grades.php" method = "post">
            <input class = "btn btn-primary" type = "submit" value = "View All Sessions"/>
        </form>
    </div><br><br>
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
