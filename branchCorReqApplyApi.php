<?php
session_start();
include_once 'connection.php';

if(isset($_POST["reply_notice"])){
    $branch_code = $_POST["branch_code"];
    $notice_refno = $_POST["notice_refno"];
    $status = $_POST["status"];
    //print_r($status);
  
    $dupli_sql = "insert into update_datatable SELECT * FROM fsb_notice_rep WHERE notice_refno = '".$notice_refno."' AND fsib_branch_code= '".$branch_code."'";
    $exec_dupli_sql = $con->query($dupli_sql);
    if($exec_dupli_sql)
    {
        $delsql = "DELETE FROM fsb_notice_rep WHERE notice_refno = '".$notice_refno."' AND fsib_branch_code= '".$branch_code."'";
        $exec_delsql = $con->query($delsql);
        if(!$exec_delsql)
        {
            echo 'Delete not done';
        }
        else
        {
            echo 'Delete  done';
        }
    }
    else
    {
        echo 'Process not done';
    }
    $fsib_description=$_POST["fsib_description"];
    $fsib_reply_path= $_FILES["attachment_file"]["name"];
    date_default_timezone_set('Asia/Dhaka'); 
    $fsib_maker_dt = date("Y-m-d H:i:s"); // time in bd
    $fsib_maker_user = $_SESSION["username"];
    $fsib_checker = "Test Checker";
    $fsib_checker_dt = date("Y-m-d H:i:s"); 

    //$sql = "INSERT INTO fsb_notice_rep VALUES('".$notice_refno."','".$branch_code."','".$fsib_description."','".$fsib_reply_path."','".$fsib_maker_user."','".$fsib_maker_dt."','".$fsib_checker."','".$fsib_checker_dt."')";
    if($status==0){
        $status = "Not Found";
    }
    else{
        $status = "Found";
    }
    $sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','".$fsib_reply_path."','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
    //print_r($sql);
    //die();
    //var_dump($exec_sql);
    
    //var_dump($exec_sql);
    //print_r($exec_sql);
    //die();
    

    $target_dir = "replyNotice/";
    $target_file = $target_dir . basename($_FILES["attachment_file"]["name"]);
    $uploadOk = 0;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    if (file_exists($target_file)) 
        {
            //echo "Sorry, file already exists.";
            $uploadOk = 1;
        }
    if ($_FILES["attachment_file"]["size"] > 50000000)
        {
            //echo "Sorry, your file is too large.";
            $uploadOk = 2;
        }
    //if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "txt" )
    if($imageFileType != "pdf" && $imageFileType != "PDF" ) 
        {
            //echo "Sorry, only doc, docx, pdf,txt";
            $uploadOk = 3;
        }
    if ($uploadOk == 1 || $uploadOk == 2 || $uploadOk == 3 ) 
        {
            if($uploadOk == 1){
                echo '<script> alert("Error!!!! File Name already exist in directory");window.location.assign("dashboardBranch.php");</script>';
            }
            if($uploadOk == 2){
                echo '<script> alert("Error!!!! File is too large ");window.location.assign("dashboardBranch.php");</script>';
            }
            if($uploadOk == 3){
                echo '<script> alert("Error!!!! Only PDF file is allowed ");window.location.assign("dashboardBranch.php");</script>';
            }
           //echo "Sorry, your file was not uploaded.";
        } 
    else 
    {
        if (move_uploaded_file($_FILES["attachment_file"]["tmp_name"], $target_file)) 
            {
                //echo "The file ". basename( $_FILES["attachment_file"]["name"]). " has been uploaded.";
            } 
        else 
            {
                //echo "Sorry, there was an error uploading your file.";
            }
    }
    $exec_sql = $con->query($sql);
    if($exec_sql ===TRUE){
        echo '<script> alert("Notice Reply Successfully"); window.location.assign("dashboardBranch.php");</script>';
        //echo "done";
    }
    else{
        echo '<script> alert("Error!!!! Notice Not Send "); window.location.assign("dashboardBranch.php");</script>';
        //echo "Not done".$con->error;
    }
}