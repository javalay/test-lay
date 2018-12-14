<?php 
// 链接数据库的函数
    function connect(){
        $connect=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
        return $connect;
    }
    //执行查询的封装
    function query($connect,$sql){
        $result=mysqli_query($connect,$sql);
        // return $result;
        return fetch($result);
    }
    //转换结果集为二维数组 
    function fetch($result){
        $arr=[];
        while($row=mysqli_fetch_assoc($result)){ 
            $arr[]=$row;
        }
        return $arr;
    }
    //登录页验证封装
    function checkLogin(){
        session_start();
        if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!=1){
            header("Location:login.php");
        }
    }
?>