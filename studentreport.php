<?PHP
include('session.php');

$stud_id= $_SESSION['login_user'];
$stud_qry = "SELECT * FROM students WHERE roll_no='$stud_id'";
$stud_res = mysqli_query($db,$stud_qry);
if($stud_res)
  {
    $stud_row = mysqli_fetch_assoc($stud_res);
    $stud_name = $stud_row['stud_name'];
    $stud_course = $stud_row['course_id'];
    $stud_sem = $stud_row['sem_id'];
    $stud_div = $stud_row['div_id'];
  }

?>

<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/global.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>

    <title>Attendance Report</title>
  </head>
 
  <body>

    <nav class="navbar navbar-color navbar-fixed"> 
   
    <div class="container"> 
      <div class="navbar-header"> 
        <a class="navbar-brand" href="#" style="color:white">Welcome , <?php echo ucwords(strtolower($stud_name)) ." ( ". $stud_id . " )" ; ?> </a> 
      </div> 

     <ul class="nav navbar-nav navbar-right">
     
       <li> <a href="logout.php" style="color:white" class=" text-large">
       <span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </li>
     </ul>
    
    </div> 
    </nav> 


      <div class="container" style="margin:auto">
      <center>   
        <div class="row" style="text-align:center; vertical-align: middle">
        
          <!-- <div class="col-md-2"></div> -->
          <div class="col-md-10 col-md-offset-1">
          <form action="" method="POST" class="form-inline form-container mt-4" role="form">  
          
          <div class="form-group">
            <strong> Attendance for Roll No. 
             <span class="text-primary text-large"><?php echo $stud_id ?></span>
            </strong>
          </div>
    
          <div class="form-group ml-4">
            <label for="frm_date">From : </label>
            <input type="date" id="frm_date" name="frm_date" class="form-control"/>
          </div>
        
          <div class="form-group ml-4">
            <label for="to_date">To : </label>
            <input type="date" id="to_date" name="to_date" class="form-control"/>
          </div>

          <input type="submit" name="submit" value="Check" class="btn btn-info ml-4">
          
        <!-- </div> -->

        <!-- <script type="text/javascript">
				$(function() {
						$('#frm_date').datepicker({format:"dd-mm-yyyy",autoclose:true,endDate:'0d',todayBtn:'linked',todayHighlight:true,daysOfWeekDisabled:'0'});
						//$('#datetimepicker1').datetimepicker("show");
				});

        $(function() {
						$('#to_date').datepicker({format:"dd-mm-yyyy",autoclose:true,endDate:'0d',todayBtn:'linked',todayHighlight:true,daysOfWeekDisabled:'0'});
						//$('#datetimepicker1').datetimepicker("show");
				});
			</script> -->
          
      </form>
      </div>
      
      </div> <!-- row div -->
      </center>
      </div> <!-- Container div -->
      </br>
      </br>
      
     
     <?php
        if(isset($_POST['submit']))
        {
        $frm_date = $_POST['frm_date'];
        $to_date =  $_POST['to_date'];

        $sub_qry = "SELECT * FROM subject_master WHERE course=$stud_course AND sem=$stud_sem";
        $sub_res = mysqli_query($db,$sub_qry);
        $cnt=0;

        $sub = array();
        $sub_total = array();
        $stud_att = array();
       // echo "<tr>";
        if($sub_res)
          {
            while($row= mysqli_fetch_assoc($sub_res))
              {
                $sub[$cnt] = $row['sub_name'];
                $sub_id = $row['sub_id'];
                $sub_id_arr[$cnt] = $sub_id;  //Array of Subject Ids for use in detailed report
               
               //This is to calculate & store total no. of lectures in an associative array for this subject in this division
                //$sub_total = array();
                $att_tot_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $stud_div"; // GROUP BY att_date ORDER BY row_id
                $att_tot_res = mysqli_query($db,$att_tot_qry);
                 
                if($att_tot_res)
                    {
                      $sub_tot_att = mysqli_num_rows($att_tot_res);
                      $sub_total[$cnt] =  $sub_tot_att;
                      
                    }
                  else{
                      echo "Error from Total lectures section of student report.php :". mysqli_error($db);
                    }

                //This is to calculate & store Student's attendance in an associative array for this subject
                //$stud_att = array();
                $stud_sub_att_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $stud_div AND FIND_IN_SET('$stud_id',abs)";// GROUP BY att_date ORDER BY row_id

                $stud_sub_att_res = mysqli_query($db,$stud_sub_att_qry);
               
                if($stud_sub_att_res)
                {
                  $stud_sub_att = mysqli_num_rows( $stud_sub_att_res);
                  $sub_att[$cnt] =  $stud_sub_att;
                }
                else
                {
                  echo "Error from subjectwise attendance of student report.php :". mysqli_error($db);
                }
           
             $cnt++;
            }
        //  echo "</tr>";
          }
          else
          {
            echo "No Subjects Found for Course". $stud_course . " and Sem ". $stud_sem ;
          }

          // Displaying Sujectwise Total Lectures & Respective attendance of the student
          

          echo "<table class='table table-bordered table-hover table-condensed' style='width:75%; margin:auto'>";
          echo "<tr class='info'>";
          echo "<th class='text-center'>Subject</th>";
          
          //Displaying Subject name as a row header
          for($i=0;$i<$cnt;$i++)
          {
            echo "<th class='text-center'>$sub[$i]";
            //echo " (".$sub_total[$i]. ")</th>";
          }
          echo "</tr>";

          echo "<tr>";
          echo "<th class='info text-center'> Att. / Total Lect. </th>";
          for($i=0;$i<$cnt;$i++)
          {
            echo "<td class='text-center'><strong>". ($sub_total[$i] - $sub_att[$i]) . " / ".$sub_total[$i]. "</strong></td>";
            //echo " (".$sub_total[$sub_id]. ")</tr>";
          }
          echo "</tr>";

          //Calculating % attendance
          echo "<tr>";
          echo "<th class='info text-center'> Percentage (%) </th>";
          for($i=0;$i<$cnt;$i++)
          {
            if($sub_total[$i] == 0)
              $per = 0;
            else
            {
              $present = $sub_total[$i]-$sub_att[$i];
              $per = ( $present / $sub_total[$i])*100;
            }
            //$per = ($sub_att[$i] / $sub_total[$i])*100;
            if($per<75)
            {
              $frmt_str = 'text-danger';
            }
            else
            {
              $frmt_str = 'text-success';
            }
            echo "<td class='text-center $frmt_str' ><strong>". number_format($per, 2). " % </strong></td>";
            //echo " (".$sub_total[$sub_id]. ")</tr>";
          }
          echo "</tr>";
          echo "</table>";
          echo "</br></br>";
        echo "</div>"; // Container Div
        
        // Detailed report
       
        echo "<table class='table table-bordered table-hover table-condensed' style='width:75%; margin:auto'>";
        echo "<tr class='info'>";

        $days = (strtotime($to_date) - strtotime($frm_date))/86400;

        if($days <0)
          {
            echo "Selected From Date must be before To date";
            return false;
          }
   
        $start_day = date('d',strtotime($frm_date));
        $end_day = $start_day + $days;
        echo "<th class='text-center'>Date / Sub (Lec) </th>";
        for($i=$start_day; $i<= $end_day;$i++)
          {
          echo "<th class='text-center'>".sprintf("%02s", $i)."</th>";
          }
       echo "</tr>";

    
       //Second Row in detailed report
       for($i=0;$i<$cnt;$i++)
          {
            //for each subject start a new row 
              echo "<tr>";
              //Shorten the subject name upto 4 chars only
              if(strlen($sub[$i])>4)
                  $sub_name=substr($sub[$i],0,4);
              else
                  $sub_name = $sub[$i];
              
              $att_array = array();
              $subId = $sub_id_arr[$i];
              echo "<th class='text-center'>$sub_name</th>";

              $cur_date = $frm_date;

             // $tot_att_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$subId  AND student_attendance.div=$stud_div";
            


              // if($tot_att_res)
              //   {
                  
              //     //  while($tot_att_row = mysqli_fetch_assoc($tot_att_res))
              //       //{
              //        // echo $tot_att_row['att_date']."</br>";
              //       //}
              //     //echo "total att reco =".$tot_att_row;
              //     $dt = $tot_att_row['att_date']; // Exact Date
              //     $short_dt = (int)substr($dt,8,2); //  2 digits of date
              //    // echo "date = " .$dt. "</br>";
              //     //echo substr($dt,8,2)."</br>";
              //   }
              // else
              // {
              //   echo "Error getting list :".mysqli_error($db);
              // }

              //for each subject for selected number of days
              for($j=$start_day; $j<= $end_day; $j++)
                  {
             
                    $tot_att_qry = "SELECT * FROM student_attendance WHERE att_date='$cur_date' AND sub=$subId  AND student_attendance.div=$stud_div";

                    $tot_att_res = mysqli_query($db,$tot_att_qry);
                    $num_rows = mysqli_num_rows($tot_att_res);
                    if($num_rows>0)
                    {
                      //echo "<td class='text-center'>Y</td>";
                      if($num_rows==1)
                        {
                         $row=mysqli_fetch_assoc($tot_att_res);
                         $lst = $row['abs'];
                          if(stripos($lst,$stud_id)!==false)
                            echo "<td class='text-center text-danger'><strong>A</strong></td>";
                          else
                            echo "<td class='text-center text-success'><strong>P</strong></td>";
                        }
                      else
                      {
                        $str = "";
                        while($row=mysqli_fetch_assoc($tot_att_res))
                        {
                          $lst = $row['abs'];
                          $lect = $row['lec_no'];
                          
                          if(stripos($lst,$stud_id)!==false)
                            {
                              $str .= "<small><span class='text-danger'>A(" .$lect. ")&nbsp</span></small>";
                              //echo "<td class='text-center text-danger'>A(" .$lect. ")";
                            }
                          else
                            {
                              $str .= "<small><span class='text-success'>P(" .$lect. ")&nbsp</span></small>";
                              //echo "<td class='text-center text-success'>P(".$lect.")";
                            }
                            
                        }
                        echo "<td class='text-center'><strong>". $str . "</strong></td>";
                      }
                      
                    }
                    else
                    {
                      echo "<td class='text-center'>-</td>";
                    }

                   // echo $cur_date."</br>";
                    $new_date =  strtotime('+1 day', strtotime($cur_date));
                   // $cur_date = date_format(strtotime($new_date),'Y-m-d');
                  //  echo "j= ". $j. " ";
                    $cur_date = date('Y-m-d',$new_date);
                   // echo $cur_date;

                    //increment Current Date



                    //$row = mysqli_fetch_assoc($tot_att_res);
                    //$sub_row= mysqli_fetch_assoc($sub_res);
                 //   $sub_cnt = mysqli_num_rows($sub_res);
                    
                    // echo "Sub_cnt = ".$sub_cnt;
                    // echo "SubId = ".$subId;
                   
                    
                    
                      // if($i==$dt)
                      //   {
                      //     echo "<td>Y</td>";
                      //   }
                      //   else
                      //   {
                      //     echo "<td>-</td>";
                      //   }
                  } //Day for  loop ends

              echo "</tr>";

        } //Subject count for loop ends here
      } //If isset _POST[submit] ends here
      
      ?>
  </body>
</html>