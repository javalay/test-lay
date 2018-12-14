<?php 
    require_once '../config.php';
    require_once '../functions.php';
    //获取从页面通过Ajax传过来的参数
    $categoryId=$_POST["categoryId"];
    $currentPage=$_POST['currentPage'];
    $pageSize=$_POST['pageSize'];
    $offset=($currentPage-1)*$pageSize;
    $conent=connect();
    $sql="select p.id, p.title,p.content,p.created,p.views,p.likes,p.feature,c.`name`,u.nickname,
    (select count(*) from comments where post_id = p.id ) as commentsCount
    from posts p
    left join categories c on c.id = p.category_id
    left join users u on u.id = p.user_id
    where p.category_id = $categoryId
    order by p.created DESC
    LIMIT $offset, $pageSize;";
    $postArr=query($conent,$sql);
    // echo $postArr;
    //需要获取到当前分类下的文章的总条数
    $sqlCount="select count(*) postCount from posts where category_id = $categoryId";
    $counrArr=query($conent,$sqlCount);
    $totalCount=$counrArr[0]['postCount'];
    $response=['code'=>0,'msg'=>'操作失败'];
    if($postArr){
        $response["code"]="1";
        $response["msg"]="操作失 败";
        $response["data"]=$postArr;
        $response["totalCount"]=$totalCount;
    };
    header("content-type: application/json; charset=utf-8");
    echo json_encode($response);

?> 