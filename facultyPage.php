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
        <h2> Faculty Page </h2>
    </div>
</header>

<?php
    if(!$facultyId){
        $_SESSION['message1'] = "Please enter your Faculty ID:";
        header("Location: index.php");
    }
    elseif(strlen($facultyId) < 9){
        $_SESSION['message1'] = "ID less than 9 digits. Try Again.";
        header("Location: index.php");
    }
    elseif(!is_numeric($facultyId)){
        $_SESSION['message1'] = "Please enter numeric 9 digits.";
        header("Location: index.php");
    }
    elseif(!checkCWID($facultyId, $account)){
        $_SESSION['message1']= "ID entered not valid.";
        header("Location: index.php");
    }
    else{
    //$facultyFname = getFname($facultyId, $account);
    //$facultyLname = getLname($facultyId, $account);
    
        //local variable to connect to database
        /*$user = 'root';
        $password = 'root';
        $db = 'TermProject';
        $host = '127.0.0.1';
        $port = 8889;
        $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';*/

        $mysql_hostname = '127.0.0.1';
        $mysql_username = 'root';
        $mysql_password = 'root';
        $mysql_database = 'TermProject'
        //$db = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);
        
        $link = mysqli_init();
        $db = mysqli_real_connect($link, $mysql_hostname, $mysql_username, $mysql_password);
        if (mysqli_connect_errno()) {
            echo "<p>Error: Could not connect to database.  Try again<p>\n";
            exit;
        } 
        //echo "Successfully connected to database TermProject\n";
        //database connected

        $query = 'SELECT P_ID, Fname, Lname from PROFESSOR WHERE P_ID = '.$facultyId.';';
        $result = $link->query($query) or die("ERROR: " . mysqli_error($link));
        if($result->num_rows === 0){
            $_SESSION['message1'] = "Please enter valid faculty ID.";
            header("Location: index.php");
        }else{

            //create a session variable
            $_SESSION['sess_var'] = $facultyId;

            //echo 'The content of $_SESSION[\'session_var\'] is'.$_SESSION['sess_var'].'<br />';

            $row = $result->fetch_assoc();
            $student_id = $row['P_ID'];
            $student_fname = $row['Fname'];
            $student_lname = $row['Lname'];
            $link->close();
        }
    }
?>

<main>
    <div class = "s">
        <?php
            echo '<h3 >Hello '.$facultyId.'!</h3>';
        ?>

    </div>
    <br>
    <br>
    <br>
    <div class = "coursesList">
        <form action = "" method = "post">
            <input class = "btn btn-primary btn-lg" type = "submit" value = "View All Sessions"/>
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "courseDetails">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 's_id' value = "View My Classes" />
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "uploadMaterials">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 's_id' value = "View My Classes" />
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "downloadFiles">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 's_id' value = "View My Classes" />
        </form>
    </div>
        <br>
        <br>
        <br>
    <div class = "enterScores">
        <form action = "" method = "post">
            <input class="btn btn-primary btn-lg" type = "submit" name = 's_id' value = "View My Classes" />
        </form>
    </div>

</main>

</body>
</html>

       
