<?php
	
//Connect to MySQL Server
include("configdb.php");
session_start();

//mysqli_select_db($db,"DB_DATABASE");

// Retrieve data from Query String
if (isset($_POST['sub_id']))
{
  $dt = $_POST['date_dt'];
	$crs = intval($_POST['crs_id']);
	$sem = $_POST['sem_id'];
  $div = $_POST['div_id'];
  $lecno = $_POST['lec_no'];
  $subid = $_POST['sub_id'];
  $facid = $_POST['fac_id'];
  $abs_array = array();
  //$abs_array = $_POST['abs_stud_arr'];

  if (isset($_POST['abs_stud_arr']))  //if all students are present, this array may not pass any absent student roll no value
  {
    $abs_array = $_POST['abs_stud_arr'];
  }
  
  $f_date=date('Y-m-d',strtotime($dt));
  
$count = count($abs_array); // if any student is absent 

if($count > 0)
  {
	  // If Individual records of each student is to be inserted
  /* foreach($abs_array as $abs_stud)
  {
    $query = "INSERT INTO att_master (att_date,att_crs_id,att_sem_id,att_div_id,att_lec_no,att_sub_id,att_fac_id,att_stud_id,att_stud_presence) VALUES ('$f_date',$crs,$sem,$div,$lecno,$subid,$facid,'$abs_stud','A')";
	
    mysqli_query($db,$query);
  } */
  
  // if single record for all the students is to be inserted
  
   $vals = implode(',',$abs_array);
   $query = "INSERT INTO student_attendance(abs) VALUES ('$vals')";

   if(mysqli_query($db,$query))
    {
      //insert last attendance update date by faculty
      $qry1 = "UPDATE faculty_master SET fac_last_entry = '$f_date' WHERE faculty_id = $facid";
     //$qry1 = "INSERT INTO faculty_master (fac_last_entry) VALUES ('$f_date')";
      mysqli_query($db,$qry1);
      echo "<script>alert('date is $f_date and facid is $facid');</script>";
      echo "<script>alert('$count Students marked Absent');</script>";
    }
	else{
		echo mysqli_error($db);
	}
  }
else if($count==0)
{
  $query = "INSERT INTO att_master (att_date,att_crs_id,att_sem_id,att_div_id,att_lec_no,att_sub_id,att_fac_id,att_stud_id,att_stud_presence) VALUES ('$f_date',$crs,$sem,$div,$lecno,$subid,$facid,'*','P')";
  mysqli_query($db,$query);
  
  //updating last entry date in faculty master
  $qry2 = "UPDATE faculty_master SET fac_last_entry = '$f_date' WHERE faculty_id = $facid";
  mysqli_query($db,$qry2);
  echo "<script>alert('date is $f_date and facid is $facid');</script>";
  echo "<script>alert('All students are marked present');</script>";
}

}
?>