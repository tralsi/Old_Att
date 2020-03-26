<?php
  // include('session.php');
   include('configdb.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Subject Allocation </title>
	<link rel="stylesheet" href="css/bootstrap.css">
	 <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/class_sem_div.js"></script>
	<style>
		#delete_row:hover{color:red;}
		#edit_row:hover{color:green;}
	</style>


</head>

<body>
<div class="container" style="border:1px solid lightgray;padding:15px;border-radius:5px">

	<div class="row text-center">
		<h4>Subject & Class Allocation for</h4>
	</br>	
	
		<div class="col-sm-4 col-sm-offset-4" align="center">
		  <select class='form-control input-lg' name='faculty' id='faculty' style=" text-align-last: center;
   text-align: center;   -ms-text-align-last: center;   -moz-text-align-last: center;">
				<option value=''>Lecturer</option>
					<?php
						
						$query = $db->query("SELECT * FROM faculty_master ORDER BY faculty_fname ASC");
						$rowCount = $query->num_rows;
						echo $rowCount;
						if($rowCount > 0){
						while($row = $query->fetch_assoc()){ 
						echo '<option value="'.$row['faculty_id'].'">'.$row['faculty_fname'].' '. $row['faculty_lname'].'</option>';
						}
						}else{
							echo '<option value="">Lecturer not available</option>';
						}
						?>
									 
			</select>
		</div>
		
	
	</div> <!-- row div ends here -->
	</br>
	
	<div class="row text-center">  <!-- New row begins -->
	<form class="form-inline">	
		<div class="form-group">
		<!--<label for="course">Course</label> -->
			<select class='form-control' name='course' id='course'>
				<option value=''>Course</option>
					<?php
					
					$query= $db->query("SELECT DISTINCT course_name,course_id FROM course_master order by course_id"); 
					$rowCount = $query->num_rows;
					
						if($rowCount > 0){
						while($row = $query->fetch_assoc()){ 
							echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';
						}
						}else{
							echo '<option value="">Course not available</option>';
						}
						?>
							 
			</select>
			
			<select name="semester" id="semester" class="form-control">
				<option value="">Sem</option>
			</select>
				
		
			<select name="divsn" id="divsn" class="form-control">
				<option value="">Div</option>
			</select>
			
			
			<select name='subject' id='subject' class="form-control">
				<option value=''>Subject</option>
				
			</select>
			
			
		</div>
		</form>
		
		</br>
		
		<div class="row text-center">  <!-- New row begins -->
			<input type="submit" name="allocate" id="allocate" value="Allocate Subject" class="btn btn-primary" style="margin-left:20px">
		</div>
		</br>

		</div>

		<div id="subgrid">
						<!-- this is where subject allocation will be displayed -->
		</div>
	
</div>   <!-- Container div Ends here -->

</body>
</html>
