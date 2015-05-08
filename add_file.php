<?php
    session_start();
    $student_id = $_SESSION['sess_var'];
    $sec_num = $_SESSION['hw_sec_var'];

/**** Reference: ****/
/*http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php*/

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {

    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {

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
        
        // Gather all required data
        $name = $link->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $link->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $link->real_escape_string(file_get_contents($_FILES['uploaded_file']['tmp_name']));        
        $size = intval($_FILES['uploaded_file']['size']);
        
        // Create the SQL query
        $query = "
            INSERT INTO `FILE` (
                `S_ID`, `Section_ID`, `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
                ".$student_id.", ".$sec_num.", '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $link->query($query);

        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $link->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="view_a_class.php">here</a> to go back</p>';
?>
 
 