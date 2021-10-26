<?php

include_once 'connection.php';

if(isset($_POST["sendNotice"])){
    $notice_refno= $_POST["notice_ref_no"];
    $fsib_entry_dt= date("Y-m-d", strtotime($_POST["fsibl_entry_date"]));
    $fsib_notice_sub= $_POST["subject"];
    $fsib_notice_from= $_POST["notice_from"]; 
    $fsib_notice_ref= $_POST["fsibl_notice_ref"]; 
    $fsib_description= $_POST["fsibl_description"];
    $fsib_notice_path= $_FILES["attachment_file"]["name"];
    $fsib_last_sub_dt= date("Y-m-d", strtotime($_POST["fsibl_last_sub_date"]));
    $fsib_notice_dt= date("Y-m-d", strtotime($_POST["fsibl_notice_date"]));
    
    //echo $fsib_entry_dt;
    //echo $_FILES["attachment_file"]["size"];
    //die();
    $sql_search = "SELECT fsib_notice_path FROM fsib_notice where fsib_notice_path = '".$fsib_notice_path."'";
    $exec_sql_search = $con->query($sql_search);

    if($exec_sql_search->num_rows >0)
    {
        echo '<script> alert("Error!!!! File Name already exist in database. "); window.location.assign("sendNotice.php");</script>';
    }

    //$sql = "INSERT INTO fsib_notice VALUES(null,'".$notice_refno."','".$fsib_entry_dt."','".$fsib_notice_sub."','".$fsib_notice_from."','".$fsib_notice_ref."','".$fsib_description."','".$fsib_notice_path."','".$fsib_last_sub_dt."','".$fsib_notice_dt."')";
    //print_r($sql);
    //print_r($sql);
    //die();
    //var_dump($exec_sql);
   
    //var_dump($exec_sql);
    //print_r($exec_sql);
    //die();
    

    $target_dir = "media/";
    $target_file = $target_dir . basename($_FILES["attachment_file"]["name"]);
    $uploadOk = 0;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // echo '<script> alert("Error!!!! '.$target_file.'");</script>';

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
            echo '<script> alert("Error!!!! File Name already exist in directory");window.location.assign("sendNotice.php");</script>';
        }
        if($uploadOk == 2){
            echo '<script> alert("Error!!!! File is too large ");window.location.assign("sendNotice.php");</script>';
        }
        if($uploadOk == 3){
            echo '<script> alert("Error!!!! Only PDF file is allowed ");window.location.assign("sendNotice.php");</script>';
        }
        //echo "Sorry, your file was not uploaded.";
    } 
    else 
    {
        if (move_uploaded_file($_FILES["attachment_file"]["tmp_name"], $target_file)) 
        {
            //$uploadOk == 33;
            //echo "The file ". basename( $_FILES["attachment_file"]["name"]). " has been uploaded.";
        } 
        else 
        {
            echo '<script> alert("Error!!!! File not Upload ");window.location.assign("sendNotice.php");</script>';
            //echo "Sorry, there was an error uploading your file.";
        }
    }
    // echo '<script> alert("Error!!!! '.$uploadOk.'");</script>';
    if($uploadOk == 0)
    {
        $sql = "INSERT INTO fsib_notice VALUES(null,'".$notice_refno."','".$fsib_entry_dt."','".$fsib_notice_sub."','".$fsib_notice_from."','".$fsib_notice_ref."','".$fsib_description."','".$fsib_notice_path."','".$fsib_last_sub_dt."','".$fsib_notice_dt."')";
        //print_r($sql);
       
        $exec_sql = $con->query($sql);
        //var_dump($exec_sql);
        //die();
    }
    if($exec_sql === TRUE && $uploadOk == 0){
        echo '<script> alert("Notice & Email Send Successfully"); window.location.assign("dashboard.php");</script>';
        //echo "done";
        /*******start mail code****** */
        $to = "shipu@fsiblbd.com"; // this is your Email address
        $from = "shafayet@fsiblbd.com"; // this is the sender's Email address
        $subject = "AML&CFTD New Message Notification";
        $message = "[Attn. Manager/BAMLCO]\n\n\nMuhataram,\n\nAssalmu Alaikum\n\nThis is a notification to inform you that there is a new message in AML&CFTD Query Management System\nfor your branch. Please log in the system from our Home Page immediately and take required actions in this regard.\n\n\nThis is for your kind perusal and necessary actions.\n\n\nMa- Assalam.\nYours Faithfully,\n\n\nAML & CFT Division\nFirst Security Islami Bank Limited\nHead Office, Dhaka.\nMobile # 01938886106";
        $headers = "From:" . $from;
        //$headers2 = "From:" . $to;
        ini_set('SMTP','192.168.53.100');
        ini_set('smtp_port',25);
        mail($to,$subject,$message,$headers);

        /*******End mail code********/
    }
    else{
        echo '<script> alert("Error!!!! Notice Not Send '.$con->error.'"); window.location.assign("sendNotice.php");</script>';
        //echo "Not done".$con->error;
    }
    
}
