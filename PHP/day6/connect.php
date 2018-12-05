<?php 
   $conn= mysqli_connect("localhost","root","","test");
    // var_dump($conn);
    // print_r($conn);
    // mysqli_set_charset($conn,"utf8");
    // echo mysql_error($conn);
    if(!$conn){
        die("链接失败aaa");
    }else{
        echo "链接成功";
    }
    // $sql="insert into test values(null,张山,23)";
    // $result=mysqli_query($conn,$sql);
    // // echo mysql_error($conn);
    // if($result){
    //     die("添加成功");
    // }
    // echo "这是链接之后的代码，如果有错误不应该再执行";
    $sql='select *from test';
    $result=mysqli_query($conn,$sql);
  $arr=mysqli_fetch_assoc($result);//关联数组
  $Arr=mysqli_fetch_row($result);
  print_r("关联数组".$arr);
  print_r($Arr);
?>