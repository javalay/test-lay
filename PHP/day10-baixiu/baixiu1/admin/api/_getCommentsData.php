<?php 
//应用封装好的文件
    include_once "../../config.php";
    include_once "../../functions.php";
//用post 方式获取前台发过来的数据
    $currentPage=$_POST['currentPage'];
    $pageSize=$_POST['pageSize'];
//利用公式算出最最多能有多少页码
    $offset=($currentPage-1)*$pageSize;
    $connect=connect();
    $sql="select c.id, c.author, c.content, c.created, c.`status`, p.title from comments c
    left join posts p on p.id = c.post_id
    LIMIT {$offset}, {$pageSize}";
    //这是第二个查询语句，查询一个有多少条数据
    $postArr=query($connect,$sql);
    $sqlcount="select count(*) as count from comments";
    $countArr=query($connect,$sqlcount);
    // 取出数据总数
    $count = $countArr[0]['count'];
    $pageCount = ceil($count / $pageSize);
    $response=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $response['code']=1;
        $response['msg']='操作成功';
        $response['data'] = $postArr
        ;
        $response['pageCount']=$pageCount;
    }
    header("content-type:application/json; charset=utf-8");
    echo json_encode($response);
?>