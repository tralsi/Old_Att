<?php
   include('session.php');
   //include('configdb.php');
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
    
    

    <title>Welcome </title>
    <script>
            function reload2(form)
            {
				var d= $("#divsn").children("option:selected").val();
				alert(d);
				if(d == 1 || d == 2)
				{
					 if(document.getElementById('divsn').value != "")
						document.getElementById('divsn').value != "Select One";
				}
					//$("#divsn option[value='0']").attr("selected", "selected");
					
            }		
			
			function reload(form)
            {
            var val=form.course.options[form.course.options.selectedIndex].value;
			self.location='welcome.php?course=' + val;
            }


            function ajaxFunction()
            {
            var ajaxRequest;
            
                try {        
                   // Opera 8.0+, Firefox, Safari
                   ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                   
                   // Internet Explorer Browsers
                   try {
                      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                   } catch (e) {
                      
                      try {
                         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                      } catch (e) {
                         // Something went wrong
                         alert("Your browser does not support ajaxRequest!");
                         return false;
                      }
                   }
                }
            
            // Create a function that will receive data
            // sent from the server and will update
            // div section in the same page.
            ajaxRequest.onreadystatechange = function() {
            
               if(ajaxRequest.readyState == 4) {
                  var ajaxDisplay = document.getElementById('ajaxDiv');
                  ajaxDisplay.innerHTML = ajaxRequest.responseText;
               }
            }
            
            // Now get the value from user and pass it to
            // server script.
            var crs = document.getElementById('course').value;
            var sem = document.getElementById('semester').value;
            var div = document.getElementById('divsn').value;
            
    //        alert("division = " + div);

            var queryString = "?crs=" + crs ;
            queryString +=  "&sem=" + sem;
            queryString +=  "&divsn=" + div;

            ajaxRequest.open("GET", "ajax-example1.php" + queryString, true);
            ajaxRequest.send(); 
         }

		
		//$(document).ready(function() {
			//$("#register").click(
			function getAbsentees()
			{
				//alert("call received");
				var absent=[];
				$.each($("input[name='student']:checked"),function(){
					absent.push($(this).val());
				});
				alert("My favourite sports are: " + absent.join(", "));
			}
			
			//);
		//});
		
      </script>
     
   </head>
   
   <body>
   <div class="container" style="margin-top:10px">
		<div class="row" style="color:#337AB7"> 
			<div class="col-md-2">Welcome <?php echo $login_session; ?></div>
			<div class="col-md-8">Last entry date : </div>
			<div class="col-md-2" style="text-align:right"><a href = "logout.php">Sign Out</a></div>
		</div>
		
		</br>
      
      
	<nav class="navbar" style="background-color:#337AB7; color:white">
		
			<form class="navbar-form navbar-left" method="POST" name="f1" action="welcome.php">
				<span class="glyphicon glyphicon-education" style="color:white; vertical-align:middle; font-size:30px"></span>
				&nbsp
				
			
	    <?Php

         //if(isset($_SESSION['login_user'])){
         

// Getting course data from Mysql table for course combo box //
          $qry1="SELECT DISTINCT course_name,course_id FROM course_master order by course_id"; 

// for semester drop down list we will check if course is selected else we will display all the semesters//
		 if(isset($_GET['course'])){
         $crs=$_GET['course']; 
		 $qry2 = "SELECT DISTINCT sem_id FROM sem_master WHERE c_id=$crs ORDER BY sem_id";
		}
		else
		   $qry2 = "SELECT DISTINCT sem_id FROM sem_master ORDER BY sem_id";
       // $crs=0;
         
			
		 if(isset($_GET['semester'])){
			$qry3 = "SELECT DISTINCT div_id, div_name FROM div_master WHERE div_master.c_id=$crs ORDER BY div_name";
		 }
		 else
			$qry3 = "SELECT DISTINCT div_id, div_name FROM div_master WHERE div_master.c_id=$crs ORDER BY div_name";
        
          echo "<label>Course : </label>"; echo "&nbsp";
          echo "<select class='form-control' name='course' id='course' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
		 
          foreach ($db->query($qry1) as $value1) {
          if($value1['course_id']==@$crs){echo "<option selected value='$value1[course_id]'>$value1[course_name]</option>"."<BR>";}
          else{echo  "<option value='$value1[course_id]'>$value1[course_name]</option>";}
          }
          echo "</select>";
         
          
		  echo "&nbsp";  echo "&nbsp"; 	  echo "&nbsp";
          echo "<label>Semester : </label>"; echo "&nbsp";
          //        Starting of second drop downlist //

          echo "<select class='form-control' name='semester' id='semester' onchange=\"reload2(this.form)\"><option value=''>Select one</option>";
          foreach ($db->query($qry2) as $value2) {
          echo  "<option value='$value2[sem_id]'>$value2[sem_id]</option>";
          }
          echo "</select>";
		  echo "&nbsp";
          //////////////////  This will end the second drop down list ///////////
          

         
		 echo "&nbsp";  echo "&nbsp"; 	  echo "&nbsp";
          echo "<label>Division : </label>"; echo "&nbsp";
          echo "<select class='form-control' name='divsn' id='divsn'><option value=''>Select one</option>";
          foreach ($db->query($qry3) as $value3) {
			  
          echo  "<option value='$value3[div_id]'>$value3[div_name]</option>";
          }
          echo "</select>";
         

          ?>
			
			&nbsp &nbsp &nbsp
		   <label>Date : </label>&nbsp;
           <div class='input-group date' id='datepicker1'>
           <input class='form-control' type='text'/>
           <span class="input-group-addon">
           <span class="glyphicon glyphicon-calendar"></span>
          
          
              <script type="text/javascript">
                $(function() {
                    $('#datepicker1').datepicker({format:"dd-mm-yyyy",autoclose:true,endDate:'0d',todayBtn:'linked',todayHighlight:true,daysOfWeekDisabled:'0'});
                    //$('#datetimepicker1').datetimepicker("show");
                });
              </script>

            </div>
          
			<input type='button' class='form-control btn btn-info' value='show details' name='s1' onclick = 'ajaxFunction()'>
   
			
		</form>
		</nav>
	
       <div id = 'ajaxDiv'>Your result will display here  <!-- div will be closed by ajax html with register button -->
	   
	</div> <!-- Container div closing tag -->	
   </body>
   
</html>