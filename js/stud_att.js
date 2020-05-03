$(document).ready(function(){

  $('#sub').on('change',function(){
    var sub = $(this).val();
    var fac = $('#fac').val();
    if(sub){
      $.ajax({
      type:'POST',
      url:'studinfo.php',
      data:{'subid':sub,'facid':fac},
      success:function(html){
           // console.log(html);
             $('#rollno').html(html);
     }}); 
    }else{
      $('#rollno').html('<option value="">Roll No</option>');
    }

  })

  $('#check_btn').on('click',function(){
    var subid = $('#sub').val();
    var rollid = $('#rollno').val();
    var frmdate= $('#frm_date').val();
    var todate = $('#to_date').val();

    if(subid == null){alert('Please Select Subject');$("#sub").focus();	return false;}
    if(rollid == null){alert('Please Select Roll No.');$("#sem").focus();	return false;}
    if(frmdate == ""){alert('Please Select From Date');$("#frm_date").focus();	return false;}
    if(todate == ""){alert('Please Select To Date');$("#to_date").focus();	return false;}

  //   var start = $("#frm_date").val();
  //   var end = $("#to_date").val();
  //  // var end = $("#to_date").datepicker("getDate").getTime();
  //   //alert(end);
  //   var days = end-start;
    //alert("days = "+ days);
    if(frmdate > todate)
    {
      alert ("To Date shall be grater than From Date");
      return false;
    }
    

    if(rollid){
      $.ajax({
      type:'POST',
      url:'studinfo.php',
      data:{'sub':subid,'rollno':rollid,'frmdate':frmdate,'todate':todate},
      success:function(html){
            // console.log(html);
             $('#stud-attendance').html(html);
     }}); 
    }else{
      $('#stud-attendance').html('No Attendance Found');
    }

  })

})