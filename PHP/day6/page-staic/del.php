<?php
    include './common.php';

    // 获取参数:但是要先做一个判断，判断用户是否传递的id这个参数
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        // 生成sql语句
        $sql = "delete from userInfo where id = '$id'";
        // 调用函数执行操作，接收返回值
        $res = opt($sql);
        // 实现页面的刷新
        if($res){
            header("Location:./static.php");
        }
    }
?>