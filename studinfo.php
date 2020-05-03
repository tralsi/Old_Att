<?php
include('session.php');
//Listing Students based on subject, course & Semester
if(isset($_POST['subid']))  
{
  $fac_id = $_POST['facid'];
  $sub_id = $_POST['subid'];
  $qry = "SELECT * FROM subject_master WHERE subject_master.sub_id = $sub_id";
  $res = mysqli_query($db,$qry);
  if($res)
  {
  $row = mysqli_fetch_assoc($res);
  $sem = $row['sem'];
  $crs = $row['course'];
  $stud_qry = "SELECT roll_no FROM students WHERE sem_id = $sem AND course_id=$crs";
  $stud_res = mysqli_query($db,$stud_qry);
      if($stud_res)
      {
        while($row = mysqli_fetch_assoc($stud_res))
        {
          echo "<option value='".$row['roll_no']."'>".$row['roll_no']."</option>";
        }
      }
      else
      {
        echo "<option value=''>No Student found</option>";
      }
  }
  else
      {
        echo "<option value=''>No Student found</option>";
      }
}

if(isset($_POST['frmdate'])&& isset($_POST['todate']))
{
  $sub_id = $_POST['sub'];
  $rollno = $_POST['rollno'];
  $frm_date =  $_POST['frmdate'];
  $to_date = $_POST['todate'];

  $div_qry = "SELECT div_id FROM students WHERE students.roll_no = '$rollno'";
  $div_res = mysqli_query($db,$div_qry);
  if($div_res)
  {
  $row = mysqli_fetch_assoc($div_res);
  $div_id = $row['div_id'];
  }
  else
  {
    echo "Error in getting division ". mysqli_error($db);
  }
  
  $sub_qry = "SELECT sub_name FROM subject_master WHERE sub_id = $sub_id";
  $sub_res = mysqli_query($db,$sub_qry);
  if($sub_res)
  {
    $row = mysqli_fetch_assoc($sub_res);
    $sub_name = $row['sub_name'];
  }
  

  echo "<div col-md-10 col-md-offset-1><center>";
          echo "<span class='color-mygreen text-large' style='padding:15px;'>Attendance for ". $rollno . " from " .date('d-M-Y',strtotime($frm_date)) . " to ".date('d-M-Y',strtotime($to_date)). " in ". $sub_name. "</span></br>";
  echo "</center></div>";
  echo "</br></br>";


  echo "<table class='table table-bordered' id='rptable'>";
    echo "<thead>";
    echo "<tr class='text-center navbar-color'>";
      echo "<td class='text-center navbar-color'>Date</td>";
      
        // $days = (strtotime($to_date) - strtotime($frm_date))/86400;
        // $start_day = date('d',strtotime($frm_date));
        // $end_day = $start_day + $days;
        // for($i=$start_day; $i<= $end_day;$i++)
        //   {
        //   echo "<td class='navbar-color text-center'>".sprintf("%02s", $i)."</td>";
        //   }
        $curr_date = $frm_date;
        
        while($curr_date <= $to_date)
        {
          $day = date('d',strtotime($curr_date));
          echo "<td class='navbar-color text-center'>".sprintf("%02s", $day)."</td>";
          $curr_date = date('Y-m-d',strtotime('+1 day', strtotime($curr_date)));        
        }
       echo "<td class='navbar-color text-center'>Att/Total</td>";
       echo "<td class='navbar-color text-center'>Per(%)</td>";
       echo "</tr></thead>";
       echo "<tbody>";
       //Cheking attendance for the student for that perticular date for that subject
       $curr_date = $frm_date;
       echo "<tr class='text-center'><td class='navbar-color text-center'>Status</td>";
       while($curr_date <= $to_date)
          {
            
           // echo "r";
            $stud_att_qry = "SELECT * FROM student_attendance WHERE att_date='$curr_date' AND sub=$sub_id  AND `div` =$div_id";

            $stud_att_res = mysqli_query($db,$stud_att_qry);
            $num_rows = mysqli_num_rows($stud_att_res);

            if($stud_att_res)
            {
              if($num_rows>0)
              {
              
                if($num_rows==1)
                {
                  $row=mysqli_fetch_assoc($stud_att_res);
                  $lst = $row['abs'];
                  if(stripos($lst,$rollno)!==false)
                  {
                    echo "<td class='text-center text-danger'> <strong>A</strong></td>";
                  }
                  else
                  {
                    echo "<td class='text-center text-success'><strong>P</strong></td>";
                  }
                }
                else //more than one lecture for the same subject has been delivered by same faculty
                {
                  $str = "";
                  while($row=mysqli_fetch_assoc($stud_att_res))
                  {
                    $lst = $row['abs'];
                    $lect = $row['lec_no'];
                    if(stripos($lst,$rollno)!==false)
                      {
                        $str .= "<small><span class='text-danger'>A(" .$lect. ")&nbsp</span></small>";
                      }
                      else
                      {
                        $str .= "<small><span class='text-success'>P(" .$lect. ")&nbsp</span></small>";
                      }
                  }
                
                  echo "<td class='text-center'><strong>". $str . "</strong></td>";
                }
              }
              else
              {
                echo "<td class='text-center'>-</td>";
              }
            }
          $new_date =  strtotime('+1 day', strtotime($curr_date));
          $curr_date = date('Y-m-d',$new_date);
          }
         
          // Add Total Attendance & % Attendance at the end.
          $att_tot_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $div_id"; 

          $att_tot_res = mysqli_query($db,$att_tot_qry);
                 
              if($att_tot_res)
              {
                $sub_tot_att = mysqli_num_rows($att_tot_res);
                //$sub_total[$cnt] =  $sub_tot_att;
              }
              else{
                echo "Error from Total lectures section of studinfo.pho :". mysqli_error($db);
              }

          //This is to calculate & store Student's attendance for this subject
            
            $stud_sub_att_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $div_id AND FIND_IN_SET('$rollno',abs)";

          $stud_sub_att_res = mysqli_query($db,$stud_sub_att_qry);
           
            if($stud_sub_att_res)
            {
              $stud_sub_att = mysqli_num_rows( $stud_sub_att_res);
             
              // Subject Attendance / Total No. Of Lectures 
              echo "<td class='text-center'><strong>".($sub_tot_att-$stud_sub_att). " / ". $sub_tot_att."</strong></td>";
              
              if($sub_tot_att == 0)
                $per = 0;
                else
                $per=(($sub_tot_att-$stud_sub_att)/ $sub_tot_att)*100;
              
                if($per<75)
                  $frmt_str = 'text-danger';
              else
                  $frmt_str = 'text-success';
          
          echo "<td class='text-center $frmt_str' ><strong>". number_format($per, 2). "</strong></td>";
            }
            else
            {
              echo "Error from subjectwise attendance of studinfo.php :". mysqli_error($db);
            }


          echo "</tr>";
          echo "</tbody></table></br>";
       echo "<center>";
       echo "<input type='button' name='Excel_btn' id='to_excel' value='Export To Excel' class='btn btn-success' onclick='toExcel();'/> &nbsp &nbsp";
      
       echo "<input type='button' name='orientation' id='orientation' value='Change Orientation' class='btn btn-primary' onclick='changeOrientation();'/></center></br>";

}
else
{
  echo "No record found". mysqli_error($db);
}
?>