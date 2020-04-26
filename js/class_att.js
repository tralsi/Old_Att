$(document).ready(function(){

  /* This is for Sem combobox population */
  $('#sub').on('change',function(){
    var subID= $(this).val();
    var facID= $('#fac').val();
    //alert(facID);
  if(subID){
    $.ajax({
    type:'POST',
    url:'classcombo.php',
    data:{'subid':subID,'facid':facID},
    success:function(html){
           $('#sem').html(html);
           $('#div').html('<option value="">Div</option>');
    }}); 
  }else{
    $('#sem').html('<option value="">sem</option>');
 
  }
  })

/* This is for Div combobox population */
  $('#sem').on('change',function(){
    var semID= $(this).val();
    var facID= $('#fac').val();
    var subID = $('#sub').val();
    //alert(facID);
  if(subID){
    $.ajax({
    type:'POST',
    url:'classcombo.php',
    data:{'sub_id':subID,'fac_id':facID,'semid': semID},
    success:function(html){
           $('#div').html(html);
           //console.log(html);
    }}); 
  }else{
    $('#div').html('<option value="">Div</option>');
 
  }
  })

  /* On Check button Click for validation & ajax div population */
  $('#check_btn').on('click',function(){
    //alert("inside Check Button");
    var facID= $('#fac').val();
    var subID = $('#sub').val()
    var semID= $('#sem').val();
    var divID= $('#div').val();
    var frmDate= $('#frm_date').val();
    var toDate= $('#to_date').val();
    
    
    if(facID == ""){alert('Please login with Faculty ID');$("#fac").focus();	return false;}
    if(subID == null){alert('Please Select Subject');$("#sub").focus();	return false;}
    if(semID == null){alert('Please Select Semester');$("#sem").focus();	return false;}
    if(divID == ""){alert('Please Select Division');$("#div").focus();	return false;}
    if(frmDate == ""){alert('Please Select From Date');$("#frm_date").focus();	return false;}
    if(toDate == ""){alert('Please Select To Date');$("#to_date").focus();	return false;}
    var start = $("#frm_date").val();
    //alert(start);
    var end = $("#to_date").val();
   // var end = $("#to_date").datepicker("getDate").getTime();
    //alert(end);
    var days = end-start;
    //alert("days = "+ days);
    if(start >= end )
    alert ("To Date shall be grater than From Date");

    if(toDate){
      $.ajax({
      type:'POST',
      url:'classcombo.php',
      data:{'sub_id':subID,'fac_id':facID,'sem_id': semID,'div_id':divID,'frm_date':frmDate,'to_date':toDate},
      success:function(html){
             $('#ajax-attendance').html(html);
            // console.log(html);
      }}); 
    }

  })

}) //Document Ready Function