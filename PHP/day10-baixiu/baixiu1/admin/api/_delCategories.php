<?php 
//获取封装好的函数，直接调用，要注意路径问题
    include_once "../../config.php";
    include_once "../../functions.php";
//获取从前端利用post发过来的数据 id的数组
    $dels=$_POST['dels'];
    $connect=connect();
    //id 拼接 每个id要用单引号包裹开 用逗号分隔开
    $sql="DELETE FROM categories WHERE id in('" . implode("','" , $dels) ."')";
    // echo $sql;
    $postArr=mysqli_query($connect,$sql);
    $ponse=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $ponse['code']=1;
        $ponse['msg']='操作成功';
    }
    header('content-typea:application/json; charset:utf-8');
    echo json_encode($ponse);

?>