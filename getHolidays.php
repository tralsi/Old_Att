<?php
   include('configdb.php');

  $query= "SELECT * FROM holiday_master"; 
  $res = mysqli_query($db,$query);
  $arr = array();
  if($res)
    {
      $cnt = 0;
      while($row = mysqli_fetch_assoc($res))
        {
          $dt = $row['holiday_date'];
          $str = date("d-m-Y", strtotime($dt));
          $desc = $row['holiday_desc'];
          //$arr[$cnt] = "'$str'".","."'$desc'";
          $arr[] = array("date"=> $str,
                          "desc"=>$desc);
        //  $cnt++;
        }
    echo json_encode($arr);
    }
?>