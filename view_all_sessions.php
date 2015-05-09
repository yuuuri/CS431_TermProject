<?php
    session_start();
    include 'define_class.php';
    $student_id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>View All Sessions</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <header>
        <div class = "view_all_sessions_header">
        <h2> View All Sessions </h2>
        </div>
    </header>
<main>
    <div class = "all_sessions_tbl_div">
        <table class = "table table-striped">
            <thead>
                <tr><th>Section ID</th>
                    <th>Course ID</th>
                    <th>Professor First Name</th>
                    <th>Professor Last Name</th>
                    <th>Meeting Date</th>
                    <th>Starting Time</th>
                    <th>End Time</th>
                    <th>Unit(s)</th>
                </tr>
            </thead>
            <tbody> <!-- Reference: https://github.com/chrisdanan/431Hw4/blob/master/index.php -->
                <?php

                    $db = connectDB();
                    display_all_sections($db);

                ?>
            </tbody>
        </table><br><br>
    </div>
    <div class = "bottom_buttons" >
                    <form class="form-inline" form action="view_course_details.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Type Course-ID to View Details of a Course: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter a Course ID" name="course_id" maxlength = "9">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_c']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_c'].'</i></font>';
                            }
                            unset($_SESSION['message_c']); // clear the value so that it doesn't display again
                        ?>
                    <br><br>
                    <form class="form-inline" form action="enroll.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName2">Enter Session-ID to enroll: </label>
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter Section ID" name="session_id" maxlength = "5">
                            <button type="submit" class="btn btn-warning">Enroll</button>
                        </div>
                    </form>
                        <?php
                            if(isset($_SESSION['message_e']))
                            {
                                echo '<font color = "red"><i>'.$_SESSION['message_e'].'</i></font>';
                            }
                            unset($_SESSION['message_e']); // clear the value so that it doesn't display again
                        ?>
    </div>
</main>
<footer>
            <br>
            <br>
    <div class = "bottom_buttons" >
            <form action = 'student.php' method = 'LINK'>
                <input type = 'submit' class = "btn btn-default" value = 'Back'>
            </form>
    </div>        
</footer>
</body>
</html>
