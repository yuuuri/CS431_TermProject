<?php
    session_start();
    include 'define_class.php';
?>


<?php
    $accounttype = 'STUDENT';
    //$firstvisit = true;
    
    
    if (isset($_SESSION["id"])) {
        $firstvisit = false;
    } else {
        $firstvisit = true;
    }
    
    /******* Error Checking from login page **********/
    
    if ($firstvisit)
    {
        $_SESSION["id"] = $_POST["s_id"];
        $student_ID = $_SESSION["id"];
    
        
        if (!$student_ID){
            $_SESSION['message1'] = "Please enter your student ID";
            header("Location: index.php");  
        } elseif(!checkCWID($student_ID,$accounttype)) {  
            $_SESSION['message1'] = "ID entered not valid!";
            header("Location: index.php");
        } elseif(strlen($student_ID) < 9) {
            $_SESSION['message1'] = "Student ID must be 9 digits";
            header("Location: index.php");
        } elseif(!is_numeric($student_ID)) {
            $_SESSION['message1'] = "Please enter numeric";
            header("Location: index.php");
        }
    
        $student_fname = getFname($student_ID, $accounttype);
        $student_lname = getLname($student_ID, $accounttype);
        $_SESSION["fname"] = $student_fname;
        $_SESSION["lname"] = $student_lname;
    } else {
        $student_ID = $_SESSION["id"];
        $student_fname = $_SESSION["fname"];
        $student_lname = $_SESSION["lname"];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Page</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
    <div class = "student_greeting">
    <h2> Student Page </h2>
    </div>
</header>
<main>
    <div class = "student_greeting">
        
        <?php
            echo '<h3 >Hello! '.$_SESSION["fname"].' '.$_SESSION["lname"].' <br />Student  ID: '.$student_ID.'<h3>';
        ?>
    
    </div>
    
    <br><br><br>
            
    <div class = "student_pg_buttons">

            <form action = "view_all_sessions.php" method = "post">
                <input class = "btn btn-primary btn-lg" type = "submit" value = "View All Sessions"/>
            </form>      

            <br><br><br>

            <form action = "view_my_classes.php" method = "post">
                <input class="btn btn-primary btn-lg" type = "submit" name = 's_id' value = "View My Classes" />
            </form>

            <br><br><br><br><br>
            
            <form action = "index.php" method = "post">
                <input class = "btn btn-primary btn-lg" type = "submit" value = "LOG OUT"/>
                <?php session_destroy() ?>
            </form>
    </div>

</main>

</body>
</html>