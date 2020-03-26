<?php
	
//Connect to MySQL Server
include("configdb.php");

session_start();
mysqli_select_db($db,"DB_DATABASE");

// Retrieve data from Query String


if (isset($_POST['divsn']))
{
	$crs = intval($_POST['crs']);
	$sem = $_POST['sem'];
	$div = $_POST['divsn'];


// Escape User Input to help prevent SQL Injection
$course = mysqli_real_escape_string($db, $crs);
$semester = mysqli_real_escape_string($db, $sem);
$division = mysqli_real_escape_string($db, $div);


//build query
$query = "SELECT * FROM attendance.students WHERE course_id = '$course' AND sem_id='$semester' AND div_id='$division'";

//Execute query
$qry_result = mysqli_query($db,$query) or die(mysql_error());
$rowCount = $qry_result->num_rows; //Display Submit button only if there are rows to display

$display_string = "";
while($row = mysqli_fetch_array($qry_result,MYSQLI_ASSOC)) {
      
  $display_string .= "<div data-toggle='buttons' class='col-md-2'>";
	$display_string .= "<label class='btn btn-info'>";
	$no=$row['roll_no'];
	$display_string .= "<input type='checkbox' name='student' id= ".$no." value=".$no.">".$no;
	$display_string .= " <span id='checkbox1' class='glyphicon glyphicon-remove'></span>";
	$display_string .= "</label>";
	$display_string .= "</div>";
}

$display_string .= "</div>";

	if($rowCount > 0)
	{
		$display_string .= "<div class='row'>&nbsp </div></br>";
	//	$display_string .= "<div style=margin:auto;width:20%;'>";
	$display_string .=  "<center>";
		$display_string .= "<button id='register' class='btn btn-success btn-md' onClick='getAbsentees()'>Mark Attendacne</button>";
	$display_string .=  "</center>";	
		$display_string .= "</div>";
		/*$display_string .= "<button id='register' class='btn btn-success btn-md'>Register</button>";
		$display_string .= "</div></div>";*/
	}
	else
	{
		$display_string .= "Students will be displayed here";
	}

echo $display_string;
}
?>