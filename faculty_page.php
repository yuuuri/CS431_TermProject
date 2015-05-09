<?php
     session_start();
     $facultyId = $_POST['p_id'];
     include 'define_class.php';
     $_SESSION['id'] = $_POST['p_id'];
     $account = 'PROFESSOR';
?>




<!DOCTYPE html>
<html>
<head>
    <title>Faculty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />
</head>
<body>
<header>
    <div class = "student_greeting">
        <h2>Faculty Page</h2>
    </div>
</header>

<?php
    if(!$facultyId){
        $_SESSION['message2'] = "Please enter your Faculty ID:";
        header("Location: index.php");
    }
    elseif(strlen($facultyId) < 9){
        $_SESSION['message2'] = "ID less than 9 digits. Try Again.";
        header("Location: index.php");
    }
    elseif(!is_numeric($facultyId)){
        $_SESSION['message2'] = "Please enter numeric 9 digits.";
        header("Location: index.php");
    }
    elseif(!checkCWID($facultyId, $account)){
        $_SESSION['message2']= "ID entered not valid.";
        header("Location: index.php");
    }
    else{
    $facultyFname = getFname($facultyId, $account);
    $facultyLname = getLname($facultyId, $account);
    }
?>

<main>
    <div class = "s">
        <?php
            echo '<h3>Welcome '.$facultyFname.' '.$facultyLname.'</h3>';
            echo '<h3>Faculty ID:' .$facultyId.'</h3>';
        ?>

    </div>
    <br>
    <br>
    <br>
    <div class = "coursesList">
        <form action = "teaching_courses.php" method = "post">
            <input class = "btn btn-primary btn-lg" type = "submit" name = 'p_id' value = "View Courses"/>
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "uploadMaterials">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 'p_id' value = "Upload Files" />
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "downloadFiles">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 'p_id' value = "Download Files" />
        </form>
    </div>
        <br>
        <br>
        <br>
<!--     <div class = "enterScores">
        <form action = "enter_scores.php" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 'section_id' value = "Enter Scores" />
        </form>
    </div> -->

</main>

</body>
</html>

       


       
