<?php 
 session_start();
    //declare student_ID variable
    $sec_id = $_POST['session_id'];
    $student_id = $_SESSION['sess_var'];

    //======== BIGIN INPUT PARSING ===========
    //check for user input errors such as missing CWID or less than 9 digits
    //if error is found, kick the user back to index, following an error msg

    if(!$sec_id){
        $_SESSION['message_e'] = "Please enter Section ID.";
        header("Location: view_all_sessions.php");
    }elseif($sec_id > 80000){
        $_SESSION['message_e'] = "Invalid Section ID.";
        header("Location: view_all_sessions.php");
    }else{

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
        //echo "Successfully connected to database TermProject\n";
        //database connected

        //check the section exist in db
        $q_exists = 'select * from SECTIONS where Section_ID = '.$sec_id;
        $result_q_exists = $link->query($q_exists) or die("ERROR: " . mysqli_error($link));
        if($result_q_exists->num_rows === 0){
            $_SESSION['message_e'] = "The Section ID you entered not exist.";
            header("Location: view_all_sessions.php");   
        }
        else {
            //echo ' existence check went through ';
            //checks if the section id entered was already enrolled, if not insert

            //the below checks if user tries enrolling same session number
            //kick back to user
            /*********************************************************************/
            $select = 'SELECT s.Section_ID, s.Course_ID, s.Meeting_Date, s.Start_Time, s.End_Time, s.Syllabus ';
            $where = 'FROM SECTIONS as s, ENROLL as e '; 
            $from = 'WHERE e.S_ID = '.$_SESSION['sess_var'].' and '.$sec_id.' = e.Section_ID and e.Section_ID = s.Section_ID;';

            $query = $select.$where.$from;
            $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
            if($result->num_rows === 1){
                $_SESSION['message_e'] = "Already enrolled. Please enter valid session ID.";
                header("Location: view_all_sessions.php");
            }else{
                    //the below checks if user tries enrolling same class already enrolled
                    //(different section number but same class already enrollded) kick back
            		/*********************************************************************/
                    $select = 'SELECT c.Course_ID, c.Course_title, s.Section_ID ';
                    $where = 'FROM SECTIONS as s, Course as c ';
                    $from = 'WHERE s.Section_ID = '.$sec_id.' AND s.Course_ID = c.Course_ID;';
                    $query = $select.$where.$from;
                    $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
                    if($result->num_rows === 1){
                        $_SESSION['message_e'] = "Already enrolled that class. Please enter valid session ID.";
                        header("Location: view_all_sessions.php");
                    }else{

                        //finally condition should be acceptabe to enroll
                        $query_enroll = 'INSERT INTO ENROLL VALUES ( '.$_SESSION['sess_var'].', '.$sec_id.');';
                        $result_enroll = $link->query($query_enroll) or die("ERROR: " . mysqli_error($link));
                        if (!$result_enroll) {
                            die('Invalid query: ' . mysql_error());
                        }
                        else{   
                            $_SESSION['message_e'] = "Succsessfully enrolled!";
                            header("Location: view_all_sessions.php"); 
                        }
                        $result_enroll->free();
                    }            
            }
        }
        $link->close();
    }        
?>
