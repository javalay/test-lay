<?php 
    include_once '../../config.php';
    include_once '../../functions.php';
    $id=$_POST['id'];
    $connect=connect();
    $sql="DELETE FROM categories WHERE id='{$id}';";
    $postArr=mysqli_query($connect,$sql);
    $ponse=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $ponse['code']=1;
        $ponse['msg']='操作成功';
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($ponse);
?>