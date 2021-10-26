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
    <title>Sent Notice</title>
</head>

<body>
    <link href="contact-form.css" rel="stylesheet">
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For Branch</span></div>
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
                            <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Sent Item</span>
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
        <div class="col-md-2 content">

        </div>
        <div class="col-md-7 content">
            <h2 style="color:#55B1F0;margin-left:200px;">Correction Request Apply</h2>
            <hr>
            <br>
            <div class="content-body">
                <form action="branchReplyApi.php" enctype="multipart/form-data" method="POST">
                    <div class="fcf-form-group">
                        <label for="Name" class="fcf-label">Branch Code</label>
                        <div class="fcf-input-group">
                            <input type="text" id="branch_code" name="branch_code" class="fcf-form-control" value="<?php echo $_SESSION['branch_code'] ?>" required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="Email" class="fcf-label">Notice Refference NO</label>
                        <div class="fcf-input-group">
                            <input type="text" id="notice_refno" name="notice_refno" class="fcf-form-control"  required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="Email" class="fcf-label">Subject</label>
                        <div class="fcf-input-group">
                            <input type="text" id="subject" name="fsib_subject" class="fcf-form-control"  required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="inputAnswer" class="fcf-label">Status</label>
                        <div class="fcf-input-group">
                            <select name="status" class="form-control">
                                <option value="">Select Option</option>
                                <option value="1">Account Found</option>
                                <option value="0">No Account Found</option>
                            </select>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <label for="Message" class="fcf-label">Description</label>
                        <div class="fcf-input-group">
                            <textarea id="Message" name="fsib_description" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attachFile" class="col-sm-2 col-form-label">Attachment</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="attachFile" name="attachment_file" required>
                        </div>
                    </div>

                    <div class="fcf-form-group">
                        <button type="submit" name = "reply_notice" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send Reply</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2 content">

        </div>
    </div>
</body>

</html>