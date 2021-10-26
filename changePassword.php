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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
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
                <div class="title">AML & CFTD System <span>FOR BRANCH</span></div>
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
                        <a href="dashboardBranch.php" class="menu-btn">
                            <i class="fa fa-desktop"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="sentItem.php" class="menu-btn">
                            <i class="fa fa-envelope-o" aria-hidden="true"> </i> <span>Sent Item</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="branchReminderNotice.php" class="menu-btn">
                            <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Reminder Notice</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="packageBranch.php" class="menu-btn">
                            <i class="fa fa-upload" aria-hidden="true"> </i> <span>Packages</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="changePassword.php" class="menu-btn">
                            <i class="fa fa-key" aria-hidden="true"> </i> <span>Change Password</span>
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

        <div class="col-md-8 offset-6">
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
                            <button type="submit" class="btn btn-success btn-lg float-right" name="cgpassword">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $('#inputPasswordNew, #inputPasswordNewVerify').on('keyup', function () {
  if ($('#inputPasswordNew').val() == $('#inputPasswordNewVerify').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
</script>
</html>