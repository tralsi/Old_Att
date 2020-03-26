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
					}}); 
				}else{
					$('#semester').html('<option value="">Sem</option>');
					$('#divsn').html('<option value="">Div</option>'); 
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
					}
					}); 
				}else{
				$('#divsn').html('<option value="">Division Not Available</option>'); 
				}
			});
			
			$('#divsn').on('change',function(){
			$('#ajaxDiv').empty();
			});
			

	$("#show").on('click',liststud);
		
		}); //dcoument.ready ends here
		
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
							$("#datepicker1").val('');
							liststud();
						
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
	