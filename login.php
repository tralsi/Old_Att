<?php
   include("configdb.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $usr_type = '';

      if($myusername == $mypassword)
      {
         $stud_qry = "SELECT * FROM students WHERE roll_no = '$myusername'";
         $stud_res = mysqli_query($db,$stud_qry);
         $cnt = mysqli_num_rows($stud_res);
            if($cnt)
            {
              $usr_type = "S"; //Student
              $_SESSION['login_user'] = $myusername;
              header("location: studentreport_1.php");

            }
         else
            {
               //if faculty login with userid & pwd both same
            $fac_sql = "SELECT * FROM users WHERE username = '$myusername' and pwd= '$mypassword'"; // checking whether he is available in faculty table
            $fac_res = mysqli_query($db,$fac_sql);
            $f_cnt = mysqli_num_rows($fac_res);
              if($f_cnt)
               {
               $usr_type = "F"; //Faculty
               }
            }

      }

      if($myusername != $mypassword || $usr_type =="F")
      {      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and pwd= '$mypassword'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);
     
         if($count)
         {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['status'];
         //  echo " Status  = " . $active ."</br>";

            if($count == 1 && $active == 'A') {
               // session_register("myusername");
               $_SESSION['login_user'] = $myusername;
               header("location: welcome1.php");
            }else if($count == 1 && $active != 'A'){
               echo "<script>alert('The user is currently not active. Please contact Administrator')</script>";
            }
         }
         else
            {
               echo "<script type='text/javascript'> alert('1. invalid Username or Password');</script>";
            }
      }
      else
      {
         echo "<script type='text/javascript'> alert('2. invalid Username or Password');</script>";
      }
   
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/global.css" rel="stylesheet">
   <script type='text/javascript'></script>
	<script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<title>Login</title>
  </head>

<body>  

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action = "" method = "post" class="form-container">
				
					<center> <h4 class="text-primary">Login</h4> </center>
					
					<div class="form-group">
						<label for="userid">User Name :</label>
						<input type="text" name="username" class="form-control" id="userid" placeholder="Enter your username"/>
					</div>
				
					<div class="form-group">
						<label for="pwd">Password :</label>
						<input type = "password" name = "password" class = "form-control" id="pwd" placeholder="Enter your password"/>
					</div>
		
				
				<input type = "submit" value = "Submit" class="btn btn-primary btn-block"/>
			</form>
			</div>
		</div>
	</div>
 </body>
</html>