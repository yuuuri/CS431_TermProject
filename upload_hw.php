<?php 
 session_start();

 	/*
	File name: 	upload_hw.php
	Function:  	this page is called by view_my_classes.php
				when user choose a file to upload.
				this page does not have any display.  only shown at view_my_classes.php
 	Issues:		this function just saves file in static folder called upload
				ideally, we need to create folder which specifies for specific class
 	*/

     //always carries student_id just in case
    $student_id = $_SESSION['sess_var'];

    //declare hw file variable
    $name = $_FILES['userfile']['name'];
    //$size = $_FILES['userfile']['size'];
    //$type = $_FILES['userfile']['type'];

    $tmp_name = $_FILES['userfile']['tmp_name']; //file saved at temporary location

    if (isset($name)){ //if the form is submitted
    	if(!empty($name)) //if file exists
    	{
    		//echo 'okay'; debug stmt for validation of file

    		$location = 'uploads/'; //specified location 

    		if ( move_uploaded_file($tmp_name, $location.$name) ){
        		$_SESSION['message_hw'] = "Successfully uploaded.";
        		header("Location: view_my_classes.php");
    		} else {
    			$_SESSION['message_hw'] = "An error occured when uploading file.";
        		header("Location: view_my_classes.php");
    		}

    	} else {
        	$_SESSION['message_hw'] = "Please choose a file.";
        	header("Location: view_my_classes.php");
    	}
    }

    //make sure uploaded is grabbed
    //echo $hw_file_uploaded.' successfully uploaded';

 ?>