<?php

session_start();
$s_id = $_SESSION['s_id'];
$section_id = $_SESSION['section_id'];

// Connect to the database
$con = mysqli_connect('localhost', 'root', '', 'TermProject');
?>

<!DOCTYPE html>

<head>
    <title>File Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<header>
        <div class = "view_your_courses">
        <h2> Upload File </h2>
        </div>
    </header>
    <main>
		<?php

		if(mysqli_connect_errno()) {
		    die("MySQL connection failed: ". mysqli_connect_error());
		}
		 
		// Query for a list of all existing files
		$sql = 'SELECT `S_ID`, `Section_ID`, `name`, `mime`, `size`, `data`, `created` FROM `file`';
		$result = $con->query($sql);
		 
		// Check if it was successfull
		if($result) {
		    // Make sure there are some files in there
		    if($result->num_rows == 0) {
		        echo '<p>There are no files in the database</p>';
		    }
		    else {
		        // Print the top of a table
		        echo '<table width="100%">
		                <tr>
		                  	<td><b>Student ID</b></td>
		                  	<td><b>Section ID</b></td>
		                    <td><b>Name</b></td>
		                    <td><b>Mime</b></td>
		                    <td><b>Size (bytes)</b></td>
		                    <td><b>Created</b></td>
		                    <td><b>&nbsp;</b></td>
		                </tr>';
		 
		        // Print each file
		        while($row = $result->fetch_assoc()) {
		            echo "
		                <tr>
		                	<td>{$row['S_ID']}</td>
		                	<td>{$row['Section_ID']}</td>
		                    <td>{$row['name']}</td>
		                    <td>{$row['mime']}</td>
		                    <td>{$row['size']}</td>
		                    <td>{$row['created']}</td>
		                    <td><a href='faculty_get_file.php?Section_ID={$row['Section_ID']}'>Download</a></td>
		                </tr>";
		        }
		 
		        // Close table
		        echo '</table>';
		    }
		 
		    // Free the result
		    $result->free();
		}
		else
		{
		    echo 'Error! SQL query failed:';
		    echo "<pre>{$con->error}</pre>";
		}
		 
		// Close the mysql connection
		$con->close();
		?>
	</main>
	<footer>
            <br>
            <br>
            <?php
            // Echo a link back to the main page
            echo '<p>Click <a href="teaching_courses.php">here</a> to go back</p>';
            ?>

	</footer>
</body>
</html>