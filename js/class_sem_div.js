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
				}
			});
			
	
			$('#semester').on('change',function(){
			$('#ajaxDiv').empty();
			var semID = $(this).val();
			var crsID = $('#course').val();
			
				if(semID)
				{
				$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:{'semester_id':semID,'crs_id':crsID},
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
			var crsID = $('#course').val();
			var semID = $('#semester').val();
			var divID = $('#divsn').val();
			//alert(divID);	
				if(divID)
				{
				$.ajax({
					type:'POST',
					url:'ajaxComboData.php',
					data:{'csd_sem_id' : semID,'csd_crs_id':crsID},
					success:function(html){
						$('#subject').html(html);
						console.log(html);
					}
					}); 
				}else{
				$('#subject').html('<option value="">Subject Not Available</option>'); 
				}
			
			});
			
			
			
			$("#faculty").on('change',function(){
			// var courseID = $("#course").val();
			// var semID = $("#semester").val();
			//  var divID = $("#divsn").val();
			
			var facID = $(this).val();
			//alert(facID);
				if(facID){
					$.ajax({
					type:'POST',
					url:'ajax-subjects.php',
					data:{data_display:'data_display',
						fac_id:facID
					},
					success:function(html){
										$("#subgrid").empty();
                    $('#subgrid').html(html);
                    
					}}); 
				}else{
					$('#subgrid').html('No Subjects Allocated Yet..... from Jquery');
					 }
			});

			$("#allocate").on('click',function(){
				
				 var facID = $('#faculty').val();
				 var courseID = $('#course').val();
				 var semID = $('#semester').val();
				 var divID = $('#divsn').val();
				 var subID = $('#subject').val();

				 if(courseID == ""){alert('Select Course');$("#course").focus();	return false;}
				 if(semID == ""){alert('Select Semester');$("#semester").focus();return false;}
				 if(divID == ""){alert('Select Division');$("#divsn").focus();return false;}
				 if(facID ==""){alert('Select Lecture No.');$("#lecturno").focus();return false;}
				 if(subID ==""){alert('Select Subject.');$("#subject").focus();return false;}
			 
				
					if(subID){
						$.ajax({
						type:'POST',
						url:'ajax-subjects.php',
						data: {alloc_sub : 'allocate',
						sub_id:subID,
						fac_id:facID,
						crs_id:courseID,
						sem:semID	,
						div_id:divID
						}, 
						success:function(data){
								//	console.log(data);
									if(data=='1')
									{
										alert('This subject is already assigned to this faculty for this division');
									}else
									{
										$("#subgrid").remove("#sub_table");
										$('#subgrid').html(data);
									}
					}}); 
					}else{
						$('#subgrid').html('No Subjects has been allocated Yet.... from Jquery  class_sem_div.js');
						 }
				});
				
				$(document).on('click', '#delete_row', function(){
				var id = $(this).data('rowid');
				var facID = $('#faculty').val();
			//	alert('id = '+id);
			//	alert('faculty id ='+facID);
			//	$del_btn = $(this);
				
				$.ajax({
					  url: 'ajax-subjects.php',
					  type: 'POST',
					  data:	{
						'delete': 1,
						'id': id,
						'fac_id':facID
									},
						success: function(html)
						   {
						//	console.log(html);
							$("#subgrid").remove("#sub_table");
							$('#subgrid').html(html);
							}
						  });
				
				});
				
				$(document).on('click', '#edit_row', function(){
				var id = $(this).data('id');
				//alert("in Edit = " + id);
				
				});
		
	}); //end of document ready function

				