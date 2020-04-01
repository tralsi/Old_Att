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

  if(isset($_POST['submit']))
  {
    $frm_date = $_POST['frm_date'];
    $to_date =  $_POST['to_date'];

    echo $frm_date;
    echo "</br>";
    echo $to_date;
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
      <h4> Welcome , <?php echo $stud_name; ?> <a href="logout.php">logout</a></h4>
      </br>
      <form action="" method="POST">
      <div class="row">


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
            <input type="submit" value="Check Attendance" id="check_att"/>
            </div>
          <div class="col-md-4">&nbsp</div>
      </div>

      </form>
      </br>
      </br>
      <table class="table table-bordered table-condensed" style='width:75%; margin:auto'>
    <?php
        $sub_qry = "SELECT * FROM subject_master WHERE course=$stud_course AND sem=$stud_sem";
        $sub_res = mysqli_query($db,$sub_qry);
        $cnt=0;
        echo "<tr>";
        if($sub_res)
          {
            while($row= mysqli_fetch_assoc($sub_res))
              {
                $sub[$cnt] = $row['sub_name'];
                echo "<th class='text-center'> $sub[$cnt]</th>";
              //  att_qry = "SELECT "
                $cnt++;
              }
          echo "</tr>";
          }
          else
          {
            echo "No Subjects Found for Course". $stud_course . " and Sem ". $stud_sem ;
          }

          // count subjects
          if($cnt>0)
          {

          }
            
      ?>
      </table>
  </body>
</html>