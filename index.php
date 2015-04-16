<?php
	session_start();
?>

<html>
<body>

	

	<b><font size = 16>CPSC 431 Term Project</font></b>
	<br><br>
	<b>Professor Login</b><br>
	<form action="professor_page.php" method="POST">
		Professor CWID: <input type="text" name="ssn" maxlength = "9"><br>
		<input type="submit" value = "Login">
	</form>
	<?php
		if(isset($_SESSION['message']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message'].'</i></font>';
		}
		unset($_SESSION['message']); // clear the value so that it doesn't display again
	?>
	

	<br>
	<b>Student Login: </b><br>
	<form action="student_page.php" method="POST">
		Student CWID <input type="text" name="cwid" maxlength = "9"><br>
		<input type="submit" value = "Login">
	</form>
	<?php
		if(isset($_SESSION['message4']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message4'].'</i></font>';
		}
		unset($_SESSION['message4']); // clear the value so that it doesn't display again
	?>

	<br>
	<b>Admin Login: </b><br>
	<form action="admin_page.php" method="POST">
		Admin CWID <input type="text" name="cwid" maxlength = "9"><br>
		<input type="submit" value = "Login">
	</form>
	<?php
		if(isset($_SESSION['message4']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message4'].'</i></font>';
		}
		unset($_SESSION['message4']); // clear the value so that it doesn't display again
	?>
	
	
</body>
</html>
