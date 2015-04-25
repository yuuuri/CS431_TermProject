<?php

	function usertype($accounttype)
	{
		if ($accounttype == 'ADMIN_STAFF')
		{
			$queryID = 'A_ID';
		}
		elseif ($accounttype == 'STUDENT')
		{
			$queryID = 'S_ID';
		}
		elseif ($accounttype == "PROFESSOR")
		{
			$queryID = 'P_ID';
		}
		return $queryID;
	}

	function checkCWID($CWID, $accounttype)
	{
		$queryID = usertype($accounttype);
		
		
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
	
	function getFname($CWID,$accounttype)
	{
		$queryID = usertype($accounttype);

		
		@ $db = mysqli_connect('localhost', 'root', '', 'TermProject');
		if (mysqli_connect_errno())
		{	
			echo "Error connecting to database.  Please try again";
			exit;
		}
		$query = 'SELECT * FROM '.$accounttype.' WHERE '.$queryID.' = '.$CWID;
		$result = mysqli_query($db, $query);
		if (!$result)
		{
			echo "No results from querying the database! - getFnamefunction";
			exit;
		}
		$data = mysqli_fetch_assoc($result);
		$Fname = $data['Fname'];

		return $Fname;
	}

	
	function getLname($CWID,$accounttype)
	{

		$queryID = usertype($accounttype);
		
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
		$Lname = $data['Lname'];
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

