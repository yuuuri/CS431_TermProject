<?php
	session_start();
?>

<!-- Class:	CS431 Spring Term Project: -->
<!-- Group Members: Victor Wei, Annette Ruiz, Yuri Van Steenburg -->
<!-- Purpose: This index.php (tp.index.php) will be the gateway for users to start their sessions -->

<html>
<head>
  	<title>Term Project CS431</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="jumbotron">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class = "program_title">
					<p class="navbar-text">On-Campus Course Management System</p>
			</div>
			<div class = "member"><h6>CS431 Term Project by Victor Wei, Annette Ruiz, Yuri Van Steenburg</h6></div>
		</nav>
			
		<div class = "container">

		  	<h3>Student Login: </h3>
						
				<form class="form-inline" form action="student.php" method="POST">
		  				<div class="form-group">
		    				<label for="exampleInputName2">Student ID: </label>
		    				<input type="text" class="form-control" id="exampleInputName2" placeholder="" name="s_id" maxlength = "9">
		  					<button type="submit" class="btn btn-primary">Sign In</button>
		  				</div>
				</form>				

				<?php
					if(isset($_SESSION['message1']))
					{
						echo '<font color = "red"><i>'.$_SESSION['message1'].'</i></font>';
					}
					unset($_SESSION['message1']); // clear the value so that it doesn't display again
				?>
			
			<br>

	  		<h3>Faculty Login: </h3>
				<form class="form-inline" form action="professor_page.php" method="POST">
			  			<div class="form-group">
						    <label for="exampleInputName2">Faculty ID: </label>
						    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="p_id" maxlength = "9">
						  	<button type="submit" class="btn btn-info">Sign In</button>
			  			</div>
				</form>

				<?php
					if(isset($_SESSION['message2']))
					{
						echo '<font color = "red"><i>'.$_SESSION['message2'].'</i></font>';
					}
					unset($_SESSION['message2']); // clear the value so that it doesn't display again
				?>

			<br>
		
	  		<h3>Administrator Staff Login: </h3>
				<form class="form-inline" form action="admin_page.php" method="POST">
						  <div class="form-group">
						    <label for="exampleInputName2">Administrator ID: </label>
						    <input type="text" class="form-control" id="exampleInputName2" placeholder="" name="a_id" maxlength = "9">
						  	<button type="submit" class="btn btn-warning">Sign In</button>
						  </div>
				</form></div>

				<?php
					if(isset($_SESSION['message3']))
					{
						echo '<font color = "red"><i>'.$_SESSION['message3'].'</i></font>';
					}
					unset($_SESSION['message3']); // clear the value so that it doesn't display again
				?>
		</div>		
	</div>
	
</body>
</html>
