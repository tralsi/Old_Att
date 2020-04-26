<?php
include('session.php');

if(isset($_POST['subid']))
{
  $sub_id=$_POST['subid'];
  $fac_id=$_POST['facid'];

  $sem_qry="SELECT DISTINCT suballoc_sem FROM subject_allocation WHERE suballoc_fac_id=$fac_id AND suballoc_sub_id=$sub_id ORDER BY suballoc_sem, suballoc_div";

  $sem_res = mysqli_query($db,$sem_qry);

  if($sem_res)
  {
    echo "<option value='' disabled selected hidden>Sem</option>";
    while($row = mysqli_fetch_assoc($sem_res))
    {
      echo "<option value='". $row['suballoc_sem']."'>".$row['suballoc_sem']. "</option>";
    }
  }
  else
  {
    echo "error from classcombo.php". mysqli_error($db);
  }
}

if(isset($_POST['semid']))
{
  $sem_id = $_POST['semid'];
  $sub_id = $_POST['sub_id'];
  $fac_id = $_POST['fac_id'];

  $div_qry = "SELECT t1.suballoc_fac_id, t1.suballoc_div, t2.div_name FROM `subject_allocation` t1, div_master t2 WHERE t1.suballoc_fac_id=$fac_id AND t1.suballoc_sub_id=$sub_id AND t1.suballoc_div = t2.div_id";

  $div_res = mysqli_query($db,$div_qry);

  if($div_res)
  {
    while($row = mysqli_fetch_assoc($div_res))
    {
      echo "<option value='". $row['suballoc_div']."'>".$row['div_name']. "</option>";
    }
  }
  else
  {
    echo "error from classcombo.php". mysqli_error($db);
  }
}


if(isset($_POST['frm_date']) && isset($_POST['to_date']))
{
  $fac_id = $_POST['fac_id'];
  $sub_id = $_POST['sub_id'];
  $sem_id = $_POST['sem_id'];
  $div_id = $_POST['div_id'];
  $frm_date = $_POST['frm_date'];
  $to_date = $_POST['to_date'];

  $qry_crs = "SELECT course,sub_name FROM subject_master WHERE sub_id=$sub_id";
  $res_crs = mysqli_query($db,$qry_crs);
  $row = mysqli_fetch_assoc($res_crs);

  $crs_id = $row['course'];
  //echo "Inside classcombo.php";

  echo "<div col-md-10 col-md-offset-1><center>";
          echo "<span class='color-mygreen text-large' style='padding:15px;'>Attendance for ". $row['sub_name'] . " from " .date('d-M-Y',strtotime($frm_date)) . " to ".date('d-M-Y',strtotime($to_date)). " </span></br>";
  echo "</center></div>";
  echo "</br></br>";


  ?>
  

  <table class="table table-bordered" id="rptable">
    <thead>
    <tr class='text-center navbar-color'>
      <td>Roll No./Date</td>
      <?php
        $days = (strtotime($to_date) - strtotime($frm_date))/86400;
        $start_day = date('d',strtotime($frm_date));
        $end_day = $start_day + $days;
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
       echo "</tr></thead>";
       echo "<tbody>";

       $studlist_qry = "SELECT * FROM students WHERE course_id=$crs_id AND sem_id=$sem_id AND div_id = $div_id AND status='A'";

       $studlist_res = mysqli_query($db,$studlist_qry);
       if($studlist_res)
       {
        while($row = mysqli_fetch_assoc($studlist_res))
        {
          echo "<tr class='text-center'><td class='navbar-color text-center'>".$row['roll_no']. "</td>";
          $stud_id = $row['roll_no'];
          //checking attendance for the same student for all days
          $cur_date = $frm_date;
          //for($j=$start_day; $j<= $end_day; $j++)
          while($cur_date <= $to_date)
          {
           // echo "$cur_date";
            $tot_att_qry = "SELECT * FROM student_attendance WHERE att_date='$cur_date' AND sub=$sub_id  AND `div` =$div_id";

            $tot_att_res = mysqli_query($db,$tot_att_qry);
            $num_rows = mysqli_num_rows($tot_att_res);
            //echo "num rows =".$num_rows;
            if($tot_att_res)
            {
              if($num_rows>0)
              {
                if($num_rows==1)
                {
                  $row=mysqli_fetch_assoc($tot_att_res);
                  $lst = $row['abs'];
                  if(stripos($lst,$stud_id)!==false)
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
                  while($row=mysqli_fetch_assoc($tot_att_res))
                  {
                    $lst = $row['abs'];
                    $lect = $row['lec_no'];
                    if(stripos($lst,$stud_id)!==false)
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
            else
            {
              echo "error Unable to get dataset ". mysqli_error($db);
            }
          $new_date =  strtotime('+1 day', strtotime($cur_date));
          $cur_date = date('Y-m-d',$new_date);
          } // Day for loop ends here

        }
        echo "</tr>";
      }
      else
      {
        echo "No Students available for this class";
      }
       echo "</tbody></table></br>";
       echo "<center>";
       echo "<input type='button' name='Excel_btn' id='to_excel' value='Export To Excel' class='btn btn-success' onclick='toExcel();'/></center></br>";
}

?>