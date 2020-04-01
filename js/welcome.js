function liststud(){
	var courseID = $("#course").val();
	var semID = $("#semester").val();
	var divID = $("#divsn").val();
	var lec = $("#lecturno").val();
	var subID = $("#subject").val();

	if(courseID == ""){alert('Select Course');$("#course").focus();	return false;}
	if(semID == ""){alert('Select Semester');$("#semester").focus();return false;}
	if(divID == ""){alert('Select Division');$("#divsn").focus();return false;}
	if(lec ==""){alert('Select Lecture No.');$("#lecturno").focus();return false;}
	if(subID ==""){alert('Select Subject.');$("#subject").focus();return false;}

	$('#ajaxDiv').empty();

	if(divID){
			$.ajax({
			type:'POST',
			url:'ajax-example1.php',
			data:'crs='+courseID+'&sem='+semID+'&divsn='+divID,
			success:function(html){
								$('#ajaxDiv').html(html);
								
			}}); 
		}else{
			$('#ajaxDiv').html('Your result will display here ... from Jquery');
			 }
	}

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
					$('#subject').html('<option value="">Subject</option>');
				}
			});
			
	
			$('#semester').on('change',function(){
			$('#ajaxDiv').empty();
			var semID = $(this).val();
			var crsID = $('#course').val();
			var uname = $('#userid').text();
			//alert(semID);
				if(semID)
				{
				$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:{'semester_id':semID,'crs_id':crsID,'uid':uname},
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
			});
			

			$('#divsn').on('change',function(){
				//$('#ajaxDiv').empty();
				var crsID = $('#course').val();
				var semID = $('#semester').val();
				var divID = $('#divsn').val();
				var fid = $('#facid').val();
				//alert(divID);	
					if(divID)
					{
					$.ajax({
						type:'POST',
						url:'ajaxComboData.php',
						data:{'sem_id' : semID,'crs_id':crsID,'facid':fid},
						success:function(html){
								$('#subject').html(html);
								console.log(html);
								}
							}); 
					}else{
					$('#subject').html('<option value="">Subject NA</option>'); 
					}
				
				});


	$("#show").on('click',liststud); //Will Display List of Students in ajaxdiv
		

}); //dcoument.ready ends here

//global function
function getAbsentees()
	{
			//alert("call received");
			var dt = $("#datepicker1").val();
			var lectureNo = $("#lecturno").val();
			var courseID = $("#course").val();
			var semID = $("#semester").val();
			var divID = $("#divsn").val();
			var facID = $("#facid").val();
			var subID = $("#subject").val();

			if(dt == ""){alert('Select Date');$("#datepicker1").focus();	return false;}
			if(courseID == ""){alert('Select Course');$("#course").focus();	return false;}
			if(semID == ""){alert('Select Semester');$("#semester").focus();return false;}
			if(divID == ""){alert('Select Division');$("#divsn").focus();return false;}
			if(lectureNo ==""){alert('Select Lecture No.');$("#lecturno").focus();return false;}
			if(subID ==""){alert('Select Subject.');$("#subject").focus();return false;}

			var absent=[];

	//		alert('Lecture no is = '+ lectureNo);

			$.each($("input[name='student']:checked"),function(){
				absent.push($(this).val());
			});
			
			abslist = absent.join(",")
			
		//	alert(dt+'\n'+ lectureNo +'\n'+courseID +'\n'+semID +'\n'+ divID +'\n'+ facID +'\n'+ subID);
	
			if(abslist.length==0)
			{
				ans = confirm("Are All the students present in the class ?");
			}else
			{
				ans = confirm("Absentees : " + absent.join(", "));
			}
		
			if(ans)
			{
				$.ajax(
					{
				type:'POST',
				url:'reg_attendance1.php', // changes done @ Home
				data:{'date':dt,'lecture':lectureNo,'course':courseID,'sem':semID,'div':divID, 'facultyID':facID, 'subjectid':subID, 'abslist': absent},
				success:function(html)
					{
					console.log(html);
						if(html)
						{
							alert(html);
							incDate(); //Sets Next Date & update Last Entry date
							liststud(); // get List of students again
						
						}
						/*else
							alert("Unable to insert records successfully");
					
						}*/
					}})
				}
			else
			{
			alert('No student is marked absent or present');
			 return false;
			}
	}

function incDate()
{
		var date1 = $('#datepicker1').datepicker('getDate');
		var fmt_dt = date1.toDateString();
	//	console.log(m);
		$('#lastentrydate').text(fmt_dt);

		var date = new Date( Date.parse( date1 ) ); 
		if(date.getDay()==6)					//checks for saturday
			date.setDate( date.getDate() + 2 );
		else
			date.setDate( date.getDate() + 1 );
    
    var newDate = date.toDateString(); 
    newDate = new Date( Date.parse( newDate ) );
    
    $('#datepicker1').datepicker('setDate', newDate );
		
}
	