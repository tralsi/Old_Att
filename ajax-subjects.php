<?php
//Include database configuration file
include ('configdb.php');

if(isset($_POST["data_display"]) && !empty($_POST["data_display"])){
    display_subjects(); 
    }

 if(isset($_POST["alloc_sub"]) && !empty($_POST["alloc_sub"])){
            insert_subjects();
            display_subjects();
        }

function insert_subjects()
{
  //  include('configdb.php');
    global $db,$conn;
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
    // $query = $db->query("SELECT * FROM subject_allocation WHERE suballoc_fac_id = ".$_POST['fac_id']." ORDER BY suballoc_sem ASC");
    
            
            $query = $db->query("SELECT t1.suballoc_fac_id,t1.suballoc_course_id,t1.suballoc_sem, t1.suballoc_div, t1.suballoc_sub_id, t2.sub_id,t2.sub_name, t3.course_id, t3.course_name, t4.div_id,t4.div_name FROM subject_allocation t1, subject_master t2, course_master t3, div_master t4 WHERE t1.suballoc_sub_id=t2.sub_id AND t1.suballoc_course_id=t3.course_id AND t1.suballoc_div=t4.div_id AND t1.suballoc_fac_id = ".$_POST['fac_id']." ORDER BY t3.course_name, t1.suballoc_sem ASC");

            // echo "<td>" .$row['suballoc_sem'].  "</td>";

    //Count total number of rows
    $rowCount = $query->num_rows;
    //Display Subjects
    if($rowCount > 0){
        echo "<table id='sub_table' class='table table-bordered table-hover table-condensed' style='width:75%; margin:auto'>";
        echo "<tr>";
        echo "<td align='center'><strong>Course</strong></td>";
        echo "<td><strong>Subject</strong></td>";
        echo "<td align='center'><strong>Semester</strong></td>";
        echo "<td align='center'><strong>Divison</strong></td>";
        echo "<td align='center'><strong>Edit</strong></td>";
        echo "<td align='center'><strong>Delete</strong></td>";
        echo "</tr>";

        while($row = $query->fetch_assoc()){ 
            echo "<tr>";
            echo "<td align='center'>" .$row['course_name'].  "</td>";
            echo "<td>" .$row['sub_name'].  "</td>";
			echo "<td align='center'>" .$row['suballoc_sem'].  "</td>";
            echo "<td align='center'>" .$row['div_name'].  "</td>";
            echo "<td align='center'><span id='edit_row' class='glyphicon glyphicon-pencil'>";
            echo "<td align='center'><span id='delete_row' class='glyphicon glyphicon-remove'>";
		    echo "</tr>";
           }
        echo "</table>";
        }
}
?>