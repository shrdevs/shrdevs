<?php
session_start();
include_once 'connection.php';
if (isset($_REQUEST["search"])) {

    if ($_REQUEST["noaccount"]) {
        $searchValue = $_REQUEST["searchText"];
        //die();
        if ($searchValue == null) {
            $searchValue = "a";
        }
        echo '<script> window.location.assign("noAccountFound.php?r=' . $searchValue . '");</script>';
    }
    else
    {
        $searchValue = $_REQUEST["searchText"];
        //die();
        if ($searchValue == null) {
            $searchValue = "a";
        }
        echo '<script> window.location.assign("accountFound.php?r=' . $searchValue . '");</script>';
    }


    //$sql = "SELECT notice_refno, fsib_branch_code, branch_name FROM `fsb_notice_rep` left outer join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code where upper(ltrim(rtrim(accountInfo))) = '".strtoupper($searchValue)."'";
    //$exe_sql = $conn->$query($sql);

    //print_r($sql);
    //var_dump($exe_sql);

}

/*if (isset($_REQUEST["search"]) && $_REQUEST["account"]) {
    $searchValue = $_REQUEST["searchText"];
    //die();
    if ($searchValue == null) {
        $searchValue = "a";
    }
    echo '<script> window.location.assign("accountFound.php?r=' . $searchValue . '");</script>';
    //$sql = "SELECT notice_refno, fsib_branch_code, branch_name FROM `fsb_notice_rep` left outer join fsib_branch on fsib_branch.branch_code = fsb_notice_rep.fsib_branch_code where upper(ltrim(rtrim(accountInfo))) = '".strtoupper($searchValue)."'";
    //$exe_sql = $conn->$query($sql);

    //print_r($sql);
    //var_dump($exe_sql);

}*/
