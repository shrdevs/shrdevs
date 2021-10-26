<?php

include_once 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> -->
    <title>Dashboard Table</title>
</head>

<body>
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AMLD System <span>Login</span></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <div class="sidebar-menu">
                    <li class="item">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-desktop"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Sent Notice</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-bell-o"></i> <span>Reminder</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-check-square-o"></i> <span>Check Status</span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="#profile" class="menu-btn">
                            <i class="fa fa-user-circle"></i> <span>Statement <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="#"><i class="fa fa-image"></i><span>Branch Replied</span></a>
                            <a href="#"><i class="fa fa-address-card"></i><span>Yet Not Replied</span></a>
                            <a href="#"><i class="fa fa-address-card"></i><span>Nil Statement</span></a>
                            <a href="#"><i class="fa fa-address-card"></i><span>A/C Found Statement</span></a>
                        </div>
                    </li>

                    <li class="item" id="settings">
                        <a href="#settings" class="menu-btn">
                            <i class="fa fa-cog"></i><span>Settings <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="#"><i class="fas fa-lock"></i><span>Create User</span></a>
                            <a href="#"><i class="fas fa-language"></i><span>Assign Password</span></a>
                        </div>
                    </li>
                    <li class="item">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-info-circle"></i><span>About</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="col-md-9 content">
            <div class="content-body">
                <h2 style="text-align: center;font-weight: 700;font-size: large; color: limegreen;">DataTable</h2>
                <table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ref. No</th>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Notice Refference</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM fsib_notice";
                        $exec_sql = $con->query($sql);

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
                                    <td><button type="submit" class="btn-xs btn-primary">Reply</button> </td>
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
    <!-- <script type="text/javascript" src="DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script type="text/javascript" src="DataTables-1.10.22/js/jquery.dataTables.js"></script>
   <script type="text/javascript" src="DataTables/datatables.min.js"></script>  -->

    <!-- <script>
            $(document).ready(function() {
            $('#example').DataTable();
        } );
  </script> -->
</body>

</html>