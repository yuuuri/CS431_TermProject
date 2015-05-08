<?php
    session_start();
    $student_id = $_SESSION['sess_var'];
    $sec_num = $_SESSION['hw_sec_var'];

    /*
    File name:  upload_hw.php
    Function:   this page is called by view_my_classes.php
                when user choose a file to upload.
                this page does not have any display.  only shown at view_my_classes.php
    Issues:     this function just saves file in static folder called upload
                ideally, we need to create folder which specifies for specific class
    */
    //check if a file has been updated
    if (isset($_FILES['uploaded_file'])){ 

        // make sure the file was sent without errors
        if ($_FILES['uploaded_file']['error'] == 0 ){

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
                die("MySQL connection failed: ". mysqli_connect_error());
            }

            // gather all required data
            $name = $link->real_escape_string($_FILES['uploaded_file']['name']);
            $mime = $link->real_escape_string($_FILES['uploaded_file']['type']);
            $data = $link->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
            $size = intval($_FILES['uploaded_file']['size']);
            //echo 'make sure if it gets here4';
            // create the sql querty
            $insert = 'INSERT INTO HOMEWORK ( S_ID, Section_ID, name, type, size, content ) ';
            $values = 'VALUES ('.$student_id.', {'.$sec_num.'}, {'.$name.'}, {'.$mime.'}, {'.$size.'}, {'.$data.'});';
            $query = $insert.$values;
            
            // execute the query
            $result = $link->query($query);

            // check if it was successful
            if($result) {
            echo 'Success! Your file was successfully added!';
            }else {
                echo 'Error! Failed to insert the file'. "<pre>{$link->error}</pre>";
            }
        } else {    
             echo 'An error accured while the file was being uploaded. '. 'Error code: '. intval($_FILES['uploaded_file']['error']);
        }
        // close the mysql connection
        $link->close();
    }
    else{
        echo 'Error! A file was not sent!';
    }

// Echo a link back to the main page
echo '<p>Click <a href="index.html">here</a> to go back</p>';
 ?>