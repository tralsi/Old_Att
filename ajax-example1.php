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
	$facid=$_POST['facid'];

	//added on 06/05
	$lecno = $_POST['lecno'];
	$dt = $_POST['date'];
	$f_date=date('Y-m-d',strtotime($dt));
	$att_marked_flag = 0;
	

// Escape User Input to help prevent SQL Injection
$course = mysqli_real_escape_string($db, $crs);
$semester = mysqli_real_escape_string($db, $sem);
$division = mysqli_real_escape_string($db, $div);

//Check whether the attendance has already been marked for the same day, same lecture, same sub , same div  by same faculty ? if yes UPDATE attendance else mark new attendance

$qry_att_check = "SELECT * FROM `student_attendance` WHERE att_date='$f_date' AND course=$course AND sem=$semester AND `div`=$division AND lec_no=$lecno AND fac=$facid"; //added on 06/05

$res_att_check = mysqli_query($db,$qry_att_check);
$att_check_rows = mysqli_num_rows($res_att_check);
if($att_check_rows > 0)
   {
    $att_marked_flag = 1; 
    $stud_row = mysqli_fetch_assoc($res_att_check);
    $abs_list = explode(",",$stud_row['abs']);
   }


//build query for listing students
$query = "SELECT * FROM attendance.students WHERE course_id = '$course' AND sem_id='$semester' AND div_id='$division'";

//Execute query
$qry_result = mysqli_query($db,$query) or die(mysql_error());
$rowCount = $qry_result->num_rows;

//Display Roll Nos only if there are rows to display
$display_string = "";
while($row = mysqli_fetch_array($qry_result,MYSQLI_ASSOC))
{
  $flag=0;    
  $display_string .= "<div data-toggle='buttons' class='col-md-2'>";
	//$display_string .= "<label class='btn btn-info'>";
	$no=$row['roll_no'];
		if($att_marked_flag==1)
		{
			if(in_array($no,$abs_list))  //Checking whether that no was absent on that day or not
			{
				$flag=1;
			}
			else
			{
				$flag=0;
			}
		}

	if($flag==1) //Student was absent on that day in said lecture no
	{
		$display_string .= "<label class='btn btn-info active'>";
		$display_string .= "<input type='checkbox' name='student' id=" .$no. " value=".$no." checked>".$no;
	}
	else
	{
		$display_string .= "<label class='btn btn-info'>";
		$display_string .= "<input type='checkbox' name='student' id= ".$no." value=".$no.">".$no;
	}
	
	$display_string .= " <span id='checkbox1' class='glyphicon glyphicon-remove'></span>";
	$display_string .= "</label>";
	$display_string .= "</div>";
}

$display_string .= "</div>";

	if($rowCount > 0) //if we have result to display
	{
		$display_string .= "<div class='row'>&nbsp </div></br>";
		$display_string .=  "<center>";
		$btn_label = "Mark Attendacne";
		
		if($att_marked_flag==1) //if attendance is already marked
		{
			$btn_label = "Update Attendance";
			$display_string .= "<span style='color:red'><strong>Note :  You have already marked the attendance earlier for this lecture</strong></span></br>";
		}
		
		$display_string .= "<button id='register' class='btn btn-success btn-md' onClick='getAbsentees($att_marked_flag)'>".$btn_label."</button>";
		$display_string .=  "</center>";	
		$display_string .= "</div>";
			
	}
	else
	{
		$display_string .= "Students will be displayed here";
	}

echo $display_string;
}
?>