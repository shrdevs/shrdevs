<?php
session_start();
if(!$_SESSION["username"])  
{  

    header("Location: login.php");//redirect to the login page to secure the welcome page without login access.  
}  
else{
    include_once 'connection.php';

    //query incomplete, NEED join query reply and notice table
    //$sql = "select * from fsb_notice_rep where fsib_branch_code='".$_SESSION['branch_code']."' AND (length(`fsib_checker`) = 0 or length(`status`) = 0)";
    $sql = "select fsib_notice.notice_refno,fsib_notice.fsib_description,fsib_reply_path,fsib_reply_path_1,fsib_reply_path_2,fsib_reply_path_3 ,fsib_notice_from,fsib_notice_sub,fsib_lst_sub_dt from fsb_notice_rep inner join fsib_notice on fsib_notice.notice_refno = fsb_notice_rep.notice_refno where fsib_branch_code='".$_SESSION['branch_code']."' AND (length(`fsib_checker`) = 0 or length(`status`) = 0)";
    // query execution comment for incomplete query above.
    $exec_sql = $con->query($sql);
    if ($exec_sql->num_rows > 0) {
    while ($row = $exec_sql->fetch_assoc()) {
        echo "<table border ='1px'><tr><td>";
        if(!empty($row['fsib_reply_path']) && empty($row['fsib_reply_path_1']) && empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
        ?>
        <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'><?php echo $row['fsib_reply_path'];?> </a><br>
        <?php
        }
        if(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
        ?>
        <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'><?php echo $row['fsib_reply_path'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'><?php echo $row['fsib_reply_path_1'];?> </a><br>
        <?php
        }
        if(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && !empty($row['fsib_reply_path_2']) && empty($row['fsib_reply_path_3'])){
        ?>
        <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'><?php echo $row['fsib_reply_path'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'><?php echo $row['fsib_reply_path_1'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_2'];?>'><?php echo $row['fsib_reply_path_2'];?> </a><br>
        <?php
        }
        if(!empty($row['fsib_reply_path']) && !empty($row['fsib_reply_path_1']) && !empty($row['fsib_reply_path_2']) && !empty($row['fsib_reply_path_3'])){
        ?>
        <a href='replyNotice/<?php echo $row['fsib_reply_path'];?>'><?php echo $row['fsib_reply_path'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_1'];?>'><?php echo $row['fsib_reply_path_1'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_2'];?>'><?php echo $row['fsib_reply_path_2'];?> </a><br>
        <a href='replyNotice/<?php echo $row['fsib_reply_path_3'];?>'><?php echo $row['fsib_reply_path_3'];?> </a><br>
        <?php
        }
        
        echo "</td>";
        ?>
        <td><?php echo $row["notice_refno"]; ?></td>
        </tr></table>
        <?php
    }
    }
    else{
        echo "No Data Found";
    }
    
}


?>
