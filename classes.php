<?php


	/******** Function to determine whether what type of user ********/
/*	
	function usertype ($accounttype)
	{
		if ($accounttype = "ADMIN_STAFF")
		{
			return 'A_ID';
		}
		elseif ($acccounttype = "STUDENT")
		{
			return 'S_ID';
		}
		elseif ($accounttype = "PROFESSOR")
		{
			return 'P_ID';
		}
	}
*/
	/*********  Function to check whether ID from login page is valid ***********/
	function checkCWID ($CWID, $accounttype)
	{
		//$queryID = usertype($accounttype);
		
		if ($accounttype = "ADMIN_STAFF")
		{
			$queryID = 'A_ID';
		}
		elseif ($acccounttype = "STUDENT")
		{
			$queryID = 'S_ID';
		}
		elseif ($accounttype = "PROFESSOR")
		{
			$queryID = 'P_ID';
		}
		
		
		
		@ $db = mysqli_connect('localhost', 'root', '', 'TermProject');
		if (mysqli_connect_errno())
		{	
			echo "Error connecting to database.  Please try again";
			exit;
		}
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		$result = mysqli_query($db, $query);
		if ($result)
		{
			mysqli_close($db);
			return 1;
		}
		else
		{
			mysqli_close($db);
			return 0;
		}
	}
	/*******  Function to grab the full name from database *********/
	function getFname($CWID,$accounttype)
	{
		if ($accounttype = "ADMIN_STAFF")
		{
			$queryID = 'A_ID';
		}
		elseif ($acccounttype = "STUDENT")
		{
			$queryID = 'S_ID';
		}
		elseif ($accounttype = "PROFESSOR")
		{
			$queryID = 'P_ID';
		}
		
		
		@ $db = mysqli_connect('localhost', 'root', '', 'TermProject');
		if (mysqli_connect_errno())
		{	
			echo "Error connecting to database.  Please try again";
			exit;
		}
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		$result = mysqli_query($db, $query);
		if (!$result)
		{
			echo "SOMETHING WENT WRONG BOI";
		}
		$data = mysqli_fetch_assoc($result);
		$Fname = $data['Fname'];

		return $Fname;
	}

	/*******  Function to grab the last name from database *********/
	function getLname($CWID,$accounttype)
	{
		if ($accounttype = "ADMIN_STAFF")
		{
			$queryID = 'A_ID';
		}
		elseif ($acccounttype = "STUDENT")
		{
			$queryID = 'S_ID';
		}
		elseif ($accounttype = "PROFESSOR")
		{
			$queryID = 'P_ID';
		}
		
		
		@ $db = mysqli_connect('localhost', 'root', '', 'TermProject');
		if (mysqli_connect_errno())
		{	
			echo "Error connecting to database.  Please try again";
			exit;
		}
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		$result = mysqli_query($db, $query);
		if (!$result)
		{
			echo "SOMETHING WENT WRONG BOI";
		}
		$data = mysqli_fetch_assoc($result);
		$Fname = $data['Lname'];

		return $Lname;
	}


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

