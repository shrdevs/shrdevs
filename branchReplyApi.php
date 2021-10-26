<?php
session_start();


include_once 'connection.php';

if(isset($_POST["reply_notice"])){
    $branch_code = $_POST["branch_code"];
    $notice_refno = $_POST["notice_refno"];
    $status = $_POST["status"];
    //print_r($status);
    
    $fsib_description=$_POST["fsib_description"];
    //$fsib_reply_path= $_FILES["files"]["name"];
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
    //$sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','".$fsib_reply_path."','','','','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
    //print_r($sql);
    //die();
    //var_dump($exec_sql);
    
    //var_dump($exec_sql);
    //print_r($exec_sql);
    //die();
    
    //New Code Paste Here Start

    $targetDir = "replyNotice/";
    $allowTypes = array('pdf', 'PDF');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);

    //test code
    $imgname = array();
    //$imagesNo='';
    //print_r(count($fileNames));
    //die();
    $total = count($fileNames);
    if($total <= 4){
        $uploadOk = 0;
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $oldfileName = basename($_FILES['files']['name'][$key]);
            $fileName = $branch_code.'_'.$notice_refno.'_'.round(microtime(true)).'_'.$oldfileName;
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
                    echo '<script> alert("Error!!!! File Name already exist in directory");window.location.assign("dashboardBranch.php");</script>';
                }
                if ($uploadOk == 2) {
                    echo '<script> alert("Error!!!! File is too large ");window.location.assign("dashboardBranch.php");</script>';
                }
                if ($uploadOk == 3) {
                    echo '<script> alert("Error!!!! Only PDF file is allowed ");window.location.assign("dashboardBranch.php");</script>';
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
        //print_r("insert into images values(null,'".$emp_id."',".$imagesNo.$br_code.")");
        //print_r(count($imgname));
        //print_r($imgname);
        //die();
        if (!empty($insertValuesSQL)) {
            //if(!empty($imgname)){    
            //$insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            //$insert = $conn->query("INSERT INTO mimages (file_name, uploaded_on) VALUES $insertValuesSQL");
            $imgCount = count($imgname);
            //print_r($imgCount);
            if ($imgCount == 1) {
                //$query = "INSERT INTO images VALUES (null,'" . $emp_id . "','" . $imgname[0] . "','','','" . $br_code . "')";
                $sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','".$imgname[0]."','','','','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
                //$insert = $con->query($sql);
                //print_r($sql);
            } elseif ($imgCount == 2) {
                //$query = "INSERT INTO images VALUES (null,'" . $emp_id . "','" . $imgname[0] . "','" . $imgname[1] . "','','" . $br_code . "')";
                $sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','" . $imgname[0] . "','" . $imgname[1] . "','','','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
                //$insert = $con->query($sql);
                //print_r($sql);
            } elseif($imgCount == 3) {
                //$query = "INSERT INTO images VALUES (null,'" . $emp_id . "','" . $imgname[0] . "','" . $imgname[1] . "','" . $imgname[2] . "','" . $br_code . "')";
                $sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','".$imgname[0]."','".$imgname[1]."','".$imgname[2]."','','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
                //$insert = $con->query($sql);
                //print_r($sql);
            }
            else{
                //$query = "INSERT INTO images VALUES (null,'" . $emp_id . "','" . $imgname[0] . "','" . $imgname[1] . "','" . $imgname[2] . "','" . $br_code . "')";
                $sql = "INSERT INTO fsb_notice_rep VALUES('','".$notice_refno."','".$branch_code."','".$fsib_description."','".$status."','".$imgname[0]."','".$imgname[1]."','".$imgname[2]."','".$imgname[3]."','".$fsib_maker_user."','".$fsib_maker_dt."','','','')";
                //$insert = $con->query($sql);
                //print_r($sql);
            }
            $insert = $con->query($sql);
            //print_r($sql);
            if ($insert === True) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = 'Files upload and Notice Reply  successfull'.$errorMsg;
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

    // Display status message 
    //echo '<script> alert("Files upload & Notice reply successful."'. $errorMsg.'); window.location.assign("dashboardBranch.php");</script>';
    echo '<script> alert("'.$statusMsg.'"); window.location.assign("dashboardBranch.php");</script>';

    //echo $statusMsg;
    //New Code Paste END
}
    
