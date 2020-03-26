<?php
   //include('session.php');
   include('configdb.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap_chkbox.css" rel="stylesheet">  <!-- added on 09-Dec-2018 -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    
    

    <title>Welcome to combo test</title>
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
                    $('#divsn').html('<option value="">Select Sem</option>'); 
					}}); 
				}else{
					$('#semester').html('<option value="">Select course</option>');
					$('#divsn').html('<option value="">Select Sem</option>'); 
				}
			});
			
	
		$('#semester').on('change',function()
			{
			var semID = $(this).val();
			var crsID = $('#course').val();
			//alert(semID);
				if(semID)
				{
				$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:'semester_id='+semID+'&crs_id='+ crsID,
					success:function(html){
						$('#divsn').html(html);
					}
					}); 
				}else{
				$('#divsn').html('<option value="">Division Not Available</option>'); 
				}
			});
	});


	</script>
     
   </head>
   
   <body>
   <div class="container" style="margin-top:10px">
	<!--	<div class="row" style="color:#337AB7"> 
			<div class="col-md-2">Welcome <?php echo $login_session; ?></div>
			<div class="col-md-8">Last entry date : </div>
			<div class="col-md-2" style="text-align:right"><a href = "logout.php">Sign Out</a></div>
		</div> -->
		
		</br>
      
      
	<nav class="navbar" style="background-color:#337AB7;>
		
		
		
			<form class="navbar-form navbar-left" method="POST" name="f1">
				<span class="glyphicon glyphicon-education" style="color:white; vertical-align:middle; font-size:30px"></span>
				&nbsp
				
			
	    <?php
		// Getting course data from Mysql table for course combo box //
        $query= $db->query("SELECT DISTINCT course_name,course_id FROM course_master order by course_id"); 
		$rowCount = $query->num_rows;
		//echo $rowCount;
		?>
		
		<select name="course" id="course" >
			<option value="">Select Course</option>
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
		
		
		<select name="semester" id="semester">
        <option value="">Select course first</option>
		</select>
    
		<select name="divsn" id="divsn">
        <option value="">Select semester first</option>
		</select>
		
		</form>
	</nav>
		
	</body>
</html>