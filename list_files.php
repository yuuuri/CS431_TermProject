<!DOCTYPE html>
<html>
<head>
    <title>View My Homework Submission</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_my_classes_header">
            <h2> View My Homework Submission </h2>
        </div>
        
        <br><br>

    </header>
<main>
<main>
    <div class = "my_classes_tbl_div">
        <table class = "table table-striped">
            <thead>
              <tr><th>File Name</th>
                  <th>File Size</th>
                  <th>Submission Date/Time</th>
                  <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php

                session_start();
                $student_id = $_SESSION['sess_var'];
                $sec_num = $_SESSION['hw_sec_var'];    

                // Connect to the database
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
 
                // Query for a list of all existing files
                //$sql = 'SELECT `hw_id`, `name`, `mime`, `size`, `created` FROM `FILE`';
                $select = "SELECT `hw_id`, `name`, `mime`, `size`, `created` FROM `FILE` ";
                $where = "WHERE `S_ID` = ".$student_id." AND "."`Section_ID` = ".$sec_num.";";
                $sql = $select.$where;
                $result = $link->query($sql);
 
                // Check if it was successfull
                if($result) {
                    // Make sure there are some files in there
                    if($result->num_rows == 0) {
                        echo '<p>There are no files in the database</p>';
                    }
                    else {

 
                        // Print each file
                        while($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$row['name']}</td>
                                <td>{$row['size']}</td>
                                <td>{$row['created']}</td>
                                <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                            </tr>";
                        }
 
                        // Close table
                        //echo '</tbody>';
                        //echo '</table>';
                    }
 
                    // Free the result
                    $result->free();
                }
                else
                {
                    echo 'Error! SQL query failed:';
                    echo "<pre>{$dbLink->error}</pre>";
                }
 
                // Close the mysql connection
                $link->close();
                ?>
            </tbody>
            </table>
            </div>
</main>
    <footer>
        <br>
        <br>
        <div class = "bottom_buttons" >
            <form action = 'view_a_class.php' method = 'POST'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
        </div>
    </footer>
</body>
</html>





