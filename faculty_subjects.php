<?php
include('session.php');
if(isset($_SESSION['fac_full_name']))
    $fac_fullname = $_SESSION['fac_full_name'];
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/global.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-color"> 
   
   <div class="container"> 
	 <!-- <div class="navbar-header">  -->
	 <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-menu-hamburger navbar-color"></span>
				</a>

				<div class="navbar-brand"> 
					Welcome ,<span id="userid"> <?php echo ucwords(strtolower($fac_fullname)); ?></span>
				</div>

	  		 <ul class="dropdown-menu">
                <li><a href="welcome1.php" style="padding:10px"> <span class="glyphicon glyphicon-home" style="margin-right:10px"></span>Faculty Home</a></li>

				<!-- <li><a href="faculty_subjects.php" style="padding:10px"><span class="glyphicon glyphicon-book" style="margin-right:10px"></span> Subjects</a></li> -->
                
                <li role="separator" class="divider"></li>

                <li><a href="student_attendance.php" style="padding:10px">
                <span class="glyphicon glyphicon-education" style="margin-right:10px"></span> Student's Attendance</a></li>

                <li><a href="class_attendance.php" style="padding:10px">
                <span class="glyphicon glyphicon-list-alt" style="margin-right:10px"></span> Class Attendance</a></li>

            </ul>
          </li>
		</ul>
	
	
	   <!-- <ul class="nav navbar-nav navbar-center  navbar-brand">
		<li>Last entry date : 
			<span id='lastentrydate'>
			 <?php /* if($lastentrydate =='0000-00-00')
				echo "Not Available";
				else
			echo date_format($ledt,"M d, Y");*/
			?>
			</span>
		</li>
	   </ul> -->
	

	<ul class="nav navbar-nav navbar-right">
	  <li> <a href="logout.php" style="color:white" class=" text-large">
	  <span class="glyphicon glyphicon-log-out"></span> Logout</a>
	   </li>
	</ul>

	</div><!-- /.navbar-collapse -->
   </div> 
   </nav> 



<?php
if(isset($_SESSION['facid']))
{
    $fac_id = $_SESSION['facid'];

    //echo "<h1>Welcome,".$fac_id . "</h1>";
    $qry = "SELECT t1.`suballoc_fac_id`,t2.sub_name,t3.course_name,t1.`suballoc_sem`, t4.div_name, t1.suballoc_last_att_date FROM subject_allocation t1, subject_master t2, course_master t3, div_master t4 WHERE t1.`suballoc_sub_id` =  t2.sub_id AND t1.`suballoc_course_id`= t3.course_id AND t1.`suballoc_div`= t4.div_id AND t1.`suballoc_fac_id`=$fac_id ORDER BY `suballoc_course_id`, `suballoc_sem`, `suballoc_div`";
    $res = mysqli_query($db,$qry);
    if($res)
    {?>
    <div class="container">
    <table class="table table-bordered">
       <tr class="navbar-color text-center"><td>Course</td>
        <td>Sem</td>
        <td>Div</td>
        <td>Subject</td>
        <td>Att. Last Updated on</td>
        </tr>

        <?php
        while($row = mysqli_fetch_assoc($res))
        {

            echo "<tr class='text-center'>";
            echo "<td>". $row['course_name']."</td>";
            echo "<td>". $row['suballoc_sem']."</td>";
            echo "<td>". $row['div_name']."</td>";
            echo "<td>". $row['sub_name']."</td>";
            $dt_var = $row['suballoc_last_att_date'];
            if($dt_var=='0000-00-00')
            {
                echo "<td> NA </td>";
            }
            else
            {
                $dt = strtotime($dt_var);
                echo "<td>". date('d-M-Y',$dt) ."</td>";
            }
            
            echo "</tr>";
        }
    echo "</div>";  // Container div ends here 
    }
}
else
{
        echo "Invalid Session";
        return false;
}
$fac_id = $_SESSION['facid'];
echo "<center><h2>Allocated Subject Details</h2></center></br>";
?>