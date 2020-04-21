<?php
//Include database configuration file
include('configdb.php');

if(isset($_POST["course_id"]) && !empty($_POST["course_id"])){
    //Get all Semester data
    $query = $db->query("SELECT DISTINCT sem_id FROM sem_master WHERE c_id = ".$_POST['course_id']." ORDER BY sem_id ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display Semesters
    if($rowCount > 0){
        echo '<option value="">Select</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['sem_id'].'">'.$row['sem_id'].'</option>';
        }
    }else{
        echo '<option value="">Semester not available</option>';
    }
    $query->free();
}

if(isset($_POST["semester_id"]) && !empty($_POST["semester_id"])){
    //Get all Division data
    $query = $db->query("SELECT DISTINCT div_id, div_name FROM div_master WHERE div_master.c_id=".$_POST['crs_id']." ORDER BY div_name ASC");
    
    //Count total number of rows
    $rowCount1 = $query->num_rows;
    
    //Display Divisions 
    if($rowCount1 > 0){
        echo '<option value="">Select</option>';
        while($row1 = $query->fetch_assoc()){ 
            echo '<option value="'.$row1['div_id'].'">'.$row1['div_name'].'</option>';
        }
    }else{
        echo '<option value="">Division not available</option>';
    }
    $query->free();
}

/*Following will be used for Welcome1.php subject Listing 
only allocated subjects to respective faculties will be listed */

if(isset($_POST["sem_id"]) && !empty($_POST["sem_id"])){
    //Get all Subject data
    $facid = $_POST['facid'];
    $crsid = $_POST['crs_id'];
    $semid = $_POST['sem_id'];

    $sub_qry = "SELECT DISTINCT * FROM subject_master JOIN subject_allocation ON subject_master.sub_id = subject_allocation.suballoc_sub_id AND subject_allocation.suballoc_sem = $semid AND subject_allocation.suballoc_fac_id= $facid AND subject_allocation.suballoc_course_id = $crsid";

    $sub_res = mysqli_query($db,$sub_qry);
    $str = "";
    $str .= "echo '<option value=''>Subject</option>'";
    if($sub_res)
    {
      while($sub_row = mysqli_fetch_assoc($sub_res))
        {
        
        echo "<option value= ".$sub_row['sub_id']. ">". $sub_row['sub_code'] . "-" . $sub_row['sub_name']. "</option>";
       
        }
    }else{
        echo '<option value="">Subject NA</option>';
    }
    mysqli_free_result($sub_res);
}


if(isset($_POST["fac_id"]) && !empty($_POST["fac_id"])){
  //  echo "<script>alert('inside fac_id of AjaxCombo.php'); </script>";
    //Get all Subject data
    $fac_id = $_POST["fac_id"];
    $crs = $_POST["c_id"];
    $sem = $_POST["s_id"];
    $div = $_POST["d_id"];
    // echo '<option value="subj"></option>';
    //echo '<option value="'.$fac_id.'">'.$fac_id.'</option>';
     $qry3 = $db->query("SELECT t1.suballoc_fac_id,t1.suballoc_sub_id,t1.suballoc_course_id, t1.suballoc_sem,t1.suballoc_div,t2.sub_id,t2.sub_name FROM subject_allocation t1, subject_master t2 WHERE suballoc_fac_id='$fac_id' AND t1.suballoc_sub_id=t2.sub_id AND t1.suballoc_sem='$sem' AND t1.suballoc_course_id='$crs' AND t1.suballoc_div='$div'");

    $rowCount3 = $qry3->num_rows;
    if($rowCount3)
    {
      while($row3 = $qry3->fetch_assoc()){ 
             echo '<option value="'.$row3['suballoc_sub_id'].'">'.$row3['sub_name'].'</option>';
         }
    }
    else
    {
        echo '<option value="">Subject NA</option>';
    }
$qry3->free();
}

/*This will be Called from Class Sem Div js file to list the subjects */

if(isset($_POST["csd_sem_id"]) && !empty($_POST["csd_sem_id"])){
//echo "<script>alert('from the CSD called ajaxcombo')</script>";
    //Get all Subject data
    $crsid = $_POST['csd_crs_id'];
    $semid = $_POST['csd_sem_id'];

    $all_sub_qry = "SELECT * FROM subject_master WHERE course=$crsid AND sem=$semid";
    $all_sub_res = mysqli_query($db,$all_sub_qry);
    $str = "";
    $str .= "echo '<option value=''>Subject</option>'";
    if($all_sub_res)
    {
        while($all_sub_row = mysqli_fetch_assoc($all_sub_res))
        {
        echo "<option value= ".$all_sub_row['sub_id']. ">". $all_sub_row['sub_code'] . " - " . $all_sub_row['sub_name']. "</option>";
        }
    }
    else{
        echo "subject NA";
    }
}    

?>