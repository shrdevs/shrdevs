<?php
session_start();
if (!$_SESSION["username"]) {

    header("Location: login.php"); //redirect to the login page to secure the welcome page without login access.  
} else {
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
        <div class="col-md-9 content">
            <h2 style="color:#55B1F0;margin-left:200px;">Create User</h2>
            <hr>
            <br>
            <div class="content-body">
                <form action="createUserApi.php" method="POST">
                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Branch Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="branch_code" name="branch_code">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">User Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="user_code" name="user_code">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="user_name" name="user_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="pass_word" name="pass_word">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="con_pass_word" name="con_pass_word">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-5">
                            <select name="role" class="form-control" onchange="showDiv('hidden_div', this)">
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>

                    <div id="hidden_div" class="form-group row" style="display:none">
                        <label for="inputSubject" class="col-sm-2 col-form-label">User Type</label>
                        <div class="col-sm-5">
                            <select name="user_type" class="form-control">
                                <option value="Checker">Checker</option>
                                <option value="Maker">Maker</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" name="create_user" class="btn btn-primary" style="margin-left: 10px;">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == "User" ? 'block' : 'none';
        }
    </script>
</body>

</html>