<?php
   include("configdb.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and pwd = '$mypassword'";
      $result = mysqli_query($db,$sql);
      if($result)
      {
         $count = mysqli_num_rows($result);
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         $active = $row['status'];

         if($count == 1 && $active == 'A') {
            // session_register("myusername");
             $_SESSION['login_user'] = $myusername;
             header("location: welcome1.php");
          }else if($count == 1 && $active != 'A'){
             echo "<script>alert(The user is currently not active. Please contact Administrator</script>";
          }
      }
      else
      {
         echo "<script>invalid Username or Password</script>";
         //return false;
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
               
              <!-- <div style = "font-size:11px; color:#cc0000; margin-top:10px">
		 	 -->
  
</body>
</html>