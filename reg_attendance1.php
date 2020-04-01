<?php
//This is being called from getabsnties function of welcome.js

include("configdb.php");
session_start();

// Retrieve data from Query String
if (isset($_POST['subjectid']))  // This is required to be changed
{
  $dt = $_POST['date'];
  $f_date=date('Y-m-d',strtotime($dt));  //convert it to mySQL format to store in table
	$crs = intval($_POST['course']);
	$sem = $_POST['sem'];
  $div = $_POST['div'];
  $lecno = $_POST['lecture'];
  $subid = $_POST['subjectid'];
  $facid = $_POST['facultyID'];
  $abs_array = array();
  //$abs_array = $_POST['abs_stud_arr'];

  // Check if another faculty has marked the attendance for same day, same course , same sem, div & same lecture  no

   $qry_att_check = "SELECT * FROM `student_attendance` WHERE (att_date='$f_date' AND course=$crs AND sem=$sem AND `div`=$div AND lec_no=$lecno)"; //div is in backtick as it is a reserve keyword in mySQL

  $res = mysqli_query($db,$qry_att_check);
  if($res)
    {
      $rc = mysqli_num_rows($res);
      if($rc>0)
      {
        $row = mysqli_fetch_assoc($res);
        $fid = $row['fac'];
        if($fid==$facid)
        {
          echo "You have already marked the attendance for this lecture.\n You can update the attendance by going to report and Edit it";
          return false;
        }
        else
        {
        $qry_fac_name = "SELECT * from faculty_master WHERE faculty_id = $fid";
        $fac_res = mysqli_query($db,$qry_fac_name);
        $fac_row = mysqli_fetch_assoc($fac_res);

        echo "Attendance for this lecture is already marked by ". $fac_row['faculty_salutation']. " " . $fac_row['faculty_fname'] ." ". $fac_row['faculty_lname'] ;

        return false;
        }
      }
    }

  if (isset($_POST['abslist']))  //if all students are present, this array may not pass any absent student roll no value
  {
    $abs_array = $_POST['abslist'];
  }
  
$count = count($abs_array); // if any student is absent . varibale can be removed later

if($count > 0)
  {
	  // If Individual records of each student is to be inserted
  /* foreach($abs_array as $abs_stud)
  {
    $query = "INSERT INTO att_master (att_date,att_crs_id,att_sem_id,att_div_id,att_lec_no,att_sub_id,att_fac_id,att_stud_id,att_stud_presence) VALUES ('$f_date',$crs,$sem,$div,$lecno,$subid,$facid,'$abs_stud','A')";
	
    mysqli_query($db,$query);
  } */
  
  // if single record for all the students using csv is to be inserted
  
   $vals = implode(',',$abs_array);
   
   $query = "INSERT INTO student_attendance (student_attendance.att_date,student_attendance.lec_no,student_attendance.course,student_attendance.sem,student_attendance.div,student_attendance.fac,student_attendance.sub,student_attendance.abs) VALUES ('$f_date',$lecno,$crs,$sem,$div,$facid,$subid,'$vals')";

       if(mysqli_query($db,$query))
      {
        //insert last attendance update date by faculty
        $qry1 = "UPDATE faculty_master SET fac_last_entry = '$f_date' WHERE faculty_id = $facid";
      //$qry1 = "INSERT INTO faculty_master (fac_last_entry) VALUES ('$f_date')";
        mysqli_query($db,$qry1);
        //echo "date is $f_date and facid is $facid');</script>";
        echo "$count Students marked Absent";
      }
    else{
      echo mysqli_error($db);
    }
  }  // if (count > 0) ends here
else if($count==0)
{
  $query = "INSERT INTO student_attendance (att_date,lec_no,course,sem,`div`,fac,sub,abs) VALUES ('$f_date',$lecno,$crs,$sem,$div,$facid,$subid,'*')";
  $res = mysqli_query($db,$query);
  if($res)
    {
      echo "All students are marked present";
    }

   //updating last entry date in faculty master
  $qry2 = "UPDATE faculty_master SET fac_last_entry = '$f_date' WHERE faculty_id = $facid";
  mysqli_query($db,$qry2);
  //echo "<script>alert('date is $f_date and facid is $facid');</script>";
  
}

}
?>