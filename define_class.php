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
		$num = mysqli_num_rows($result);
		if ($num == 1){
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
		$num = mysqli_num_rows($result);
		if ($num == 1){
			mysqli_close($db);
			return true;
		} else {
			mysqli_close($db);
			return false;
		}
	}
	
	/***** Check if section is available (for adding/deleting a section) *******/
	function checkSection($section_id)
	{
		$db = connectDB();
		$query = "SELECT * FROM SECTIONS WHERE Section_ID = $section_id";
		
		$result = mysqli_query($db, $query);
		$num_result = mysqli_num_rows($result);
		if ($num_result ==1) {
			mysqli_close($db);
			return true;
		} else {
			mysqli_close($db);
			return false;
		}
	}	
	
	
	/****** check if course has a section assigned to it ******/
	function check_del_course ($course_id)
	{
		$db = connectDB();
		$query = "SELECT * FROM SECTIONS WHERE Course_ID = '$course_id'";
		
		$result = mysqli_query($db, $query);
		$num = mysqli_num_rows($result);
		if ($num > 0) {
			mysqli_close($db);
			return false;
		} else {
			mysqli_close($db);
			return true;
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
        $where = 'WHERE SEC.P_ID = P.P_ID AND SEC.Course_ID = C.Course_ID ';
        $order = 'ORDER BY SEC.Section_ID';
		$query = $select.$from.$where.$order;
        $result = mysqli_query($link_db, $query);
		
        if($result->num_rows == 0) {
            echo "<p>No records found</p>";
            exit();
        } else {
            while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['Section_ID'] . "</td>";
				echo "<td>" . $row['Course_ID'] . "</td>";
				echo "<td>" . $row['Fname'] ." ". $row['Lname'] . "</td>";
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
				echo "<td>" . $row['Description'] . "</td>";
				echo "<td>" . $row['Course_Unit'] . "</td>";
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
				echo "<td>" . $row['Description'] . "</td>";
				echo "<td>" . $row['Course_Unit'] . "</td>";
				echo "</tr>";
		}
	}
	
	function display_section ($db, $section_id)
	{

        $select = 'SELECT * ';
        $from = 'FROM SECTIONS as SEC, PROFESSOR as P ';
        $where = 'WHERE SEC.P_ID = P.P_ID AND SEC.Section_ID = '.$section_id;
		$query = $select.$from.$where;
        $result = mysqli_query($db, $query);

		$result = mysqli_query($db, $query);
		if (!$result) {
			echo "<p> No records found </p>";
		} else {
			$row = mysqli_fetch_assoc($result);
				echo "<tr>";
				echo "<td>" . $row['Section_ID'] . "</td>";
				echo "<td>" . $row['Course_ID'] . "</td>";
				echo "<td>" . $row['Fname'] ." ". $row['Lname'] . "</td>";
				echo "<td>" . $row['Meeting_Date'] . "</td>";
				echo "<td>" . $row['Start_Time']."</td>";
				echo "<td>" . $row['End_Time']."</td>";
				echo "</tr>";
		}	
	}
	
	
	function modify_course ($db, $original_course_id, $course_title, $course_des, $course_unit) 
	{
	
		//$query1 = "UPDATE COURSE SET Course_ID = '$course_id' WHERE Course_ID = '$original_course_id'";
		$query2 = "UPDATE COURSE SET Course_Title = '$course_title' WHERE Course_ID = '$original_course_id'";
		$query3 = "UPDATE COURSE SET Description = '$course_des' WHERE Course_ID= '$original_course_id'";
		$query4 = "UPDATE COURSE SET Course_Unit = '$course_unit' WHERE Course_ID= '$original_course_id'";
		//$query3 = mysqli_real_escape_string($db, $query3);
		//if (mysqli_query($db, $query1)) {
		//} else {
		//	echo "Error updating database - problem setting Course ID";
		//}
		if (mysqli_query($db, $query2)) {
		} else {
			echo "Error updating database - problem setting Course Title";
			exit;
		}
		
		if (mysqli_query($db, $query3)) {
		} else {
			echo "Error updating database - problem setting Course Description";
			exit;
		}

		if (mysqli_query($db, $query4)) {
		} else {
			echo "Error updating database - problem setting Course units";
			exit;
		}
		
		//mysqli_free_result($result);
		mysqli_close($db);
		return true;
		
		
	}

	function add_course ($db, $course_id, $course_title, $units, $course_des) 
	{
	
		$query = "INSERT INTO COURSE VALUES ('$course_id','$course_title', $units, '$course_des')";
		
		if (mysqli_query($db, $query)) {
		} else {
			echo "Error updating database - problem with adding course";
		}

		
		//mysqli_free_result($result);
		mysqli_close($db);
		return true;
	}
	
	function add_section ($db, $section_id, $course_id, $prof, $meet_date, $start_time, $end_time)
	{
		$query = "INSERT INTO SECTIONS VALUES ($section_id, '$course_id', $prof, '$meet_date', '$start_time', '$end_time', '')";
		
		if (mysqli_query($db, $query)) {
		} else {
			echo "Error updating database - problem with adding section";
		}
		mysqli_close($db);
		return true;
	}
	
	function delete_course ($db, $course_id) 
	{
		$query = "DELETE FROM COURSE WHERE Course_ID = '$course_id'";
		
		if (mysqli_query($db, $query)) {
		} else {
			echo "Error updating database - problem deleting course";
		}
		
		mysqli_close($db);
		return true;
		
	}
	

	function delete_section ($db, $section_id) 
	{
		$query = "DELETE FROM SECTIONS WHERE Section_ID = $section_id";
		
		if (mysqli_query($db, $query)) {
		} else {
			echo "Error updating database - problem deleting section";
		}
		
		mysqli_close($db);
		return true;
		
	}
	
	function getCourselist ($db)
	{
		$coursearray = array();
		$query = "select * from COURSE";
		$result = mysqli_query($db, $query);
		
		$num_result = mysqli_num_rows($result);
		if ($num_result <1) {
			echo "No results found";
			exit;
		}
		
		for ($i = 0; $i < $num_result; $i++) {
			$data = mysqli_fetch_assoc($result);
			$coursearray[$i] = $data["Course_ID"];
		}
		mysqli_free_result($result);
		
		return $coursearray;
	}
	
	function getProflist ($db)
	{
		$profarray = array();
		$query = "select * from PROFESSOR";
		$result = mysqli_query($db, $query);
		
		$num_result = mysqli_num_rows($result);
		if ($num_result <1) {
			echo "No results found";
			exit;
		}
		
		for ($i = 0; $i < $num_result; $i++) {
			$data = mysqli_fetch_assoc($result);
			$profarray[$i] = $data['Fname']." ".$data['Lname'];
		}
	
		mysqli_free_result($result);
		return $profarray;
	}
	
	function getP_ID ($db,$name)
	{
		$query = "SELECT * FROM PROFESSOR";
		$result = mysqli_query($db, $query);
		$num_result = mysqli_num_rows($result);
		
		for ($i = 0; $i < $num_result; $i++) {
			$data = mysqli_fetch_assoc($result);
			$profname = $data['Fname']." ".$data['Lname'];
			if ($profname == $name) {
				return $data['P_ID'];
			}
		}
	
	}


?>
