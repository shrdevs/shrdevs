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
        <div class="col-md-2 content">

        </div>
        <div class="col-md-7 content">
            <h2 style="color:#55B1F0;margin-left:200px;">Reminder Notice Reply</h2>
            <hr>
            <br>
            <div class="content-body">
                <table id="example" class="table display table-stripped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Branch Code</th>
                            <th>Notice Refference</th>
                            <th>subject</th>
                            <th>Date</th>
                            <th>Reminder No</th>
                            <th>Action</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$sql = "SELECT * FROM fsib_notice where notice_refno not in (select notice_refno from fsb_notice_rep where fsib_branch_code = '".$_SESSION["branch_code"]."') order by fsib_entry_dt desc";
                        $sql = "SELECT rem_br_code,rem_notice_ref,rem_sub,max(rem_date) as rem_date,max(rem_no) as rem_no FROM fsib_notice_reminder where rem_br_code ='".$_SESSION["branch_code"]."' and (rem_br_code,rem_notice_ref) not in (select  fsib_branch_code,notice_refno From fsb_notice_rep where fsib_branch_code = '" . $_SESSION["branch_code"] . "') group by rem_br_code,rem_notice_ref,rem_sub";
                        //print_r($sql);
                    
                        //print_r($sql);
                        ///var_dump($sql);
                        //die();
                        $exec_sql = $con->query($sql);
                        $count = $exec_sql->num_rows;
                        //var_dump($count);
                        //var_dump($exec_sql);
                        //die();
                        if ( $count> 0) {
                            while ($row = $exec_sql->fetch_assoc()) {
                            //$row = $exec_sql->fetch_assoc();
                        ?>
                                <tr>
                                    <td><?php echo $row["rem_br_code"]; ?></td>
                                    <td><?php echo $row["rem_notice_ref"]; ?></td>
                                    <td><?php echo $row["rem_sub"]; ?></td>
                                    <td><?php echo $row["rem_date"]; ?></td>
                                    <td><?php echo $row["rem_no"]; ?></td>                                   
                                    <td><a href="branchReply.php?refno=<?php echo $row["rem_notice_ref"]; ?>&& sub= <?php echo $row["rem_sub"]; ?> "><button type="submit" class="btn-xs btn-primary">Reply</button> </a></td>
                                </tr>
                        <?php
                            }
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2 content">

        </div>
    </div>
</body>

</html>