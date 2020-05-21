<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap_chkbox.css" rel="stylesheet"> <!-- added on 09-Dec-2018 -->
	<link href="css/global.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
		<script src="js/welcome.js"></script>

    <title>Welcome </title>
  </head>
   
   <body>
   
   <?php
		$user = $login_session;
		$qry_fac = "SELECT * FROM faculty_master WHERE faculty_shortname ='$user'";
		$res=mysqli_query($db,$qry_fac);
		if($res)
		{
			$rc = mysqli_num_rows($res);
		}
		else
		{
			echo "<script>Invalid User</script>";
			return false;
		}
		
		if($rc > 0)
		{
			$row = mysqli_fetch_assoc($res);
			$fac_id = $row['faculty_id'];
			$_SESSION['facid']=$fac_id;
			$fac_fullname = $row['faculty_salutation']. " ". $row['faculty_fname']. " ". $row['faculty_lname'];
			$_SESSION['fac_full_name']=$fac_fullname; // will require on faculty_subjects.php navbar
			$lastentrydate = $row['fac_last_entry'];
		
			if($lastentrydate !='0000-00-00')	
			{

			$dt = strtotime($lastentrydate);
			$nextdate= date("d-m-Y",strtotime("+1 day", $dt)); // Next date for default entry date
			$ledt = date_create_from_format('Y-m-d',$lastentrydate); // converts to date object from String
			}

			$qry_sub = "SELECT * FROM subject_allocation WHERE suballoc_fac_id ='$fac_id'";
			$res_sub = mysqli_query($db,$qry_sub);
			if(	$res_sub)
			{
				$sub_rc= mysqli_num_rows($res_sub);
			}
		}
?>

<nav class="navbar navbar-color"> 
   <div class="container"> 
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
				 <!-- <li><a href="welcome1.php" style="padding:10px"> <span class="glyphicon glyphicon-home" style="margin-right:10px"></span>Faculty Home</a></li> -->

				<li><a href="faculty_subjects.php" style="padding:10px"><span class="glyphicon glyphicon glyphicon-book" style="margin-right:10px"></span> Subjects</a></li>

				<li><a href="student_attendance.php" style="padding:10px">
				<span class="glyphicon glyphicon glyphicon-education" style="margin-right:10px"></span> Student's Attendance</a></li>
		
				<li><a href="class_attendance.php" style="padding:10px">
					<span class="glyphicon glyphicon-list-alt" style="margin-right:10px"></span> Class Attendance</a>
				</li>
				<!-- <li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">One more separated link</a></li> -->
            </ul>
          </li>
		</ul>
	
	
	   <ul class="nav navbar-nav navbar-center  navbar-brand">
		<li>Last entry date : 
			<span id='lastentrydate'>
			 <?php if($lastentrydate =='0000-00-00')
				echo "Not Available";
				else
			echo date_format($ledt,"M d, Y");
			?>
			</span>
		</li>
	   </ul>
	

	<ul class="nav navbar-nav navbar-right">
	  <li> <a href="logout.php" style="color:white" class=" text-large">
	  <span class="glyphicon glyphicon-log-out"></span> Logout</a>
	   </li>
	</ul>

	</div><!-- /.navbar-collapse -->
   </div> 
   </nav> 

   		
   <div class="container form-container">
   <input type="hidden" id="facid" value=<?php echo $fac_id ?> />
		<!-- <div class="row text-info">
			<strong>
			<div class="col-md-4">Welcome
				<span id="userid"> <?php //echo $fac_fullname; ?> </span>
			</div>
				
			<div class="col-md-4">Last entry date :
				<span id='lastentrydate'> <?php /* if($lastentrydate =='0000-00-00')
				 					echo "Not Available";
							 else
									echo date_format($ledt,"M d, Y");*/
				  ?>
				</span>
			</div>
			
			<div class="col-md-4" style="text-align:right">
				<a href="logout.php">Sign Out</a>
			</div>
			</strong>
		</div> -->
		
		<div class="row">&nbsp</div>
   
		<div class="row"> 
			
			<div class="col-md-3 col-md-offset-3 text-info text-right">
				<!-- <label for="datepicker1" class="form-control text-info"> -->
				<span class="glyphicon glyphicon-education text-large"></span>
				<strong style="vertical-align:middle"> Attendance for Date </strong> </label>
			</div>	
				
				<div class="input-group date col-md-3">
			
						<input class="form-control" type="text" id="datepicker1" value=
										<?php
											if($lastentrydate !='0000-00-00')
											echo $nextdate;
											?>>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
			
				</div>
			          
			<script type="text/javascript">
				$(function() {
						$('#datepicker1').datepicker({format:"dd-mm-yyyy",autoclose:true,endDate:'0d',todayBtn:'linked',todayHighlight:true,daysOfWeekDisabled:'0'});
						//$('#datetimepicker1').datetimepicker("show");
				});
			</script>
			</div> <!-- row div ends here -->
	
	</br>
        
	<nav class="navbar" style="background-color:#337AB7; color:white;">
		
			<form class="navbar-form navbar" method="POST" name="f1">
				<center>
					<?php
					 // Getting Course information from Mysql table for course combo box //
					$query= $db->query("SELECT DISTINCT course_name,course_id FROM course_master order by course_id"); 
					$rowCount = $query->num_rows;
					
					?>
					  <!-- <label>Course : </label> &nbsp; -->
					  
					  <select class='form-control' name='course' id='course'>
						<option value=''>Course</option>
					 
						<?php
						if($rowCount > 0){
						while($row = $query->fetch_assoc()){ 
							echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
						}
						}else{
							echo '<option value="">Course not available</option>';
						}
						?>
					</select>
				
				<!-- &nbsp; <label>Semester : </label> &nbsp; -->
					<select name="semester" id="semester" class="form-control">
					<option value="">Sem</option>
					</select>
				
					<!-- &nbsp; <label>Division : </label> &nbsp; -->
					<select name="divsn" id="divsn" class="form-control">
					<option value="">Div</option>
					</select>
		   	
				<select class='form-control' name='lectureno' id='lecturno' placeholder="Lecture No">
					<option value=''>Lecture No.</option>
					<?php
					$qry_lec = $db->query("SELECT DISTINCT lecture_no,lecture_time FROM lectures order by lecture_no"); 
					$rcnt = $qry_lec->num_rows;
					
					if($rcnt > 0){
						while($row = $qry_lec->fetch_assoc()){ 
							echo '<option value="'.$row['lecture_no'].'">'. $row['lecture_no'].' - '. $row['lecture_time'].'</option>';
						}
						}else{
							echo '<option value="">Lecture not available</option>';
						}
					?>
					
				</select>
		
				  
				<select class='form-control' name='subject' id='subject'>
				<option value=''>Subject</option>
				</select>
			
			<input type='button' class="form-control btn btn-info" value="List Students" name="show" id="show">
			<!--  onclick = 'ajaxFunction()' -->
			
			</br>
				</center>
				</form>
	</nav>
	</div>
	
	<div class="container" id="ajax-container"></br>
       <div id = 'ajaxDiv'></div>  
	</br>
	</body>
</html>