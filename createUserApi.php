<?php 

include_once 'connection.php';

if(isset($_POST["create_user"])){

    $branch_code = $_POST["branch_code"];
    $user_code = $_POST["user_code"];
    $user_name = $_POST["user_name"];
    $pass_word = $_POST["pass_word"];
    $confirm_password = $_POST["con_pass_word"];
    $role = $_POST["role"];
    $user_type = $_POST["user_type"];

    date_default_timezone_set('Asia/Dhaka'); 
    $entry_date = date("Y-m-d H:i:s"); // time in bd

    if($pass_word === $confirm_password){
        /*if($user_type=="Checker"){
            $user_name = "bamalco-".$_POST["user_name"];
        }*/
        $sql = "INSERT INTO fsib_user VALUES(null,'".$branch_code."','".$user_code."','".$user_name."','".$pass_word."','".$role."','".$user_type."','".$entry_date."','".$entry_date."')";
        //print_r($sql);
        //var_dump($sql);
        //die();
        $exe_sql = $con-> query($sql);
        //var_dump($sql);
        if($exe_sql===TRUE){
            echo '<script> alert("User  Create Successfully"); window.location.assign("createUser.php");</script>';
        }
        else{
            echo '<script> alert("Error in User Creation"); window.location.assign("createUser.php");</script>';
        }
    }
    else{
        echo '<script> alert("Password and Confirm Password not matched!!"); window.location.assign("createUser.php");</script>';
    }
    

}
