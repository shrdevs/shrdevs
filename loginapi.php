<?php
session_start();
include_once 'connection.php';

if(isset($_POST["signin"])){
    $username = $_POST["username"];
    $password = $_POST["password"];


    //echo $username."<br/>".$password;
    if($username != null && $password !=null){
        $sql = "SELECT * FROM fsib_user WHERE user_name = '".$username."' AND  pass_word = '".$password."'";
        $execute_sql = $con->query($sql);
        if($execute_sql->num_rows>0){
            while($row=$execute_sql->fetch_assoc()){
                $dbUsername = $row["user_name"];
                $dbPassword = $row["pass_word"];
                $branchCode = $row["branch_code"];
                $role = $row["role"];
                $user_type = $row["user_type"];
            }
        }
        
        $_SESSION["username"]=$username;
        $_SESSION["branch_code"] = $branchCode;
        
        if($dbUsername == $username && $dbPassword == $password)
        {
            if($role == "Admin" || $role == "Super Admin"){
                header('Location: http://localhost/amld/dashboard.php');
            }
            else{
                if($user_type == "Checker")
                {
                    header('Location: http://localhost/amld/checker.php');
                }
                else{
                    header('Location: http://localhost/amld/dashboardBranch.php');
                }
                
            } 
            
        }
        else{
            //$msg = "Erro Login credintials";
            echo '<script> alert("Error!!!! Login credintials"); window.location.assign("login.php");</script>';
            
        }
    }
    else{
        //$msg = "Username and Password should not be blank";
        echo '<script> alert("Ooopss!!! Username and Password should not be blank"); window.location.assign("login.php");</script>';
    }
}