<?php 
session_start();

include_once 'connection.php';

if(isset($_REQUEST["cgpassword"]))
{
    $oldpass = $_REQUEST["oldpass"];
    $newpass = $_REQUEST["newpass"];

    $sql = "SELECT pass_word FROM `fsib_user` WHERE `user_name` = '".$_SESSION['username']."'";
    //print_r($sql);

    $exec_sql = $con->query($sql);
    //print_r($exec_sql);
    //var_dump($exec_sql);
    //die();
    if ($exec_sql->num_rows > 0) {
        while ($row = $exec_sql->fetch_assoc()) {
            $pass = $row["pass_word"];
            //echo $pass;
        }
    }

    if($oldpass == $pass)
    {
        $usql = "UPDATE `fsib_user` SET `pass_word`='".$newpass."' WHERE `user_name` = '".$_SESSION['username']."'";
        $exec_usql = $con->query($usql);
        if($exec_usql==True)
        {
            echo '<script> alert("Password Change Successfully"); window.location.assign("login.php");</script>'; 
            session_destroy();  
        }
        //echo "match";
    }
    else
    {
        echo '<script> alert("Given old password not matched"); window.location.assign("changePassword.php");</script>'; 
    }
}