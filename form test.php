<?php
   //include('session.php');
   include('configdb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Form Test</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
<body>

<div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
  
  <form class="form-inline" action="#">
     <div class="form-group" style="margin-top:10px text-align:center";>
      <label for="Lecturer">Lecturer:</label>
      <select class="form-control" id="faculty" name="faculty">
	  <option value=''>Select Lecturer </option>
					 
			<?php
			$query = $db->query("SELECT * from users WHERE usertype='F' and status='A'");
			$rowCount = $query->num_rows;
			//rowCount;
			if($rowCount > 0){
			while($row = $query->fetch_assoc()){ 
			echo '<option value="'.$row['username'].'">'.$row['username'].'</option>';
			}
			}else{
			echo '<option value="">lecturer not available</option>';
			}
			?>
							 
		  </select>
    </div>
	</br>
    <div class="form-group" style="margin-top:10px";>
      <label for="Course">Course:</label>
      <select class="form-control" id="course" name="course" style="width:50%">
	  
	  
	  
	  
    </div>
    <div class="form-group" style="margin-top:10px";>
      <label for="Semester">Sem:</label>
      <input type="select" class="form-control" id="sem" placeholder="select" name="sem" style="width:50%">
    </div>
	
	<div class="form-group" style="margin-top:10px";>
      <label for="division">Div:</label>
      <input type="select" class="form-control" id="division" placeholder="select" name="division" style="width:50%">
    </div>
	
	<div class="form-group" style="margin-top:10px";>
      <label for="subject">Subject</label>
      <input type="select" class="form-control" id="subject" placeholder="select" name="subject" >
    </div>
	
	
    <button type="submit" class="btn btn-default" style="margin-top:10px";>Submit</button>
  </form>
</div>

</body>
</html>
