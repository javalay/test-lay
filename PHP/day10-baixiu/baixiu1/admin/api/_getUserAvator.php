<?php 
    require_once "../../config.php";
    require_once "../../functions.php";
    session_start();
    $user_id=$_SESSION['user_id'];
    $connect=connect();
    $sql="SELECT * FROM users u WHERE id={$user_id}";
    $postArr=query($connect,$sql);
    // print_r($postArr);
    $respnse=['code'=>0,'msg'=>"操作失败"];
    if($postArr){
        $respnse['code']=1;
        $respnse['msg']="操作成功";
        $respnse['avatar']=$postArr[0]['avatar'];
        $respnse['nickname']=$postArr[0]['nickname'];
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($respnse);
?>