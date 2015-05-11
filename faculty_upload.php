


<?php
    session_start();
    $s_id = $_SESSION['s_id'];
    $section_id = $_SESSION['section_id'];
/**** Reference: ****/
/*http://bytes.com/topic/php/insights/740327-uploading-files-into-mysql-database-using-php*/
//**********************
// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        //making db connection
        $con = mysqli_connect('localhost', 'root', '', 'TermProject');
        if (mysqli_connect_errno()) {
            echo "<p>Error: Could not connect to data base.  Try again<p>\n";
            exit;
        } 
        
        // Gather all required data
        $name = $con->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $con->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $con->real_escape_string(file_get_contents($_FILES['uploaded_file']['tmp_name']));        
        $size = intval($_FILES['uploaded_file']['size']);
        
        // Create the SQL query
        $query = "
            INSERT INTO `FILE` (
                `S_ID`, `Section_ID`, `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
                ".$s_id.", '', '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $con->query($query);
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$con->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $con->close();
}
else {
    echo 'Error! A file was not sent!';
}
        //$query = "INSERT INTO FILE (S_ID, Section_ID, name, mime, size, data, created) VALUES (".$s_id.", ".$section_id.", '$name', '$mime', '$size', '$data', NOW() )";
 
// Echo a link back to the main page
echo '<p>Click <a href="teaching_courses.php">here</a> to go back</p>';
?>

