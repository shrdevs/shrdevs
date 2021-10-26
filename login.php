<?php
include_once 'connection.php';

$msg="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script>
        history.forward(1);
    </script>
</head>
<body>
    
    <div class="login-box">
    <img src = "fsib.jpg" height = "90px" width="280px">
        <h3>AML & CFTD Query Management System</h3>
        
      <form action="loginapi.php" method="post">
      <div class="textbox">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input placeholder="UserName" type="text" name="username" id="">
        </div>
        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input placeholder="Password" type="password" name="password" id="">
        </div>
        <input class="btn" type="submit" name="signin" value="log In">
      </form>
    </div>
    <div>
        <h4 name = msg> <?php echo $msg; ?> </h4>
    </div>
    
</body>
</script>
</html>












