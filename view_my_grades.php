<?php
    session_start();
    $student_id = $_SESSION['sess_var'];
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

                    class view_my_grades {
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
                        function display_my_grades($link_db){

                            $select = 'SELECT CG.Section_ID, SE.Course_ID, CG.HW_Grade, CG.Term_Grade, CG.Course_Grade ';
                            $from = 'FROM CLASS_GRADES as CG, SECTIONS as SE ';
                            $where = 'WHERE CG.S_ID = '.$_SESSION['sess_var'].' and CG.Section_ID = SE.Section_ID;';
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

                                $result->free();
                                $link_db->close();

                            }//end of else
                        }//end of function display_all_sections
                    }//end of class view_all_sections

                    $v = new view_my_grades();
                    $link_db = $v->connect();
                    $v->display_my_grades($link_db);

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
