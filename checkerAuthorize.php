<?php
session_start();

include_once 'connection.php';
if($_REQUEST["auth"]=="yes"){
    //echo "Auth";
    $notice_ref = $_REQUEST["nr"];
    $fsib_checker = $_SESSION["username"];
    $fsib_checker_dt = date("Y-m-d H:i:s"); 
    $sql = "UPDATE fsb_notice_rep SET fsib_checker='".$fsib_checker."' , fsib_checker_dt ='".$fsib_checker_dt."' , status = 'approved' WHERE notice_refno='".$notice_ref."' AND fsib_branch_code = '".$_SESSION["branch_code"]."' AND length(status) = 0 " ;
    //print_r($sql);
    //die();
    $exec_sql = $con->query($sql);

    if($exec_sql === TRUE)
    {
        echo '<script> alert("Successfuly Authorized "); window.location.assign("checker.php");</script>';
    }
    else{
        echo '<script> alert("Error!!!! "); window.location.assign("checker.php");</script>';
    }
}
else{
    $notice_ref = $_REQUEST["nr"];
    $fsib_checker = $_SESSION["username"];
    $fsib_checker_dt = date("Y-m-d H:i:s"); 
    $sql1 = "UPDATE fsb_notice_rep SET fsib_checker='".$fsib_checker."' , fsib_checker_dt ='".$fsib_checker_dt."', status = 'decline' WHERE notice_refno='".$notice_ref."' AND fsib_branch_code = '".$_SESSION["branch_code"]."' " ;
    //print_r($sql1);
    //die();
    $exec_sql1 = $con->query($sql1);
    //var_dump($exec_sql1);
    //die();
    if($exec_sql1 === TRUE)
    {
        echo '<script> alert("Not Authorized "); window.location.assign("checker.php");</script>';
    }
}