<?php 
session_start();

if(!$_SESSION["username"])  
{  
  
    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}  
else{
    include_once 'connection.php';
    //echo $_SESSION["branch_code"];
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
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <title>Dashboard Branch</title>
</head>

<body>
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System<span> For Branch </span></div>
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
        <div class="col-md-8 content">
            <div class="content-body">
                <h2 style="color:#55B1F0;margin-left:200px;">All Notice</h2>
                <hr>
                <table id="example" class="table display table-stripped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Package No</th>
                            <th>Package Name</th>
                            <th>Attachment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $sql = "select * from fsib_package_list";
                        $exec_sql = $con->query($sql);
                        //print_r($sql);
                        //var_dump($sql);
                        //die();
                        if ($exec_sql->num_rows > 0) {
                            while ($row = $exec_sql->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><?php echo $row["p_id"]; ?></td>
                                    <td><?php echo $row["p_name"]; ?></td>
                                    <!-- <td> php echo $row["fsib_notice_sub"]; </td> -->
                                    
                                    <?php
                                        if($row['p_file_path']==null){
                                            ?>
                                            <td style="color:red; font-size:11px"><b>No Attachment</b></td>
                                        <?php
                                        }
                                        else{
                                            ?>
                                            <td><a href="package/<?php echo $row['p_file_path'] ?>" target="_blank">View</a></td>

                                            <?php
                                        }
                                    ?>
                                    <td><?php echo $row["p_entry_date"]; ?></td>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

</body>

</html>