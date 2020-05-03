<?php
include('session.php');
if(isset($_SESSION['fac_full_name']))
  {
    $fac_fullname = $_SESSION['fac_full_name'];
    $fac_id = $_SESSION['facid'];
  }
else
  header("location: login.php");
?>

 <!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-datepicker3.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.min.js"></script>
    <link href="css/global.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stud_att.js"></script>
   

	<title>Student Attendance</title>
  </head>
<body>
<input type="hidden" id="fac" value="<?php echo $fac_id ?>">
<!-- Top  Navigation Bar  -->

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

				<li><a href="faculty_subjects.php" style="padding:10px"><span class="glyphicon glyphicon-book" style="margin-right:10px"></span> Subjects</a></li>
                
                <li role="separator" class="divider"></li>

                <!-- <li><a href="#" style="padding:10px">
                <span class="glyphicon glyphicon-education" style="margin-right:10px"></span> Student's Attendance</a></li> -->

                <li><a href="class_attendance.php" style="padding:10px">
                <span class="glyphicon glyphicon-list-alt" style="margin-right:10px"></span> Class Attendance</a></li>
            </ul>
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

<!-- Form in Navigation bar -->

   <div class="container" style="margin:auto">
  
  <div class="row" style="text-align:center; vertical-align: middle">
  
    <div class="col-md-12">
      <form action="" method="POST" class="form-inline form-container mt-4" role="form">  
      
      <!-- <div class="form-group"> -->
        <!-- <label for="sem">Sem : &nbsp </label> -->
         
      <!-- <div> -->

      <div class="form-group">
        <!-- <label for="sub">Subject : &nbsp </label> -->
         <select name="sub" id="sub" class="form-control">
         <option value="" disabled selected hidden>Subject</option>
        
         <?php
          $qry_sub = "SELECT DISTINCT t1.suballoc_sub_id, t2.sub_name FROM subject_allocation t1,subject_master t2 WHERE t1.suballoc_fac_id = $fac_id AND t1.suballoc_sub_id=t2.sub_id ORDER BY t1.suballoc_course_id, t1.suballoc_sem, t1.suballoc_div";
          $sub_res = mysqli_query($db,$qry_sub);
          if($sub_res)
          {
            while($row=mysqli_fetch_assoc($sub_res))
            {
            echo "<option value=".$row['suballoc_sub_id'].">".$row['sub_name']."</option>";
            }
          }
          else
          {
            echo "error ". mysqli_error($db);
          }
        ?>
        </select>
      </div>

      <select name="rollno" id="rollno" class="form-control">
      <option value="" disabled selected hidden>Roll No.</option>
      </select>

      <!-- <div id="studlist"></div> -->

      <!-- <div class="form-group">
        <label for="sem">Sem : &nbsp </label>
         <select name="sem" id="sem" class="form-control">
         <option value=""disabled selected hidden>Sem</option>
         </select>
      </div>
        
      <div class="form-group">
        <label for="div">Div : &nbsp </label>
         <select name="div" id="div" class="form-control">
         <option value="" disabled selected hidden>Div</option> 
         </select>
      </div> -->

      
      <div class="form-group ml-4">
        <label for="frm_date">&nbsp From : </label>
        <input type="date" id="frm_date" name="frm_date" class="form-control"/>
      </div>
    
      <div class="form-group ml-4">
        <label for="to_date">&nbsp To : </label>
        <input type="date" id="to_date" name="to_date" class="form-control"/>
      </div>
      
      <!-- </br> -->
      <input type="button" name="check_btn" id="check_btn" value="Check" class="btn btn-info ml-6">
          
  </form>
  </div>
  
  </div> <!-- row div -->
  <!-- </center> -->
  </div> <!-- Container div -->
  </br>
  </br>
  
  <div class="container">     
        <div id='stud-attendance'>
        </div>
      
  </div>
  
</body>
<!-- following js plugins are for exporting to Excel / PDF -->
  
  <!-- <script src="js/jspdf.min.js"></script> -->
  <!-- <script src="https://rawgit.com/MrRio/jsPDF/master/dist/jspdf.debug.js"></script> -->
  <!-- <script src="js/jspdf.plugin.autotable.js"></script> -->
  <!-- <script src="js/tableHTMLExport.js"></script> -->
  <script src="js/xlsx.full.min.js"></script>
  
  <script type="text/javascript">
  
  function toExcel(){
  alert('inside Export to Excel');
  var wb = XLSX.utils.book_new();
 // var Heading =[["Class Attendace"]];
  wb.SheetNames.push("Student Attendance");
   //XLSX.utils.aoa_to_sheet(Heading);
   var ws2 = XLSX.utils.table_to_sheet(document.getElementById('rptable'));
  wb.Sheets["Student Attendance"] = ws2;
  XLSX.writeFile(wb, 'Stud_Attendance.xlsx');
}

function changeOrientation()
{
  wd = parseInt($("#rptable").css('width'));
  width =  parseInt($(window).width());
  var ratio = width/wd;
  
  if(ratio < 2 )
  $("#rptable").css({"width": "10%", "margin": "auto"});
  else
  $("#rptable").css({"width": "100%", "margin": "auto"});

  $("#rptable").each(function() { 
   // if ( !$(this).hasClass("reverted") ) {
      
        var $this = $(this);
        var newrows = [];
        $this.find("tr").each(function(){
            var i = 0;
            $(this).find("td, th").each(function(){
                i++;
                if(newrows[i] === undefined) { 
                    newrows[i] = $("<tr></tr>"); 
                }
                newrows[i].append($(this));
            });
        });
        $this.find("tr").remove();
        $.each(newrows, function(){
            $this.append(this);
            $this.addClass('reverted');
        });
   // }  
});
}
 </script>
</html>