<?php 
    include_once "../../config.php";
    include_once "../../functions.php";
    $connect=connect();
    $sql="select * from categories";
    $postArr=query($connect,$sql);
    $response=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $response['code']=1;
        $response['msg']="操作成功";
        $response['data']=$postArr;
    }
	header("content-type:application/json; charset=utf-8");
    echo json_encode($response);
?>