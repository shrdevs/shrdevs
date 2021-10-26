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
                <div class="title">AMLD System <span>For ADMIN</span></div>
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
                            <i class="fa fa-desktop"></i><span>Sent Items</span>
                        </a>
                    </li>

                    <li class="item">
                        <a href="sendNotice.php" class="menu-btn">
                            <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Sent Notice</span>
                        </a>
                    </li>

                    <li class="item" id="profile">
                        <a href="#profile" class="menu-btn">
                            <i class="fa fa-user-circle"></i> <span>Statement <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="branchReplied.php"><i class="fa fa-image"></i><span>Status of Branch Reply</span></a>
                            <a href="noAccountFound.php"><i class="fa fa-address-card"></i><span>Nil Statement</span></a>
                            <a href="accountFound.php"><i class="fa fa-address-card"></i><span>A/C Found Statement</span></a>
                            <a href="reminderList.php"><i class="fa fa-address-card"></i><span>Reminder Status</span></a>
                        </div>
                    </li>

                    <li class="item" id="settings">
                        <a href="#settings" class="menu-btn">
                            <i class="fa fa-cog"></i><span>Settings <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="createUser.php"><i class="fas fa-lock"></i><span>Create User</span></a>
                            <a href="changePassword.php"><i class="fas fa-language"></i><span>Change Password</span></a>
                        </div>
                    </li>
                    <li class="item">
                        <a href="about.php" class="menu-btn">
                            <i class="fa fa-info-circle"></i><span>About</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="logout.php" class="menu-btn">
                            <i class="fa fa-info-circle"></i><span>Log out</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="col-md-9 content">
            <div class="content-body">
                <h2 style="color:#55B1F0;margin-left:200px;">" Yet not replied List "</h2>
                <hr>


                <div class="alert alert-danger">
                    <strong>Sorry!</strong> Not implemented yet .
                </div>

            </div>
        </div>
    </div>
</body>

</html>