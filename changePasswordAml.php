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
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap.min.css" id="bootstrap-css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Sent Notice</title>
    <script src="js/jquery.min.js"></script>


    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <link href="contact-form.css" rel="stylesheet">
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>FOR ADMIN</span></div>
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

        <div class="col-md-6 offset-1">
            <span class="anchor" id="formChangePassword"></span>
            <hr class="mb-5">
            <br><br><br>
            <!-- form card change password -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Change Password</h3>
                </div>
                <div class="card-body">
                    <form action="changePasswordApi.php" method="POST" class="form" role="form" autocomplete="off">
                        <div class="form-group">
                            <label for="inputPasswordOld">Current Password</label>
                            <input type="password" class="form-control" id="inputPasswordOld" required="" name="oldpass">
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordNew">New Password</label>
                            <input type="password" class="form-control" id="inputPasswordNew" required="" name="newpass">
                            <span class="form-text small text-muted">
                                The password must be 8-20 characters, and must <em>not</em> contain spaces.
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="inputPasswordNewVerify">Verify</label>
                            <input type="password" class="form-control" id="inputPasswordNewVerify" required="">
                            <span class="form-text small text-muted">
                                To confirm, type the new password again.
                            </span>
                            <span id='message'></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg float-right" name="cgpassword">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('#inputPasswordNew, #inputPasswordNewVerify').on('keyup', function() {
        if ($('#inputPasswordNew').val() == $('#inputPasswordNewVerify').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
</script>

</html>