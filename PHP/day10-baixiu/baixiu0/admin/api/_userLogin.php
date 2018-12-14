<?php 
    $email=$_POST['email'];
    $password=$_POST['password'];
    require_once "../../config.php";
    //需要先载入config.php，再载入functions.php，因为后者依赖前者
    require_once '../../functions.php';
    $connect = connect();
    $sql="select * from users where email = '{$email}' and `password` = '$password' and `status` = 'activated';";
    $queryResult = query($connect, $sql);
    // print_r($queryResult);
    //操作成功后把下面这些值添加到二维数组中
    $response=['code'=>0,'msg'=>'操作失败'];
    // $queryResult 这里面传过来的有值说明验证成功了，就做下面的操作
    if($queryResult){
        //把登录成功记录存在_SESSION 中
        session_start();
        $_SESSION['isLogin']=1;
        $_SESSION['user_id']=$queryResult[0]['id'];

        $response['code']="1";
        $response['msg']='登录成功'; 
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($response);
?>  