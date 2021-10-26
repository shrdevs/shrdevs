<?php
session_start();
include_once 'connection.php';
if ($_REQUEST["auth"] == "del") {

    $sql = "DELETE FROM fsib_notice WHERE notice_refno='".$_REQUEST["noticeNo"]."'";
    
    $exe_sql = $con->query($sql);


}