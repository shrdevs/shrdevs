<?php 

include_once 'connection.php';

if(isset($_POST["create_pg"])){

    $pg_code = $_POST["pg_code"];
    $pg_type = $_POST["pg_type"];
    
    
        /*if($user_type=="Checker"){
            $user_name = "bamalco-".$_POST["user_name"];
        }*/
        $sql = "INSERT INTO fsib_package_setup VALUES(null,'".$pg_code."','".$pg_type."')";
        //print_r($sql);
        
        $exe_sql = $con-> query($sql);
        //var_dump($exe_sql);
        //die();
        //var_dump($sql);
        if($exe_sql===TRUE){
            echo '<script> alert("Package  Creation Successfully"); window.location.assign("addPgType.php");</script>';
        }
        else{
            echo '<script> alert("Error in User Creation"); window.location.assign("addPgType.php");</script>';
        }
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
    <title>Add Package</title>
</head>

<body>
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For Super Admin</span></div>
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
            
        </div>
        <div class="col-md-9 content">
            <h2 style="color:#55B1F0;margin-left:200px;">Package Add</h2>
            <hr>
            <br>
            <div class="content-body">
                <form action="#" method="POST">
                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Package Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pg_code" name="pg_code">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputSubject" class="col-sm-2 col-form-label">Package Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pg_type" name="pg_type">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" name="create_pg" class="btn btn-primary" style="margin-left: 10px;">Create Package</button>
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