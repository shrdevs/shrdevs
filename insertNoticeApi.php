<?php

include_once 'connection.php';

if(isset($_POST["sendNotice"])){
    $notice_refno= $_POST["notice_ref_no"];
    $fsib_entry_dt= date("Y-m-d", strtotime($_POST["fsibl_entry_date"]));
    $fsib_notice_sub= $_POST["subject"];
    $fsib_notice_from= $_POST["notice_from"]; 
    $fsib_notice_ref= $_POST["fsibl_notice_ref"];
    $fsib_description= $_POST["fsibl_description"]; 
    $fsib_last_sub_dt= date("Y-m-d", strtotime($_POST["fsibl_last_sub_date"]));
    $fsib_notice_dt= date("Y-m-d", strtotime($_POST["fsibl_notice_date"]));
    

    /*$sql_search = "SELECT fsib_notice_path FROM fsib_notice where fsib_notice_path = '".$fsib_notice_path."'";
    $exec_sql_search = $con->query($sql_search);

    if($exec_sql_search->num_rows >0)
    {
        echo '<script> alert("Error!!!! File Name already exist in database. "); window.location.assign("sendNotice.php");</script>';
    }*/
    $fsib_all_notice_path = array_filter($_FILES['files']['name']);
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $targetDir = "media/";
    $allowTypes = array('pdf', 'PDF');
    /*********  new test code implement start **************/
    $imgname = array();
    $total = count($fsib_all_notice_path);
    //echo 'alert("'.$total.'");</script>';
    if($total <= 3){
        $uploadOk = 0;
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $oldfileName = basename($_FILES['files']['name'][$key]);
            //$fileName = $notice_refno.'_'.round(microtime(true)).'_'.$oldfileName;
            $fileName = $notice_refno.'_'.$oldfileName;
            $targetFilePath = $targetDir . $fileName;
            //print_r($targetFilePath);
            //print_r($fileName);
            
            // Validation test start
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (file_exists($targetFilePath)) {
                //echo "Sorry, file already exists.";
                $uploadOk = 1;
            }
            if ($_FILES["files"]["size"][$key] > 50000000) {
                //echo "Sorry, your file is too large.";
                $uploadOk = 2;
            }
            //if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "txt" )
            if ($fileType != "pdf" && $fileType != "PDF") {
                //echo "Sorry, only doc, docx, pdf,txt";
                $uploadOk = 3;
            }
            if ($uploadOk == 1 || $uploadOk == 2 || $uploadOk == 3) {
                if ($uploadOk == 1) {
                    echo '<script> alert("Error!!!! File Name already exist in directory");window.location.assign("sendNotice.php");</script>';
                }
                if ($uploadOk == 2) {
                    echo '<script> alert("Error!!!! File is too large ");window.location.assign("sendNotice.php");</script>';
                }
                if ($uploadOk == 3) {
                    echo '<script> alert("Error!!!! Only PDF file is allowed ");window.location.assign("sendNotice.php");</script>';
                }
                //echo "Sorry, your file was not uploaded.";
            }

            // Validation test end
            // Check whether file type is valid 
            //$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= "('" . $fileName . "', NOW()),";
                    $imgname[] = $fileName;
                    //$imagesNo.="'".$fileName."',";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }
        
        if (!empty($insertValuesSQL)) {
            
            $imgCount = count($imgname);
            //print_r($imgCount);
            if ($imgCount == 1) {
                $sql = "INSERT INTO fsib_notice VALUES(null,'".$notice_refno."','".$fsib_entry_dt."','".$fsib_notice_sub."','".$fsib_notice_from."','".$fsib_notice_ref."','".$fsib_description."','".$imgname[0]."','','','".$fsib_last_sub_dt."','".$fsib_notice_dt."')";
                //$insert = $con->query($sql);
                //print_r($sql);
            } elseif ($imgCount == 2) {
                $sql = "INSERT INTO fsib_notice VALUES(null,'".$notice_refno."','".$fsib_entry_dt."','".$fsib_notice_sub."','".$fsib_notice_from."','".$fsib_notice_ref."','".$fsib_description."','".$imgname[0]."','".$imgname[1]."','','".$fsib_last_sub_dt."','".$fsib_notice_dt."')";                //$insert = $con->query($sql);
                //print_r($sql);
            }
            else{
                $sql = "INSERT INTO fsib_notice VALUES(null,'".$notice_refno."','".$fsib_entry_dt."','".$fsib_notice_sub."','".$fsib_notice_from."','".$fsib_notice_ref."','".$fsib_description."','".$imgname[0]."','".$imgname[1]."','".$imgname[2]."','".$fsib_last_sub_dt."','".$fsib_notice_dt."')";                //$insert = $con->query($sql);
                //$insert = $con->query($sql);
                //print_r($sql);
            }

            $exec_sql = $con->query($sql);
            //print_r($exec_sql);
            //die();
            if ($exec_sql === True) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = 'Files upload and Notice Reply  successfull';
                //echo '<script> alert("Files upload and Notice Reply  successfull."); window.location.assign("dashboardBranch.php");</script>';
            }
            else
            {
                $statusMsg = 'Sorry, there was an error replying your Notice.'.$errorMsg;
            }
        }
    }
    else
    {
        $statusMsg = 'You did not select a file or more than 4 to upload.'.$errorMsg;
    }


    /*********  new test code implement End  ***************/
       
    if($exec_sql === TRUE && $uploadOk == 0){
        // echo '<script> alert("Notice & Email Send Successfully"); window.location.assign("dashboard.php");</script>';
        //echo "done";
        /*******start mail code****** */
        $to = "shipu@fsiblbd.com"; // this is your Email address
        $from = "shafayet@fsiblbd.com"; // this is the sender's Email address
        $subject = "AML&CFTD New Message Notification for Lettr No:- ".$notice_refno;
        $message = "[Attn. Manager/BAMLCO]\n\n\nMuhataram,\n\nAssalmu Alaikum\n\nThis is a notification to inform you that there is a new message in AML&CFTD Query Management System\nfor your branch. Please log in the system from our Home Page immediately and take required actions in this regard.\n\n\nThis is for your kind perusal and necessary actions.\n\n\nMa- Assalam.\nYours Faithfully,\n\n\nAML & CFT Division\nFirst Security Islami Bank Limited\nHead Office, Dhaka.\nMobile # 01938886106";
        $headers = "From:" . $from;
        //$headers2 = "From:" . $to;
        ini_set('SMTP','192.168.53.100');
        ini_set('smtp_port',25);
        mail($to,$subject,$message,$headers);
        $statusMsg = "Notice & Email Send Successfully";
        /*******End mail code********/
    }
    else{
        $statusMsg = "Error!!!! Notice Not Send '.$con->error.'";
        //echo "Not done".$con->error;
    }
    echo '<script> alert("'.$statusMsg.'"); window.location.assign("dashboard.php");</script>';

    
}
