<?php
    session_start();
    $s_id = $_SESSION['s_id'];
    $section_id = $_SESSION['section_id'];
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
	    <form action="faculty_upload.php" method="post" enctype="multipart/form-data">
	        <input type="file" name="uploaded_file"><br>
	        <input type="submit" value="Upload file">
	    </form>
	    <p>
	        <a href="faculty_list_files.php">See all files</a>
	    </p>
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