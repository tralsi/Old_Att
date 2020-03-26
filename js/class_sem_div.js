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
					data:{'sem_id' : semID,'crs_id':crsID},
					success:function(html){
						$('#subject').html(html);
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
						success:function(html){
											$("#subgrid").remove("#sub_table");
											$('#subgrid').html(html);
											
						}}); 
					}else{
						$('#subgrid').html('No Subjects has been allocated Yet.... from Jquery  class_sem_div.js');
						 }
				});
				
				$(document).on('click', '#delete_row', function(){
				var id = $(this).data('id');
				var facID = $('#faculty').val();
				
				$del_btn = $(this);
				
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

				