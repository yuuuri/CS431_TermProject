<!--http://stackoverflow.com/questions/9001702/php-session-destroy-on-log-out-button-->
<html>
<head>
	<title>Logout Page</title>
    <meta name = "author" content="Yuri Van Steenburg" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel= "stylesheet" type="text/css" href="style.css" />

</head>
<body>
<p class = "logout_msg">
	<?php   
	session_start();
	session_destroy();
	echo 'You have been logged out. <a href="/index.php">Go back</a>';
	?>
</p>
</body>
<html>