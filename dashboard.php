<?php
session_start();

if(!$_SESSION["username"])  
{
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}  
else{
    include_once 'connection.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> -->
    <title>Dashboard Table</title>
</head>

<body>
    <!--navbar-->
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For ADMIN</span></div>
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
    <!--Sidebar Start  -->
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
        <div class="col-md-9 content">
            <div class="content-body " style="margin-left:50px;">
                <h2 style="color:#55B1F0;margin-left:350px;">All Notice Recieve List</h2>
                <hr>
                <table id="example" class="table table-striped table-bordered table-hover" style="width:100%;text-align: center">
                    <thead class="thead-dark">
                        <tr>
                            <!-- <th style="text-align: center">Reference No </th> -->
                            <th style="text-align: center">Letter No</th>
                            <th style="text-align: center">Branch Code</th>
                            <th style="text-align: center">Branch Name </th>
                            <th style="text-align: center">Description</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Attachment</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$sql = "select branch_code, branch_name,  'NILL' as Status, 'Attachment','unknown' as Noticeref,'Description' from fsib_branch where branch_code not in (select fsib_branch_code from fsb_notice_rep) UNION select fsib_branch_code, branch_name,'Account Found' as Status,fsib_reply_path,notice_refno,fsib_description from fsb_notice_rep left outer join fsib_branch on fsib_branch.branch_code= fsb_notice_rep.fsib_branch_code";
                        $sql = "select fsib_branch_code, branch_name,accountInfo,fsib_reply_path,fsib_reply_path_1,fsib_reply_path_2,fsib_reply_path_3,notice_refno,fsib_description from fsb_notice_rep left outer join fsib_branch on fsib_branch.branch_code= fsb_notice_rep.fsib_branch_code where status = 'approved'";

                        $exec_sql = $con->query($sql);
                        
                        if ($exec_sql->num_rows > 0) {
                            while ($row = $exec_sql->fetch_assoc()) {

                        ?>
                            <tr>
                                <td><?php echo $row["notice_refno"]; ?></td>
                                <td><?php echo $row["fsib_branch_code"]; ?></td>
                                <td><?php echo $row["branch_name"]; ?></td>
                                <td><?php echo $row["fsib_description"]; ?></td>
                                <td><?php echo $row["accountInfo"]; ?></td>
                                <?php
                                if($row["accountInfo"]=="Not Found"){
                                    ?>
                                    <td><a href="replyNotice/<?php echo $row['Attachment'] ?>" target="_blank"><button  class="btn-xs btn-danger" disabled>Preview</button></a> </td>
                                    <?php
                                }
                                else{
                                    ?>
                                    <!-- <td><a href="replyNotice/<?php echo $row['Attachment'] ?>" target="_blank"><button  class="btn-xs btn-info ">Preview</button></a> </td> -->
                                    <!-- new code add start -->
                                    <td>
                                <?php
                                if(!empty($row['fsib_reply_path']) && empty($row['fsib_reply_path_1']) && empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
                                    ?>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'>1.&nbsp;<?php echo $row['fsib_reply_path'];?> </a><br>
                                    <?php
                                    }
                                elseif(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
                                    ?>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'>1.&nbsp;<?php echo $row['fsib_reply_path'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'>2.&nbsp;<?php echo $row['fsib_reply_path_1'];?> </a><br>
                                    <?php
                                    }
                                elseif(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && !empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
                                    ?>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'>1.&nbsp;<?php echo $row['fsib_reply_path'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'>2.&nbsp;<?php echo $row['fsib_reply_path_1'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_2'];?>'>3.&nbsp;<?php echo $row['fsib_reply_path_2'];?> </a><br>
                                    <?php
                                    }
                                //if(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && !empty($row['fsib_reply_path_2']) && !empty($row['fsib_reply_path_3'])){
                                   else{
                                    ?>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'>1.&nbsp;<?php echo $row['fsib_reply_path'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'>2.&nbsp;<?php echo $row['fsib_reply_path_1'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_2'];?>'>3.&nbsp;<?php echo $row['fsib_reply_path_2'];?> </a><br>
                                    <a href='replyNotice/<?php echo $row['fsib_reply_path_3'];?>'>4.&nbsp;<?php echo $row['fsib_reply_path_3'];?> </a><br>
                                    <?php
                                    }
                                    ?>
                            </td>

                                    <!-- new code add End -->
                                    <?php
                                }
                                ?>
                                
                            </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>