<?php
	session_start();
?>

<html>
<head>
	<title>Term Project CS431</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href="styles/style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<h1><span class="label label-default">On-Campus Course Management System</span></h1>
	<h5>CPSC 431 Term Project - by: Victor, Annette, Yuri</h5>
	<br><br>

	<div class="jumbotron">
  	<h1>Student Login: </h1>
		<form class="form-inline" form action="students.php" method="POST">
		  <div class="form-group">
		    <label for="exampleInputName2">Students ID: </label>
		    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="cwid" maxlength = "9">
		  	<button type="submit" class="btn btn-primary">Sign In</button>
		  </div>
		</form>
	</div>
	<?php
		if(isset($_SESSION['message1']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message1'].'</i></font>';
		}
		unset($_SESSION['message1']); // clear the value so that it doesn't display again
	?>

	<br>

	<div class="jumbotron">
  	<h1>Faculty Login: </h1>
		<form class="form-inline" form action="students.php" method="POST">
		  <div class="form-group">
		    <label for="exampleInputName2">Faculty ID: </label>
		    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="cwid" maxlength = "9">
		  	<button type="submit" class="btn btn-primary">Sign In</button>
		  </div>
		</form>
	</div>
	<?php
		if(isset($_SESSION['message2']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message2'].'</i></font>';
		}
		unset($_SESSION['message2']); // clear the value so that it doesn't display again
	?>

	<br>

	<div class="jumbotron">
  	<h1>Administrator Stuff Login: </h1>
		<form class="form-inline" form action="students.php" method="POST">
		  <div class="form-group">
		    <label for="exampleInputName2">Administrator ID: </label>
		    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="cwid" maxlength = "9">
		  	<button type="submit" class="btn btn-primary">Sign In</button>
		  </div>
		</form>
	</div>
	<?php
		if(isset($_SESSION['message3']))
		{
			echo '<font color = "red"><i>'.$_SESSION['message3'].'</i></font>';
		}
		unset($_SESSION['message3']); // clear the value so that it doesn't display again
	?>
	
	
</body>
</html>
