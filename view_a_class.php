<?php
    session_start();
    include 'define_class.php';
    $student_id = $_SESSION['id'];    
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
    }else{
        $link = connectDB();
        $select = 'SELECT s.Section_ID, s.Course_ID, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus ';
        $from = 'FROM COURSE as c, SECTIONS as s, ENROLL as e ';
        $where = 'WHERE e.S_ID = '.$student_id.' AND e.Section_ID = s.Section_ID AND s.Course_ID = c.Course_ID;';
        $query = $select.$from.$where;
        $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
        if($result->num_rows === 0){
            $_SESSION['message_aclass'] = "No Record Found.";
        header("Location: view_my_classes.php");
        }else{
            //echo 'variable check $sec_num = '.$sec_num;
            //echo 'variable check $student_id var = '.$student_id;
        $query_one_class = 'SELECT s.Section_ID, s.Course_ID, c.Course_Title, p.Lname, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus FROM SECTIONS as s, COURSE as c, PROFESSOR as p, ENROLL as e WHERE e.S_ID = '.$student_id.' and '.$sec_num.' = e.Section_ID and e.Section_ID = s.Section_ID and s.Course_ID = c.Course_ID and s.P_ID = p.P_ID';
        $result_aclass = $link->query($query_one_class) or die("ERROR:" . mysqli_error($link));                     
            if($result_aclass->num_rows === 0){
                $_SESSION['message_aclass'] = "No records found. Please enter valid Section ID.";
                header("Location: view_my_classes.php");
            }
        }
    }

        function view_specific_class($link, $student_id, $sec_num) {
                
                $select = 'SELECT s.Section_ID, s.Course_ID, s.Meeting_Date, s.Start_Time, s.End_Time, c.Course_Unit, s.Syllabus ';
                $from = 'FROM COURSE as c, SECTIONS as s, ENROLL as e ';
                $where = 'WHERE e.S_ID = '.$student_id.' AND e.Section_ID = s.Section_ID AND s.Course_ID = c.Course_ID;';
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
            
        }//end of view_specific_class    
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Class</title>
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
                 //echo 'course_id is '.$sec_num;
                    
                    //local variable to connect to database
                    $db = connectDB();
                    view_specific_class($db, $student_id, $sec_num);
                    
                //$result->$free();
                //$link->close();    
               
            ?>  
            </tbody>
        </table>
    </div>

<br><br>
    <div class = "bottom_buttons" >          
        <h3>Submit My Homework</h3>
            <form action = "add_file.php" method = "post" enctype="multipart/form-data" />
                <div>
                    <input type = "hidden" name = "MAX_FILE_SIZE" value = "1000000" />
                    <label for ="userfile"><h4>Upload a file: </h4></label>
                    <input type = "file" name = "uploaded_file" class = "inputFile" /><br>
                    <input class ="btn btn-success" type = "submit" value="Upload file" />
                </div>
            </form>
            <?php
                if(isset($_SESSION['message_hw']))
                {
                    echo '<font color = "red"><i>'.$_SESSION['message_hw'].'</i></font>';
                }
                unset($_SESSION['message_hw']); // clear the value so that it doesn't display again
            ?>
            <br><br>
            <h4>
                <a href="list_files.php"><h4>Click Here To See All Files Submitted For This Class<h4></a>
            </h4>

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
