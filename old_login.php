<?php
   include("configdb.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and pwd = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['status'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1 && $active == 'A') {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         header("location: welcome1.php");
      }else if($count == 1 && $active != 'A'){
         echo "The user is currently not active";
      }else{
         $error = "Your Login Name or Password is invalid";
         echo $error;
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

      <title>Login Page</title>
   </head>
      
    <body bgcolor = "#FFFFFF">

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

	            </br> </br> 
				<div class="container col-md-4 col-md-offset-4">
			 
               <form action = "" method = "post" class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-4">User Name  :</label>
						<div class="col-md-8"><input type = "text" name = "username" class = "form-control"/></div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-4">Password  :</label>
						<div class="col-md-8"><input type = "password" name = "password" class = "form-control" /></div>
					</div>
					
					<div class="col-md-offset-4 col-md-4"> <input type = "submit" value = " Submit " class="form-control"/><br /></div>
               </form>
               
              <!-- <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?> -->
               </div>
			 
					
           	
             
   </body>
</html>