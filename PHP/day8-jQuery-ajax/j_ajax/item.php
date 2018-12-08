<?php 
header("Content-Type:text/html;charset=utf-8");
$conn = mysqli_connect("localhost","root","","mybase");
mysqli_set_charset($conn,"utf8");
if(!$conn){
    // echo '连接失败aaa';
    // return;
    die("连接失败aaa");
    // exit()
}
$sql = "select zan from sqlzan where id = '1'";
$result = mysqli_query($conn,$sql);
$resultt= mysqli_fetch_array($result);
print_r($resultt["zan"]);
?>