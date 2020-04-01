<?php
//Include database configuration file
include ('configdb.php');

if(isset($_POST["data_display"]) && !empty($_POST["data_display"])){
    display_subjects(); 
    }

 if(isset($_POST["alloc_sub"]) && !empty($_POST["alloc_sub"])){
           if (!check_duplicate())
                {
                    insert_subjects();
                    display_subjects();
                }
            else
            {
                echo "1";
            }
        }

if(isset($_POST['delete']) && !empty($_POST["delete"]))
{
    
    $id = (int)$_POST['id'];
    $del_qry = "DELETE FROM subject_allocation WHERE suballoc_row_id=$id";
    $del_res = mysqli_query($db,$del_qry);
        if($del_res)
            {
            //echo "<script> alert('row(s) deleted'); </script>";
            display_subjects();
            }
}

function check_duplicate()
{
    global $db,$conn;
    $facID = $_POST['fac_id'];
    $crsID = $_POST['crs_id'];
    $sem = $_POST['sem'];
    $div = $_POST['div_id'];
    $subID = $_POST['sub_id'];
   
   // echo "faculty = ".$facID;

    $qry_sub_check = "SELECT * FROM subject_allocation WHERE suballoc_fac_id=$facID AND suballoc_course_id=$crsID AND suballoc_sem = $sem AND suballoc_div = $div AND suballoc_sub_id = $subID";

    $sub_chk_res = mysqli_query($db,$qry_sub_check);
    if($sub_chk_res)
        {
            $num_rows=mysqli_num_rows($sub_chk_res);
            if($num_rows)
                return true;
        }
    else
        {
           return false;
        }

}


function insert_subjects()
{
  
    global $db;
    $facID = $_POST['fac_id'];
    $crsID = $_POST['crs_id'];
    $sem = $_POST['sem'];
    $div = $_POST['div_id'];
    $subID = $_POST['sub_id'];

    $sql = "INSERT INTO subject_allocation (suballoc_fac_id,suballoc_course_id,suballoc_sem,suballoc_div,suballoc_sub_id) VALUES($facID,$crsID,$sem,$div,$subID)";
    $result = mysqli_query($db,$sql) OR die(mysql_error());     
}


function display_subjects()
{
//    include('configdb.php');
    global $db;
    
    
            $query = "SELECT t1.suballoc_fac_id,t1.suballoc_course_id,t1.suballoc_sem, t1.suballoc_div, t1.suballoc_sub_id,t1.suballoc_row_id, t2.sub_id,t2.sub_name, t3.course_id, t3.course_name, t4.div_id,t4.div_name FROM subject_allocation t1, subject_master t2, course_master t3, div_master t4 WHERE t1.suballoc_sub_id=t2.sub_id AND t1.suballoc_course_id=t3.course_id AND t1.suballoc_div=t4.div_id AND t1.suballoc_fac_id =". $_POST['fac_id']." ORDER BY t3.course_name, t1.suballoc_sem ASC";

         
            $res = mysqli_query($db,$query);
            if($res)
                {
                    $rowCount = mysqli_num_rows($res);
                }
            else
                {
                    echo "Did not get result set";
                }
          
    if($rowCount > 0){
       echo "<table id='sub_table' class='table table-bordered table-hover table-condensed' style='width:75%; margin:auto'>";
        echo "<thead>";
        echo "<tr class='info'>";
        
        echo "<td align='center'><strong>Course</strong></a></td>";
        echo "<td align='center'><strong>Subject</strong></td>";
        echo "<td align='center'><strong>Semester</strong></td>";
        echo "<td align='center'><strong>Divison</strong></td>";
       // echo "<td align='center'><strong>Edit</strong></td>";
        echo "<td align='center'><strong>Delete</strong></td>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while($row = mysqli_fetch_assoc($res)){ 
            echo "<tr>";
            echo "<td align='center'>" .$row['course_name'].  "</td>";
            echo "<td align='center'>" .$row['sub_name'].  "</td>";
			echo "<td align='center'>" .$row['suballoc_sem'].  "</td>";
            echo "<td align='center'>" .$row['div_name'].  "</td>";
         //   echo "<td align='center'><span id='edit_row' class='glyphicon glyphicon-pencil'>";
            echo "<td align='center'><span id='delete_row' data-rowid=".$row['suballoc_row_id']." class='glyphicon glyphicon-remove'>";
		    echo "</tr>";
           }
        echo "</tbody>";
        echo "</table>";
        }
}
?>