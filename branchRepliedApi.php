<?php
session_start();

include_once 'connection.php';
//global $textName;
//$msg="Status of Branch Reply";
//$token="";
global $msg;
//$token = $_GET["token"]; 
if ($_GET["token"] == "nr") {
    $msg = 'Pending Banch List';
}
if ($_GET["token"] == "r") {
    $msg = "Replied Branch List";
}
if (isset($_REQUEST["search"])) {

    $textName = $_REQUEST["searchText"];
    $_SESSION["reply"] = $textName;

    $sqlForSearchNotice = "select count(*) as total from fsib_notice where notice_refno = '" . $textName . "'";

    $exec_sqlForSearchNotice = $con->query($sqlForSearchNotice);
    $data = $exec_sqlForSearchNotice->fetch_assoc();
    $total =  $data["total"];
    //print_r($exec_sqlForSearchNotice);
    //die();
    if ($total > 0) {
        $sql = "select * from fsb_notice_rep where notice_refno = '" . $textName . "' AND status = 'approved'";
        //print_r($sql);
        //die();
        //$sql1 = "select * from fsib_branch where branch_code not in (select fsib_branch_code from fsb_notice_rep where notice_refno = '".$textName."')" ;
        $sql1 = "select fsib_branch.branch_code, fsib_branch.branch_name,'" . $_SESSION["reply"] . "' as Notice_Ref from fsib_branch where branch_code not in (select fsib_branch_code from fsb_notice_rep where notice_refno = '" . $_SESSION["reply"] . "' and STATUS = 'approved')";
        $exec_sql = $con->query($sql);
        //print_r($sql);
        $totalReply = $exec_sql->num_rows;
        //print_r($sql);
        //die();
        //print_r($sql1);
        //$result = mysqli_query($con,$sql);
        /*$tests= mysqli_num_rows($result);
        //print_r($tests);
        print_r($exec_sql->num_rows);
        die();
        $count1 = 0;
        if($exec_sql->num_rows>0){
            while($row = $exec_sql->fetch_assoc()){
            $count1++;    
            }
        }*/

        $exec_sql2 = $con->query($sql1);
        $totalNotReply = $exec_sql2->num_rows;
        //echo  $row = count($exec_sql->fetch_assoc());
        /*$count = 0;
        if($exec_sql2->num_rows>0){
            while( $row = $exec_sql2->fetch_assoc()){
            $count++;    
            }
    
        }*/
        echo '<script> window.location.assign("branchReplied.php?r=' . $totalReply . '&&nr=' . $totalNotReply . '");</script>';
        //echo $row;
        //echo $count;
    } else {

        echo '<script> alert("No Notice Found By This Name"); window.location.assign("branchReplied.php");</script>';
    }
}

//================================

echo '
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<title>Sent Notice</title>
</head>

<body>
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For Admin</span></div>
                <!-- <div class="sidebar-btn">
                    <i class="fa fa-bars"></i>
                </div> -->
                <!-- <ul>
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-bell"></i></a></li>
                    <li><a href="#"><i class="fa fa-power-off"></i></a></li>
                </ul> -->
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-3">
    <div class="sidebar">
        <div class="sidebar-menu">
            <li class="item">
                <a href="dashboard.php" class="menu-btn">
                    <i class="fa fa-desktop"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="item">
                <a href="sentNoticeBox.php" class="menu-btn">
                    <i class="fa fa-envelope-o"></i><span>Sent Items</span>
                </a>
            </li>

            <li class="item">
                <a href="sendNotice.php" class="menu-btn">
                    <i class="fa fa-plus-square" aria-hidden="true"> </i> <span>Create Notice</span>
                </a>
            </li>

            <li class="item" id="profile">
                <a href="#profile" class="menu-btn">
                    <i class="fa fa-file-text-o"></i> <span>Statement <i class="fa fa-chevron-down drop-down"></i></span>
                </a>
                <div class="sub-menu">
                    <a href="branchReplied.php"><i class="fa fa-image"></i><span>Status of Branch Reply</span></a>
                    <a href="noAccountFound.php"><i class="fa fa-address-card"></i><span>Nil Statement</span></a>
                    <a href="accountFound.php"><i class="fa fa-address-card"></i><span>A/C Found Statement</span></a>
                    <a href="reminderList.php"><i class="fa fa-address-card"></i><span>Reminder Status</span></a>
                </div>
            </li>
            <li class="item" id="upload">
                <a href="#upload" class="menu-btn">
                    <i class="fa fa-upload"></i><span>Upload Package <i class="fa fa-chevron-down drop-down"></i></span>
                </a>
                <div class="sub-menu">
                    <a href="uploadPackage.php" class="menu-btn">
                        <i class="fa fa-cloud-upload" aria-hidden="true"> </i> <span>Upload Package</span>
                    </a>
                    <a href="uploadedPackageList.php" class="menu-btn">
                        <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Package List</span>
                    </a>
                </div>
            </li>
            <li class="item" id="settings">
                <a href="#settings" class="menu-btn">
                    <i class="fa fa-cog"></i><span>Settings <i class="fa fa-chevron-down drop-down"></i></span>
                </a>
                <div class="sub-menu">
                    <a href="createUser.php"><i class="fa fa-user-circle"></i><span>Create User</span></a>
                    <a href="changePasswordAml.php"><i class="fa fa-key"></i><span>Change Password</span></a>
                </div>
            </li>
            <li class="item">
                <a href="about.php" class="menu-btn">
                    <i class="fa fa-info-circle"></i><span>About</span>
                </a>
            </li>
            <li class="item">
                <a href="logout.php" class="menu-btn">
                    <i class="fa fa-sign-out"></i><span>Log out</span>
                </a>
            </li>
        </div>
    </div>
</div>
    <div class="col-md-2 content">

    </div>
    <div class="col-md-7 content">
        <h2 style="color:#55B1F0;margin-left:200px;">' . $msg."<br><span  style='color:#1101C0;font-size:25px;'>Letter No:-".$_SESSION["reply"] . '</span></h2>
        <hr>
        <br>
        <div class="content-body">
<table id="example" class="table display table-stripped table-bordered" style="width:100%">
<thead>
    <tr>
        <th>Branch Code</th>
        <th>Branch Name</th>
        <th>Branch Mail</th>                    
    </tr>
</thead>
<tbody>
<tr>
';

//================================
//global $replyForNotice;
if ($_REQUEST["token"] == "nr") {
    //echo $_REQUEST["token"];
    //echo $textName;
    //die();
    //$replyForNotice = $textName;


    $sqlNotReplied = "select fsib_branch.branch_code, fsib_branch.branch_name,fsib_branch.branch_mail,'" . $_SESSION["reply"] . "' as Notice_Ref from fsib_branch where branch_code not in (select fsib_branch_code from fsb_notice_rep where notice_refno = '" . $_SESSION["reply"] . "' and STATUS = 'approved')";

    //print_r($sqlNotReplied);
    //die();
    $exec_sqlNotReplied = $con->query($sqlNotReplied);
    if ($exec_sqlNotReplied->num_rows > 0) {
        //echo '<table><tr><th>Branch Code</th><th>Branch Name</th><th>Notice Reference</th></tr><tr>';
        while ($row = $exec_sqlNotReplied->fetch_assoc()) {
            //print_r($row); 
            echo '
         <td>' . $row["branch_code"] . '</td>
         <td>' . $row["branch_name"] . '</td>
         <td>' . $row["branch_mail"] . '</td>
         </tr>';
        }
    }

    $token = "nr";
    //print_r($exec_sqlNotReplied->num_rows);
    //die();
    //$arr=array();
    //$a= array();
    //if($exec_sqlNotReplied->num_rows>0){
    //echo '<table><tr><th>Branch Code</th><th>Branch Name</th><th>Notice Reference</th></tr><tr>';
    //while($row = $exec_sqlNotReplied->fetch_assoc()){
    //print_r($row); 
    /*echo '
         <td>'.$row["branch_code"].'</td>
         <td>'.$row["branch_name"].'</td>
         <td>'.$row["Notice_Ref"].'</td>
         </tr>';*/
    //$a[]=array(
    //'bc'=>$row["branch_code"],
    //'bn'=>$row["branch_name"],
    //'nref' => $row["Notice_Ref"],
    // );        
    //$arr["details"] = $a; 
    //}
    //print_r(json_encode($arr));
    //echo'</table>';
    //}
}

if ($_REQUEST["token"] == "r") {
    //echo $_REQUEST["token"];
    //echo $textName;
    //echo $replyForNotice;
    //die();
    //$sqlReplied = "select * from fsib_branch where branch_code in (select fsib_branch_code from fsb_notice_rep where notice_refno = '".$textName."')" ;

    $sqlReplied = "select fsib_branch.branch_code, fsib_branch.branch_name, fsb_notice_rep.notice_refno from fsb_notice_rep inner join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code  where notice_refno = '" . $_SESSION["reply"] . "' and status = 'approved' order by branch_code";
    //print_r($sqlReplied);
    //print_r($sqlReplied);
    $exec_sqlReplied = $con->query($sqlReplied);
    if ($exec_sqlReplied->num_rows > 0) {
        //echo '<table><tr><th>Branch Code</th><th>Branch Name</th><th>Notice Reference</th></tr><tr>';
        while ($row = $exec_sqlReplied->fetch_assoc()) {
            //print_r($row); 
            echo '
         <td>' . $row["branch_code"] . '</td>
         <td>' . $row["branch_name"] . '</td>
         <td>' . $row["notice_refno"] . '</td>
         </tr>';
        }
        //echo'</table>';
    }
    $token = "r";
}
echo '
    </tbody>
    </table>
    <a href = "report_pdf.php?token=' . $token . '"><input type="submit" value="Print" name="report_submit" style="cursor:pointer; padding:7px; font-weight:bold;" /></a>
    ';
if ($token == "nr") {
    echo '<a href = "sentReminderApi.php?token=reminder"><input type="submit" value="Reminder" name="sent_reminder" style="cursor:pointer; padding:7px; font-weight:bold;" /></a>';
}
echo '   
    </div>
    </div>
    <div class="col-md-2 content">

    </div>
</div>
</body>

</html>
    ';
