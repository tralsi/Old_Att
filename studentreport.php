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

  // if(isset($_POST['submit']))
  // {
    // $frm_date = $_POST['frm_date'];
    // $to_date =  $_POST['to_date'];
    // echo $frm_date;
    // echo "</br>";
    // echo $to_date;
  //  echo $_POST['name'];
// }
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
      <h4> Welcome , <?php echo $stud_name; ?> <a href="logout.php">logout</a></h4>
      </br>
      <form action="" method="POST">
      <div class="row">

          <!-- <input type="text" id="name" name="name"> -->

          <div class="col-md-4 col-md-offset-2"><label for="frm_date">From : </label>
          <input type="date" id="frm_date" name="frm_date"/>
          </div>

          <div class="col-md-4"><label for="to_date">To : </label>
          <input type="date" id="to_date" name="to_date"/>
          </div>

          <div class="col-md-2"></div>
      </div>
      
      <div class="row">&nbsp</div>

      <div class="row">
          <div class="col-md-4">&nbsp</div>
            <div class="col-md-4">
            <input type="submit" name="submit" value="Check">
            </div>
          <div class="col-md-4">&nbsp</div>
      </div>

      </form>
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
                //echo $sub[$cnt];
               // echo "<th class='text-center'> $sub[$cnt]";

               //This is to calculate & store total no. of lectures in an associative array for this subject in this division
                //$sub_total = array();
                $att_tot_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $stud_div";
                $att_tot_res = mysqli_query($db,$att_tot_qry);
                 
                if($att_tot_res)
                    {
                      $sub_tot_att = mysqli_num_rows($att_tot_res);
                      $sub_total[$cnt] =  $sub_tot_att;
                    //  echo " (".$sub_total[$sub_id]. ")</th>"; 
                    }
                  else{
                   // echo "</th></tr>"; 
                    echo "Error from Total lectures section of student report.php :". mysqli_error($db);
                    }

                //This is to calculate & store Student's attendance in an associative array for this subject
                //$stud_att = array();
                $stud_sub_att_qry = "SELECT * FROM student_attendance WHERE att_date >= '$frm_date' AND att_date <= '$to_date' AND sub=$sub_id AND `div`= $stud_div AND FIND_IN_SET('$stud_id',abs)";

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
            echo "<td class='text-center'><strong>".$sub_att[$i]. " / ".$sub_total[$i]. "</strong></td>";
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
            $per = ($sub_att[$i] / $sub_total[$i])*100;
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

        }
         ?> 
      </table>
      
  </body>
</html>