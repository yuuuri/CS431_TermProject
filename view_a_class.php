<?php
    session_start();
    $student_id = $_SESSION['sess_var'];
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
        <h2> My Classs </h2>
        </div>
    </header>
    <main>
    <div class = "all_sessions_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section ID</th>
                    <th>Course ID</th>
                    <th>Course Title</th>
                    <th>Professor Last Name</th>
                    <th>Meeting Date</th>
                    <th>Starting Time</th>
                    <th>End Time</th>
                    <th>Unit(s)</th>
                    <th>Sylabus</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->

            <?php

                 session_start();
                 $student_id = $_SESSION['sess_var'];

                //declare course(specific section) variable
                $sec_num = $_POST['asec_num']; //asec_num is a section number picked up from view_my_classes
                if(!$sec_num){
                    $_SESSION['message_aclass'] = "Please enter Section Number.";
                    header("Location: view_my_classes.php");
                }elseif(strlen($sec_num) > 3){
                    $_SESSION['message_aclass'] = "Invalid Section ID, Please enter Section ID above.";
                    header("Location: view_my_classes.php");
                }elseif(!is_numeric($sec_num)){
                    $_SESSION['message_aclass'] = "Please enter numeric digits.";
                    header("Location: view_my_classes.php");
                }else{ //echo 'course_id is '.$sec_num;
                    
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
                    $select = 'SELECT s.Section_ID, s.Course_ID, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus ';
                    $from = 'FROM COURSE as c, SECTIONS as s, ENROLL as e ';
                    $where = 'WHERE e.S_ID = '.$_SESSION['sess_var'].' AND e.Section_ID = s.Section_ID AND s.Course_ID = c.Course_ID;';
                    $query = $select.$from.$where;

                    $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
                    if($result->num_rows === 0){
                        echo "<p>No records found</p>";
                        exit();
                    }else{
                        //echo 'variable check $sec_num = '.$sec_num;
                        //echo 'variable check $student_id var = '.$student_id;

                    $query_one_class = 'SELECT s.Section_ID, s.Course_ID, c.Course_Title, p.Lname, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus FROM SECTIONS as s, COURSE as c, PROFESSOR as p, ENROLL as e WHERE e.S_ID = '.$student_id.' and '.$sec_num.' = e.Section_ID and e.Section_ID = s.Section_ID and s.Course_ID = c.Course_ID and s.P_ID = p.P_ID';
                    $result_aclass = $link->query($query_one_class) or die("ERROR:" . mysqli_error($link));                     
                        if($result_aclass->num_rows === 0){
                            echo "<p>No records found, only one class should be displayed here</p>";
                            exit();
                        }else{
                            //create another session variable
                            $_SESSION['hw_sec_var'] = $sec_num;
                            //echo $_SESSION['hw_sec_var'];
                            while($row = mysqli_fetch_array($result_aclass)){
                                    echo "<tr>";
                                    echo "<td>" . $row['Section_ID'] . "</td>";
                                    echo "<td>" . $row['Course_ID'] . "</td>";
                                    echo "<td>" . $row['Course_Title'] . "</td>";
                                    echo "<td>" . $row['Lname'] . "</td>";
                                    echo "<td>" . $row['Meeting_Date'] . "</td>";
                                    echo "<td>" . $row['Start_Time']."</td>";
                                    echo "<td>" . $row['End_Time']."</td>";
                                    echo "<td>" . $row['Course_Unit']."</td>";
                                    echo "<td>" . $row['Syllabus']."</td>";
                                    echo "</tr>";
                            }//end of while
                            //$result_aclass->$free();
                            //$link->close();
                            //echo 'what happened2?'; 
                        }       
                    }
                //$result->$free();
                //$link->close();    
               }
            ?>  
            </tbody>
        </table>
    </div>

<br><br>
    <div class = "bottom_buttons" >          
        <h3>Submit My Homework</h3>

    <form action="add_file.php" method="post" enctype="multipart/form-data">
        <input type="file" name="uploaded_file"><br>
        <input type="submit" value="Upload file">
    </form>
    <?php
    if(isset($_SESSION['message_hw']))
    {
        echo '<font color = "red"><i>'.$_SESSION['message_hw'].'</i></font>';
    }
    unset($_SESSION['message_hw']); // clear the value so that it doesn't display again
    ?>
    <br><br>
    <p>
        <a href="list_files.php">See all files</a>
    </p>





            

    </div><br><br>
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





