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
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Dashboard</title>
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
            <div class="content-body">
                <h2 style="color:#55B1F0;margin-left:200px;">" Account Found List"</h2>
                <hr>

                <form action="accountInfoApi.php" method="post">
                    <div class="alert alert-danger">
                        <input type="text" name="searchText" placeholder="Notice Reference No">
                        <input type="hidden" name="account" value="account" >
                        <button type="submit" name="search"> Search </button>
                    </div>
                    <!-- <div class="alert alert-danger">
                        <strong>Sorry!</strong> Not implemented yet .
                    </div> -->
                </form>
                <!-- <div class="alert alert-danger">
                    <strong>Sorry!</strong> Not implemented yet .
                    Query = SELECT notice_refno, fsib_branch_code, branch_name FROM `fsb_notice_rep` left outer join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code where upper(ltrim(rtrim(accountInfo))) = 'FOUND'
                </div> -->
            </div>
            <div class="content-body" id="summaryInfo" style="display:none">
                <!-- <h2 style="color:#55B1F0;margin-left:200px;">Info About Account Found Status</h2> -->
                <hr>
                <table id="example" class="table display table-stripped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Branch Code</th>
                            <th>Branch Name</th>
                            <th>Description</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($_REQUEST["r"]=="a")
                        {
                            $sql = "SELECT fsib_description, fsib_branch_code, branch_name,fsib_reply_path FROM `fsb_notice_rep` left outer join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code where upper(ltrim(rtrim(accountInfo))) = 'FOUND'";                            
                        }
                        else if($_REQUEST["r"]!=null)
                        {
                            $sql = "SELECT fsib_description, fsib_branch_code, branch_name,fsib_reply_path FROM `fsb_notice_rep` left outer join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code where upper(ltrim(rtrim(accountInfo))) = '".strtoupper('Found')."' and notice_refno = '".$_REQUEST["r"]."'";                           
                        }
                        else{
                            //echo "oops";
                            //print_r($_REQUEST["r"]);
                            //die();
                        }
                                                
                        $exec_sql = $con->query($sql);
                        
                        if ($exec_sql->num_rows > 0) {
                            while ($row = $exec_sql->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><?php echo $row["fsib_branch_code"]; ?></td>
                                    <td><?php echo $row["branch_name"]; ?></td>
                                    <td><?php echo $row["fsib_description"]; ?></td>
                                    <td>
                                        <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>' target="_blank">1.&nbsp;<?php echo $row['fsib_reply_path'];?> </a><br>
                                    </td>                                
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a href = "report_pdf.php?token=acc&&val=<?php echo $_REQUEST["r"];?>" ><input type="submit" value="Print" name="report_submit" style="cursor:pointer; padding:7px; font-weight:bold;" /></a>
            </div>
        </div>
    </div>
    <script>
        var isNew = <?php echo json_encode($_REQUEST["r"]); ?>;
        document.getElementById("summaryInfo").style.display = isNew ? "block" : "none";
    </script>
</body>

</html>