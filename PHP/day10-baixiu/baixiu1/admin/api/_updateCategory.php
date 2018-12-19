<?php 
include_once "../../config.php";
include_once "../../functions.php";

$name=$_POST['name'];
$slug=$_POST['slug'];
$classname=$_POST['classname'];
$id=$_POST['id'];

$connect=connect();
$sql="UPDATE categories SET `name`='{$name}', slug='{$slug}',classname='{$classname}' WHERE id='{$id}';";
$postArr=mysqli_query($connect,$sql);
// print_r($postArr);
$response=['code'=>0,'msg'=>'操作失败'];
if($postArr){
    $response['code']=1;
    $response['msg']='操作成功';
}
header("content-type:application/json; charset=utf-8");
echo json_encode($response);
?> 