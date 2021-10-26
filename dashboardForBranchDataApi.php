<?php

include_once 'connection.php';

$sql = "SELECT * FROM fsib_notice";
$exec_sql = $con->query($sql);

if($exec_sql->num_rows>0){
    while($row = $exec_sql->fetch_assoc()){
        $notice_refno = $row["notice_refno"];
        $fsib_notice_sub = $row["fsib_notice_sub"];
        $fsib_notice_from = $row["fsib_notice_from"];
        $fsib_notice_ref = $row["fsib_notice_ref"];
        $fsib_description = $row["fsib_description"];
        $fsib_lst_sub_dt = $row["fsib_lst_sub_dt"];

        //echo $notice_refno."<br/>";
    }

    
}
else{
    $msg = "No data found!!!!!";
}
