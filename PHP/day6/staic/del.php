<?php 
    include 'common.php';
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $sql="delete from userInfo where id='$id'";
        $res=opt($sql);
        if($res){
        header("Location:static.php");
        }
    }
?>