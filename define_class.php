<?php

	/****** determine what account type user is (for query) *******/
	function usertype($accounttype)
	{
		if ($accounttype == 'ADMIN_STAFF') {
			$queryID = 'A_ID';
		} elseif ($accounttype == 'STUDENT') {
			$queryID = 'S_ID';
		} elseif ($accounttype == 'PROFESSOR') {
			$queryID = 'P_ID';
		}
		return $queryID;
	}
	
	/****** Connect to database ******/
	function connectDB()
	{
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$database = 'TermProject';
		
		@ $db = mysqli_connect($host, $username, $password, $database);
		if (mysqli_connect_errno()) {
			echo "Error connecting to database.  Please try again.";
			exit;
		}
		return $db;
	}
	
	/***** Check if CWID is valid (login for index.php) *******/
	function checkCWID($CWID, $accounttype)
	{
		$queryID = usertype($accounttype);
		$db = connectDB();
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		
		$result = mysqli_query($db, $query);
		if ($result){
			mysqli_close($db);
			return true;
		} else {
			mysqli_close($db);
			return false;
		}
	}
	
	
	/***** Check if Course is valid (for editing a course) *******/
	function checkCourse($course_id)
	{
		$db = connectDB();
		$query = "SELECT * FROM COURSE WHERE Course_ID = '$course_id'";
		
		$result = mysqli_query($db, $query);
		if ($result){
			mysqli_close($db);
			return true;
		} else {
			mysqli_close($db);
			return false;
		}
	}
	
	/**** Return User's First Name ******/
	function getFname($CWID,$accounttype)
	{
		$queryID = usertype($accounttype);
		$db = connectDB();
		$query = 'SELECT * FROM '.$accounttype.' WHERE '.$queryID.' = '.$CWID;
		
		$result = mysqli_query($db, $query);
		if (!$result){
			echo "No results from querying the database! - getFnamefunction";
			exit;
		}
		
		$data = mysqli_fetch_assoc($result);
		$Fname = $data['Fname'];
		mysqli_close($db);
		return $Fname;
	}

	/**** Return User's Last Name ******/	
	function getLname($CWID,$accounttype)
	{

		$queryID = usertype($accounttype);
		$db = connectDB();
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		
		$result = mysqli_query($db, $query);
		if (!$result){
			echo "SOMETHING WENT WRONG BOI";
		}
		
		$data = mysqli_fetch_assoc($result);
		$Lname = $data['Lname'];
		mysqli_close($db);
		return $Lname;
	}	

	/**** Return User's Last Name ******/	
	function getCourseID($CWID,$accounttype)
	{

		$queryID = usertype($accounttype);
		$db = connectDB();
		$query = "select * from ".$accounttype." where ".$queryID." = ".$CWID;
		
		$result = mysqli_query($db, $query);
		if (!$result){
			echo "SOMETHING WENT WRONG BOI";
		}
		
		$data = mysqli_fetch_assoc($result);
		$Lname = $data['Lname'];
		mysqli_close($db);
		return $Lname;
	}	
	
    function display_all_sections($link_db)
	{
		//$query = 'SELECT * from SECTIONS';
        $select = 'SELECT * ';
        $from = 'FROM SECTIONS as SEC, PROFESSOR as P, COURSE as C ';
        $where = 'WHERE SEC.P_ID = P.P_ID AND SEC.Course_ID = C.Course_ID;';
		$query = $select.$from.$where;
        $result = mysqli_query($link_db, $query);
		
        if($result->num_rows == 0) {
            echo "<p>No records found</p>";
            exit();
        } else {
            while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['Section_ID'] . "</td>";
				echo "<td>" . $row['Course_ID'] . "</td>";
				echo "<td>" . $row['Course_Title'] . "<td><td></td>";
				echo "<td>" . $row['Fname'] . "</td>";
				echo "<td>" . $row['Lname'] . "</td>";
				echo "<td>" . $row['Meeting_Date'] . "</td>";
				echo "<td>" . $row['Start_Time']."</td>";
				echo "<td>" . $row['End_Time']."</td>";
				echo "</tr>";
			}
        }
		
		mysqli_free_result($result);
        mysqli_close($link_db);
    }
	
	function display_course_schedule($db)
	{
		$query = "SELECT * FROM COURSE ";
		$result = mysqli_query($db, $query);
		if (!$result) {
			echo "<p> No records found </p>";
		} else {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['Course_ID'] . "</td>";
				echo "<td>" . $row['Course_Title'] . "</td>";
				echo "<td>" . $row['Description'] . "<td><td></td>";
				echo "</tr>";
			}
		}
	}
	
	function display_course($db, $course_id) 
	{
		$query = "SELECT * FROM COURSE WHERE Course_ID = '$course_id'";
		$result = mysqli_query($db, $query);
		if (!$result) {
			echo "<p> No records found </p>";
		} else {
			$row = mysqli_fetch_assoc($result);
				echo "<tr>";
				echo "<td>" . $row['Course_ID'] . "</td>";
				echo "<td>" . $row['Course_Title'] . "</td>";
				echo "<td>" . $row['Description'] . "<td><td></td>";
				echo "</tr>";
		}
	}
	
	
	function modify_course ($db, $original_course_id, $course_id, $course_title, $course_des) 
	{
	
		$query1 = "UPDATE COURSE SET Course_ID = '$course_id'where Course_ID = '$original_course_id'";
		$query2 = "UPDATE COURSE SET Course_Title = '$course_title'where Course_ID = '$original_course_id'";
		$query3 = "UPDATE COURSE SET Description = '$course_des'where Course_ID= '$original_course_id'";
		
		if ($result = mysqli_query($db, $query1)) {
		} else {
			echo "Error updating database";
		}
		if ($result = mysqli_query($db, $query2)) {
		} else {
			echo "Error updating database";
		}
		
		if ($result = mysqli_query($db, $query3)) {
		} else {
			echo "Error updating database";
		}

		//mysqli_free_result($result);
		mysqli_close($db);
		return true;
		
		
	}

	function add_course ($db, $course_id, $course_title, $course_des) 
	{
	
		$query = "INSERT INTO COURSE VALUES ('$course_id','$course_title', '$course_des')";
		
		if (!$result = mysqli_query($db, $query)) {
		} else {
			echo "Error updating database11";
		}

		
		//mysqli_free_result($result);
		mysqli_close($db);
		return true;
	}
	
	function delete_course ($db, $course_id) 
	{
		$query = "DELETE FROM COURSE WHERE Course_ID = '$course_id'";
		
		if (!$result = mysqli_query($db, $query)) {
		} else {
			echo "Error updating database";
		}
		
		mysqli_close($db);
		return true;
		
	}
	
	
	
	class student {
		public function enroll($section_id,$CWID) {
		
			
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
		
		
		public function add_file ($file, $CWID){
		
		}

	}
	
?>
