<?php
	
//Connect to MySQL Server
include("configdb.php");

session_start();
mysqli_select_db($db,"DB_DATABASE");


//Select Database
//mysql_select_db(DB_DATABASE) or die(mysql_error());
	
// Retrieve data from Query String

//intval($_GET['q']);
if (isset($_GET['crs']))
{
	$crs = intval($_GET['crs']);
	$sem = $_GET['sem'];
	$div = $_GET['divsn'];


//echo "Div = ".$div;

// Escape User Input to help prevent SQL Injection
$course = mysqli_real_escape_string($db, $crs);
$semester = mysqli_real_escape_string($db, $sem);
$division = mysqli_real_escape_string($db, $div);



//build query
$query = "SELECT * FROM course_master WHERE course_id = '$course'";
$qry1 = "SELECT * FROM sem_master WHERE sem_id = '$semester'";
$qry2 =  "SELECT * FROM div_master WHERE div_id='$division'";


//Execute query
$qry_result = mysqli_query($db,$query) or die(mysql_error());
$qry1_result = mysqli_query($db,$qry1) or die(mysql_error());
$qry2_result = mysqli_query($db,$qry2) or die(mysql_error());

//Build Result String
$display_string = "<table>";
$display_string .= "<tr>";
$display_string .= "<th>Course</th>";
$display_string .= "<th>Semester</th>";
$display_string .= "<th>division</th>";
//$display_string .= "<th>WPM</th>";
$display_string .= "</tr>";


$row1 = mysqli_fetch_array($qry1_result,MYSQLI_ASSOC);
$row2 = mysqli_fetch_array($qry2_result,MYSQLI_ASSOC);

// Insert a new row in the table for each person returned
while($row = mysqli_fetch_array($qry_result,MYSQLI_ASSOC)) {
   $display_string .= "<tr>";
   $display_string .= "<td>$row[course_name]</td>";
   $display_string .= "<td>$row1[sem_id]</td>";
   $display_string .= "<td>$row2[div_name]</td>";
  // $display_string .= "<td>$row[wpm]</td>";
   $display_string .= "</tr>";
}

if (isset($_GET['crs']))
{
	$course = intval($_GET['crs']);
// Escape User Input to help prevent SQL Injection
$course = mysqli_real_escape_string($db, $course);

//build query
$query = "SELECT * FROM course_master WHERE course_id = '$course'";

//Execute query
$qry_result = mysqli_query($db,$query) or die(mysql_error());


//echo "Query: " . $query . "<br />";
$display_string .= "</table>";

echo $display_string;
}
}
?>