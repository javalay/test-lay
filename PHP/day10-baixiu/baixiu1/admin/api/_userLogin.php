<?php 
    $email=$_POST['email'];
    $password=$_POST['password'];
    require_once "../../config.php";
    require_once "../../functions.php";
    $connect=connect();
    $sql="select * from users where email = '{$email}' and `password` = '$password' and `status` = 'activated';";
    $query=query($connect,$sql);
    $response=['code'=>0,'msg'=>'操作失败'];
    if($query){
        
        //登录记录 储存在$_SESSION 中 以便后期处理
        session_start();
        $_SESSION['isLogin']=1;
        $_SESSION['user_id']=$query[0]['id'];

        $response['code']=1;
        $response['msg']='操作成功';
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($response);
?>