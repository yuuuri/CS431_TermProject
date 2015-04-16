<?php

	class student
	{
		public function enroll($section_id,$CWID)
		{
		
			
			$query = "insert into enroll values
					('".$CWID." ', '".$section_id."')";
			
			@ $db = mysqli_connect ('localhost', 'root', '', 'TermProject');
			if (mysqli_connect_errno())
			{
				echo "Error connecting to database.  Please try again";
				exit;
			}
			
			$result = mysqli_query($db, $query);
			
			if ($result)
			{
				echo "Successfully enrolled!";
			}
			else 
			{
				echo "An error has occured.  Was not able to enroll.";
			}
			
			mysqli_close($db);
	
		}	
		
		
		public function add_file ($file, $CWID)
		{
		
		}
		
		
		
		
		public function see_classes()
		{
		
		
		
		
		}
	}
	






?>

