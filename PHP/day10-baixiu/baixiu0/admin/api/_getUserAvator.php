<?php 
require_once '../../config.php';
require_once '../../functions.php';
    //获取session中的数据
    session_start();
    $user_id= $_SESSION['user_id'];
    $connect=connect();
    $sql="SELECT * FROM users u WHERE id={$user_id}";
    $postArr=query($connect,$sql);
    // print_r($postArr);
    $response=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $response['code']=1;
        $response['msg']='操作成功';
        $response['avatar']=$postArr[0]['avatar'];
        $response['nickname']=$postArr[0]['nickname'];
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($response);
?> 