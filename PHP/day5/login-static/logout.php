<?php 
//删除cookie值一定要关注cookie是如何添加 ,怎么添加的就怎么删除，
// setcookie("isLogin","");
    session_start();
    unset($_SESSION['user']);
    header("Location:./login.php");
?>