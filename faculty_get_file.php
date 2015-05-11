<?php

session_start();
$s_id = $_SESSION['s_id'];
$section_id = $_SESSION['section_id'];

// Make sure an ID was passed
if(isset($_GET['hw_id'])) {
// Get the ID
    $hw_id = intval($_GET['hw_id']);
 
    // Make sure the ID is in fact a valid ID
    if($hw_id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $con = mysqli_connect('localhost', 'root', '', 'TermProject');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Fetch the file information
        $query = "
            SELECT `mime`, `name`, `size`, `data`
            FROM `file`
            WHERE `hw_id` = {$hw_id}";
        $result = $con->query($query);
 
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
                echo 'Error! No image exists with that ID.';
            }
 
            // Free the mysqli resources
            @mysqli_free_result($result);
        }
        else {
            echo "Error! Query failed: <pre>{$con->error}</pre>";
        }
        @mysqli_close($con);
    }
}
else {
    echo 'Error! No ID was passed.';
}
?>