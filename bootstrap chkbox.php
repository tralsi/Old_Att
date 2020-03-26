<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> Checkbox values using JQuery</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap_chkbox.css" rel="stylesheet">
	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>
	/*$(document).ready(function(){
		$("label").click(function() {
			//alert("button is clicked");
			//$(this).toggleClass('btn-info').toggleClass('label-danger');
			$this.toggleClass('btn-info');
			if($(this).find('.glyphicon').css('opacity')==0)
				$(this).find('.glyphicon').css('opacity','1');
			else
				$(this).find('.glyphicon').css('opacity','0');
		});
		});*/
		
		
		$(document).ready(function() {
			$("button").click(function() {
				var absent=[];
				$.each($("input[name='student']:checked"),function(){
					absent.push($(this).val());
				});
				alert("My favourite sports are: " + absent.join(", "));
			});
		});
	</script>
</head>

<!--<div class="btn-group col-md-3"> -->

<?php for($i=0;$i<50;$i++)
{
	echo "<div data-toggle='buttons' class='col-md-2'>";
	echo "<label class='btn btn-info'>";
	$no="17B00".$i;
	echo "<input type='checkbox' name='student' value=".$no.">".$no;
	echo " <span id='checkbox1' class='glyphicon glyphicon-remove'></span>";
	echo "</label>";
	echo "</div>";
}

?> 

<button name="submit">Click Me</button>










