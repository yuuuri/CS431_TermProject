<?php

    /**** Reference: ****/
    /*http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php*/

    session_start();
    $student_id = $_SESSION['sess_var'];
    $sec_num = $_SESSION['hw_sec_var'];

    // Make sure an hw_id was passed
    if(isset($_GET['hw_id'])) {
    // Get the ID
    $id = intval($_GET['hw_id']);
 
    // Make sure the hw_id is in fact a valid ID
    if($id <= 0) {
        die('The Homewok ID is invalid!');
    }
    else {
        
        // Connect to the database
        //$dbLink = new mysqli('127.0.0.1', 'user', 'pwd', 'myTable');
        //if(mysqli_connect_errno()) {
        //  die("MySQL connection failed: ". mysqli_connect_error());
        //}

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
 
        // Fetch the file information
        $query = "
            SELECT `mime`, `name`, `size`, `data`
            FROM `FILE`
            WHERE `hw_id` = {$id}";
        $result = $linkink->query($query);
 
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
            // Get the row
                $row = mysqli_fetch_assoc($result);
 
                // Print headers
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 
                // Print data
                echo $row['data'];
            }
            else {
                echo 'Error! No image exists with that Homework ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
        }
        @mysqli_close($link);
    }
}
else {
    echo 'Error! No ID was passed.';
}
?>