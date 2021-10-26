<?php
session_start();
if (!$_SESSION["username"]) {

    header("Location: login.php"); //redirect to the login page to secure the welcome page without login access.  
} else {
    include_once 'connection.php';
    $count = 0;
    $count1 = 0;
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
    <link rel="stylesheet" href="css/asd.css">
    <title>Dashboard</title>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" type="text/css" href="asd.css">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
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
                <h2 style="color:#55B1F0;margin-left:200px;">Status of Branch Reply</h2>
                <hr>
                <form action="branchRepliedApi.php" method="post">
                    <div class="alert alert-danger">
                        <input type="text" name="searchText" placeholder="Notice Reference No" required>
                        <button type="submit" name="search"> Search </button>
                    </div>
                    <!-- <div class="alert alert-danger">
                        <strong>Sorry!</strong> Not implemented yet .
                    </div> -->

                </form>
            </div>
            <!-- Start -->
            <?php
            //$val = 0;
            //$val = $_REQUEST["nr"]; 
            //if($val)
            //{
            ?>
            <div class="row" id="summaryInfo" style="display: none">
            <h2 style="color:#1101C0;margin-left:200px;">Letter No : <?php echo $_SESSION["reply"]; ?></h2>
                <div class="col-lg-6">
                    <div class="container bootstrap snippet">
                        <div class="col-lg-2 col-sm-6">
                            <div class="circle-tile ">
                                <a href="branchRepliedApi.php?token=r">
                                    <div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div>
                                </a>
                                <div class="circle-tile-content dark-blue">
                                    <div class="circle-tile-description text-faded"> Branch Replied</div>
                                    <div class="circle-tile-number text-faded "><?php echo $_REQUEST["r"]; ?></div>
                                    <a class="circle-tile-footer" href="branchRepliedApi.php?token=r">More Info<i class="fa fa-chevron-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="container bootstrap snippet">
                        <div class="col-lg-2 col-sm-6">
                            <div class="circle-tile ">
                                <a href="branchRepliedApi.php?token=nr">
                                    <div class="circle-tile-heading red"><i class="fa fa-users fa-fw fa-3x"></i></div>
                                </a>
                                <div class="circle-tile-content red">
                                    <div class="circle-tile-description text-faded"> Branch Not Replied</div>
                                    <div class="circle-tile-number text-faded "><?php echo $_REQUEST["nr"]; ?></div>
                                    <a class="circle-tile-footer" href="branchRepliedApi.php?token=nr">More Info<i class="fa fa-chevron-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            <?php
            //} 
            ?>
            <!-- END-->
            <!-- Start Table for Replied and Not Replied List Table -->
            <div class="content-body" style="display:none">
                <h2 style="color:#55B1F0;margin-left:200px;">All Notice</h2>
                <hr>
                <table id="example" class="table display table-stripped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Branch Code</th>
                            <th>Branch Name</th>
                            <th>Notice Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * from fsib_notice where notice_refno in (select notice_refno from fsb_notice_rep where status = 'decline')";
                        //print_r($sql);
                        //var_dump($sql);
                        //die();
                        $exec_sql = $con->query($sql);
                        //print_r($sql);
                        //var_dump($sql);
                        //die();
                        if ($exec_sql->num_rows > 0) {
                            while ($row = $exec_sql->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><?php echo $row["notice_refno"]; ?></td>
                                    <td><?php echo $row["fsib_notice_sub"]; ?></td>
                                    <td><?php echo $row["fsib_notice_from"]; ?></td>
                                    <td><?php echo $row["fsib_notice_ref"]; ?></td>
                                    <td><?php echo $row["fsib_description"]; ?></td>
                                    <td><?php echo $row["fsib_lst_sub_dt"]; ?></td>
                                    <?php
                                    if ($row['fsib_notice_path'] == null) {
                                    ?>
                                        <td style="color:red; font-size:11px"><b>No Attachment</b></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td><a href="media/<?php echo $row['fsib_notice_path'] ?>" target="_blank">View</a></td>

                                    <?php
                                    }
                                    ?>
                                    <td><a href="branchReply.php?refno=<?php echo $row["notice_refno"]; ?>&& sub= <?php echo $row["fsib_notice_sub"]; ?> "><button type="submit" class="btn-xs btn-primary">Reply</button> </a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- END Table for Replied and Not Replied List Table -->
        </div>
    </div>
    <script>
        var isNew = <?php echo json_encode($_REQUEST["r"]); ?>;
        document.getElementById("summaryInfo").style.display = isNew ? "block" : "none";
    </script>
</body>

</html>