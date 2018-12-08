<?php 
    $conn = mysqli_connect("localhost","root","","mybase");
if(isset($_GET['num'])){
    $num=$_GET["num"];
    $result= $num+1;
    // session_start();
    // $_SESSION["result"]=$result;
    // 封装增加删除和修改操作
    // function opt($sql){
    //     echo $sql;
    //     // 1.连接数据库 成功就返回一个连接对象(资源) 失败就返回false
    //     $conn = mysqli_connect("localhost","root","","mybase");
    //     // 判断连接是否成功
    //     if(!$conn){
    //         die("服务器异常，请重试");
    //     }
    //     // 2.设置编码
    //     mysqli_set_charset($conn,'utf8');
    //     // 3.执行sql语句:成功>true 失败>false
    //     $res = mysqli_query($conn,$sql);
    //     // 关闭连接
    //     mysqli_close($conn);
    //     return $res;
    // }
        $sql = "update sqlzan set zan = '$result' where id = '1'";
        $res = mysqli_query($conn,$sql);
        // $res= opt($sql);
        echo   $result;
      }
else{
    header("Content-Type:text/html;charset=utf-8");
    mysqli_set_charset($conn,"utf8");
    if(!$conn){
        // echo '连接失败aaa';
        // return;
        die("连接失败aaa");
        // exit()
    }
    $sql = "select zan from sqlzan where id = '1'";
    $resultt = mysqli_query($conn,$sql);
    $result= mysqli_fetch_array($resultt);
    echo $result["zan"];
    // print_r($resultt["zan"]);
}
?>