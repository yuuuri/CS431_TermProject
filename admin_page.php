<?php
	session_start();
	include 'classes.php';
?>


<?php
	$accounttype = 'ADMIN_STAFF';
	$_SESSION["id"] = $_POST["a_id"];
	//$admin_ID = $_SESSION["id"];
	$admin_ID = $_POST["a_id"];
	
	
	
	
	if (!$admin_ID)
	{
		$_SESSION['message3'] = "Please enter your Administrator ID";
		header("Location: index1.php");	
	}
	
	elseif(!checkCWID($admin_ID,$accounttype))
	{	
		$_SESSION['message3'] = "ID entered not valid!";
		header("Location: index1.php");
	}
	elseif(strlen($admin_ID) < 9)
	{
		$_SESSION['message3'] = "SSN must be 9 digits";
		header("Location: index1.php");
	}
		elseif(!is_numeric($admin_ID))
	{
		$_SESSION['message3'] = "Please enter numeric";
		header("Location: index1.php");
	}
	
	
	$name = getfullname($admin_ID, $accounttype);
	
	$hello = 'hello';
	$world = 'world';
	
	echo "LoL it works!";
	echo " The ID of the fool who logged in is:".$admin_ID;
	echo "<br /> <br /> <br />";
	echo "WELCOME $name";
	


?>