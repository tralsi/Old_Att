<?php
   include('session.php');
   //include('configdb.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap_chkbox.css" rel="stylesheet">  <!-- added on 09-Dec-2018 -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
		<!-- <script src="js/welcome.js"></script> -->
    
    <title>Welcome </title>
     
   </head>
   
   <body>
   <div class="container" style="margin-top:10px;border:1px solid green">
		<div class="row" style="color:#337AB7"> 
			<div class="col-md-3">Welcome 
			
			<?php
				
				$qry1 = $db->query("SELECT * FROM faculty_master WHERE faculty_shortname='$login_session'");
				//$rc=$qry1->num_rows;
				// $rowCount = $query->num_rows;
				while($r1 = $qry1->fetch_assoc())
				{
					echo $r1['faculty_fname'].' '.$r1['faculty_lname'];
					$fac_id = $r1['faculty_id']; //used for fetching faculty's allocated subjects in subject pop down box
					
				//	$dt = $r1['fac_last_entry'];
				//	echo $dt;
				//	$f_dt = strtotime($dt);
				//	echo $f_dt;
				//echo strtotime($dt);
						if(strtotime($r1['fac_last_entry']) > 0)
						{
							$last_session_entry_date = date('d M, Y',strtotime($r1['fac_last_entry']));
						}
						else {
							$last_session_entry_date='';
						}
					}
				
			?>
			
			
		</div>
		<div class="col-md-7">Last Session entry date : <?php echo $last_session_entry_date;?></div>
		<div class="col-md-2" style="text-align:right"><a href = "logout.php">Sign Out</a></div>
		</div>
		
		</br>
      
      
	<nav class="navbar" style="background-color:#337AB7; color:white;">
					
			<form class="navbar-form navbar-left" method="POST" name="f1">
				
				<span class="glyphicon glyphicon-education navbar-brand" style="color:white; vertical-align:middle; font-size:30px"></span>
				
				<div class='input-group date' id='datepicker1'>
						<input class='form-control' type='text' id='myDate'/>
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</div>
				
          
              <script type="text/javascript">
                $(function() {
                    $('#datepicker1').datepicker({format:"dd-mm-yyyy",autoclose:true,endDate:'0d',todayBtn:'linked',todayHighlight:true,daysOfWeekDisabled:'0'});
                    //$('#datetimepicker1').datetimepicker("show");
                });
              </script>
				
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
		   		
				
				
				
					<!-- &nbsp; <label>Date :</label> &nbsp; -->
						

				<select class='form-control' name='lectureno' id='lectureno' placeholder="Lecture No">
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
				
				
				<!-- <label>Subject : </label> &nbsp; -->
					  
					  <select class='form-control' name='subject' id='subject' placeholder="Subject">
						<!-- <option value=''>Subject</option> -->
						<!-- added on 07 April 2019  -->
						
					
						</select>
						
					
				
			<input type='button' class="form-control btn btn-info" value="List Students" name="show" id="show">
			<!--  onclick = 'ajaxFunction()' -->
			
			</br>
				
		</form>
					
			</nav>
	
       <div id = 'ajaxDiv'>Your result will display here  <!-- div will be closed by ajax html with register button -->
	   </br>
	   
	</body>

	<script>
				$(document).ready(function(){
			
			$('#course').on('change',function(){
			var courseID = $(this).val();
				if(courseID){
					$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:'course_id='+courseID,
					success:function(html){
                    $('#semester').html(html);
										$('#divsn').html('<option value="">Div</option>'); 
										$('#subject').html('<option value="">Subject</option>');
					}}); 
				}else{
					$('#semester').html('<option value="">Sem</option>');
					$('#divsn').html('<option value="">Div</option>'); 
				}
			});
			
	
			$('#semester').on('change',function(){
			$('#ajaxDiv').empty();
			var semID = $(this).val();
			var crsID = $('#course').val();
			
			//alert(facID);
				if(semID)
				{
				$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:'semester_id='+semID+'&crs_id='+ crsID,
					success:function(html){
						$('#divsn').html(html);
						$('#subject').html('<option value="">Subject</option>');
					}
					}); 
				}else{
				$('#divsn').html('<option value="">Division Not Available</option>'); 
				}
			});
			
			$('#divsn').on('change',function(){
					$('#ajaxDiv').empty();
					var semID = $('#semester').val();
					var crsID = $('#course').val();
					var facID = '<?php echo $fac_id; ?>';
					var divID = $(this).val();
					//alert(facID);
					if(divID)
					{
					$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:'s_id='+semID+'&c_id='+ crsID+ '&fac_id='+facID + '&d_id='+divID,
					success:function(html)
							{
							$('#subject').html(html);
							}
					}); 
				}else{
				$('#subject').html('<option value="">Subject Not Available</option>'); 
				}

			});
			
			$("#show").on('click',function(){
			var dt = $("#myDate").val();
			var courseID = $("#course").val();
			var semID = $("#semester").val();
			var divID = $("#divsn").val();
			var lectureno = $("#lectureno").val();
			var subject = $("#subject").val();

			if (!dt)
			{
 				alert('Please Select Date');
				$("#datepicker1").focus();
			}
			else if(courseID == '')
			{
				alert('Please Select Course');
				$("#course").focus();
			}
			else if(semID == '')
			{
				alert('Please Select Semester');
				$("#semester").focus();
			}
			else if(divID =='')
			{
				alert('Please Select Division');
				$("#divsn").focus();
			}
			else if(lectureno =='')
			{
				alert('Please Select Lecture No.');
				$("#lectureno").focus();
			}
			else if(subject =='')
			{
				alert('Please Select Subject');
				$("#subject").focus();
			}
			
				if(subject){
					$.ajax({
					type:'POST',
					url:'ajax-example1.php',
					data : {
						crs : courseID,
						sem : semID,
						divsn : divID,
					},
					//data:'crs='+courseID+'&sem='+semID+'&divsn='+divID,
					success:function(html){
                    $('#ajaxDiv').html(html);
                    
					}}); 
				}else{
					$('#ajaxDiv').html('Your result will display here ... from Jquery');
					 }
			});

						
		});

		function getAbsentees()
		{
			//alert("call received");
			var dt = $("#myDate").val();
			var courseID = $("#course").val();
			var semID = $("#semester").val();
			var divID = $("#divsn").val();
			var lectureno = $("#lectureno").val();
			var subject = $("#subject").val();
			var facID = '<?php echo $fac_id; ?>';
			var absent=[];

				$.each($("input[name='student']:checked"),function(){
				absent.push($(this).val());
			});

			len = absent.length;
			
			if(len==0)
			{
				ans = confirm("Are All the students present in the class ?");
			}else
			{
				ans = confirm("Absentees : " + absent.join(", "));
			}

			if(ans)
				{
					$.ajax({
						type:'POST',
						url:'reg_attendance.php',
						data : {
							date_dt: dt,
							crs_id : courseID,
							sem_id : semID,
							div_id : divID,
							lec_no : lectureno,
							sub_id : subject,
							fac_id : facID,
							abs_stud_arr: absent,
						},
					
						success:function(html){
											console.log(html);
											$('#ajaxDiv').html(html);
											
						}}); 
				}
			}
		
	
		
			
	
	</script>
   
</html>