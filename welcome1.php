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
    <!-- <link rel="stylesheet" href="css/bootstrap-datepicker.css"> -->
		<!-- <link rel="stylesheet" href="css/style.css"> -->
		<link href="css/bootstrap_chkbox.css" rel="stylesheet"> <!-- added on 09-Dec-2018 -->
		<!-- <link href="css/datepicker-modified.css" rel="stylesheet"> -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/global.css" rel="stylesheet">


		<script src="js/jquery-1.12.4.min.js"></script>
		<!-- <script src="https://unpkg.com/@popperjs/core@2"> -->
		<!-- <script src="js/popper.min.js"></script> -->
		
		<!-- <script src="js/bootstrap-datepicker.js"></script> -->
		<script src="js/bootstrap-datepicker.min.js"></script>
		
		<script src="js/welcome.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- <script src="js/index.js"></script> -->

	<!-- Style added on 31/05/2020 for Datepicker width -->
	<style type="text/css">
   		
			/* .datepicker table tr td.new, .datepicker table tr td.old
				{
						height: 0;
						line-height: 0;
						visibility: hidden;
				} */

				.table-condensed
				{
						width: 285px;
						font-size: 14px;
						font-weight:lighter;
						color:black;
						/* border:1px solid blue; */
				}

				.myHoliday, td.day.disabled.myHoliday:hover
{
  /* background: orangered !important;
  color : white !important; */
  background:#FFA000!important;
  border-radius:50%!important;
  width:30px!important;
  height:30px!important;
  line-height:29px!important;
  color:#fff!important;
  cursor: not-allowed !important;
  /* display:inline-block !important;  */
  padding:0px !important;
  box-shadow:1px 1px 10px rgba(0,0,0,0.1)!important;
  margin:auto;

  /* margin:5px; */
}

.datepicker table tr td.day:hover, .datepicker table tr td.focused
{
  background:#03A9F4!important;
  border-radius:50%!important;
  width:30px!important;
  height:30px!important;
  line-height:29px!important;
  color:#fff!important;
  /* margin:5px !important;  */
  /* display:inline-block !important;  */
  box-shadow:1px 1px 10px rgba(0,0,0,0.1)!important;
  cursor: pointer !important;
  padding:0px !important;
  margin:auto;
}

.datepicker table tr td.disabled.day:hover,td.old.disabled.day:hover,td.new.disabled.day:hover
{
  background:lightgrey!important;
  border-radius:50%!important;
  width:30px!important;
  height:30px!important;
  line-height:29px!important;
  color:#fff!important;
  /* margin:5px !important;  */
  /* display:inline-block !important;  */
  box-shadow:1px 1px 10px rgba(0,0,0,0.1)!important;
  cursor: not-allowed !important;
  padding:0px !important;
  margin:auto;
}

			
    </style>
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
		
		
		<div class="row">&nbsp</div>
   
		<div class="row"> 
			
			<div class="col-md-3 col-md-offset-3 text-info text-right">
				<!-- <label for="datepicker1" class="form-control text-info"> -->
				<span class="glyphicon glyphicon-education text-large"></span>
				<strong style="vertical-align:middle"> Attendance for Date </strong> </label>
			</div>	
				
				<div class="input-group date col-md-3">
			
						<input class="form-control" type="text" id="datepicker1" width="220" data-container="body" data-toggle="tooltip" value=
										<?php
											if($lastentrydate !='0000-00-00')
											echo $nextdate;
											?>>
						<label class="input-group-addon" for="datepicker1">
								<span class="glyphicon glyphicon-calendar"></span>
						</label>
			
				</div>
			          
			<script type="text/javascript">
				$(function() {
					var holidays_date = new Array();
					var holidays_desc = new Array();
					
					$.ajax({
											type:'POST',
											dataType:'json',
											url:'getHolidays.php',
											success:function(response)
												{
													var len = response.length;
														for(var i=0; i<len; i++)
														{
															holidays_date[i] = response[i].date;
															holidays_desc[i] = response[i].desc;
														}
										//			var result = eval(data);
													// console.log(holidays_date);
													// console.log(holidays_desc);
												}
									}); 
						
						$('#datepicker1').datepicker({
							beforeShowDay: setHoliDays,
							format:"dd-mm-yyyy",
							autoclose:true,
							endDate:'0d',
							todayBtn:'linked',
							todayHighlight:true,
							daysOfWeekDisabled:'0',
							startDate:'-180d',
							}).on('show', function(){
							$("td.day.disabled.myHoliday").each(function(index, element){
							//	debugger;
								var $element = $(element);
							//	$element.attr("title", "Promo Date");
								$element.data("container", "body");
								$element.tooltip()
							});
						});
						
						function setHoliDays(date)
    				 {

							var year = date.getFullYear(), month = date.getMonth(), day = date.getDate();
						//	checkdate = day+"-"+month+"-"+year;
						
								
								// debugger;
								//var holiDays =[['23-03-2020','Happy Day'],['01-05-2020','New Years Day'],['14-04-2020','Pongal'],['25-12-2020','Christmas Day']];

														
									for (var i=0; i < holidays_date.length; i++)
									{
										str = holidays_date[i].split("-",3);
									
										if (day == str[0] && month == str[1] - 1 && year == str[2])
											{
												return{
													enabled: false, 
													classes:'myHoliday', 
													tooltip: holidays_desc[i],
												 };
											}
												
									}
							// $("td.day.disabled.myHoliday").attr("data-toggle","tooltip");
							return true;
							
     					}
							
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
					  
					  <select class='form-control' name='course' id='course' data-toggle="tooltip" title="Select Course" data-container="body">
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
					<select name="semester" id="semester" class="form-control" data-toggle="tooltip" title="Semester">
					<option value="">Sem</option>
					</select>
				
					<!-- &nbsp; <label>Division : </label> &nbsp; -->
					<select name="divsn" id="divsn" class="form-control" data-toggle="tooltip" title="Division">
					<option value="">Div</option>
					</select>
		   	
				<select class='form-control' name='lectureno' id='lecturno' placeholder="Lecture No" data-toggle="tooltip" title="Select Lecture No.">
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
		
				  
				<select class='form-control' name='subject' id='subject' data-toggle="tooltip" title="Select Subject">
				<option value=''>Subject</option>
				</select>
			
			<input type='button' class="form-control btn btn-info" value="List Students" name="show" id="show" data-toggle="tooltip" title="Click to List Students">
			<!--  onclick = 'ajaxFunction()' -->
			
			</br>
				</center>
				</form>
	</nav>
	</div>
	
	<div class="container" id="ajax-container"></br>
       <div id = 'ajaxDiv'></div>  
	</br>

	<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
    });
    </script>
	</body>
</html>