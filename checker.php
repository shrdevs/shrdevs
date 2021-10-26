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
    <title>Checker Dashboard</title>
</head>

<body>
    <link href="contact-form.css" rel="stylesheet">
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For Checker</span></div>
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
                        <a href="checker.php" class="menu-btn">
                            <i class="fa fa-desktop"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="sentItemChecker.php" class="menu-btn">
                            <i class="fa fa-desktop"></i><span>Authorize History</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="changePasswordChecker.php" class="menu-btn">
                            <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Change Password</span>
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
        
        <div class="col-md-8 content">
            <h2 style="color:#55B1F0;margin-left:200px;">Permission</h2>
            <hr>
            <br>
            <div class="content-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Letter No</th>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Deadline</th>                       
                        <th>Attachment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        //query incomplete, NEED join query reply and notice table
                            //$sql = "select * from fsb_notice_rep where fsib_branch_code='".$_SESSION['branch_code']."' AND (length(`fsib_checker`) = 0 or length(`status`) = 0)";
                            $sql = "select fsib_notice.notice_refno,fsib_notice.fsib_description,fsib_reply_path,fsib_reply_path_1,fsib_reply_path_2,fsib_reply_path_3 ,fsib_notice_from,fsib_notice_sub,fsib_lst_sub_dt from fsb_notice_rep inner join fsib_notice on fsib_notice.notice_refno = fsb_notice_rep.notice_refno where fsib_branch_code='".$_SESSION['branch_code']."' AND (length(`fsib_checker`) = 0 or length(`status`) = 0)";
                        // query execution comment for incomplete query above.
                            $exec_sql = $con->query($sql);
                            if ($exec_sql->num_rows > 0) {
                            while ($row = $exec_sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["notice_refno"]; ?></td>
                            <td><?php echo $row["fsib_notice_from"]; ?></td>
                            <td><?php echo $row["fsib_notice_sub"]; ?></td>
                            <td><?php echo $row["fsib_description"]; ?></td>
                            <td><?php echo $row["fsib_lst_sub_dt"]; ?></td>
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
                            <td><a href="checkerAuthorize.php?auth=yes&&nr=<?php echo $row['notice_refno'];?>"><button type="submit" name="auth_yes" class="btn-xs btn-primary">Authorize</button></a> / <a href="checkerAuthorize.php?auth=no&&nr=<?php echo $row['notice_refno'];?>" ><button type="submit" name="decline" class="btn-xs btn-danger">Decline</button></a></td>
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