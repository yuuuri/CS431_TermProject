<?php
session_start();
include 'define_class.php';
$student_id = $_SESSION['id'];
$sec_num = $_SESSION['hw_sec_var'];

/**** Reference: ****/
/*http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php*/

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {

    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {

        $link = connectDB();
        
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
               . "<pre>{$link->error}</pre>";
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
 
 
