<?php 
   include_once "../../config.php";
   include_once "../../functions.php";
   $connect=connect();
   $sql="SELECT p.id,p.title,p.created,p.`status`,u.nickname,c.`name` FROM posts p
   LEFT JOIN users u ON u.id=p.user_id
   LEFT JOIN categories c ON c.id=p.category_id";
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