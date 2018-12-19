<?php 
    require_once "../config.php";
    require_once "../functions.php";
    // http://www.bx1.com/api/_getMorePost.php?currentPage=1&pageSize=5&categoryId=2  这是测试网址，可以更改为get请求
    $categoryId=$_POST['categoryId'];
    $currentPage=$_POST['currentPage'];
    $pageSize=$_POST['pageSize'];
    //还需要计算出从哪条数据开始获取（起始行号，从0开始算起）
    $offset = ($currentPage - 1 ) * $pageSize;
    $connect=connect();
    $sql="select p.id, p.title,p.content,p.created,p.views,p.likes,p.feature,c.`name`,u.nickname,
    (select count(*) from comments where post_id = p.id ) as commentsCount
    from posts p
    left join categories c on c.id = p.category_id
    left join users u on u.id = p.user_id
    where p.category_id = $categoryId
    order by p.created DESC
    LIMIT $offset, $pageSize;";
    $postArr=query($connect,$sql);

    //获取总新闻条数
    $sqlCount="select count(*) postCount from posts where category_id = $categoryId";
    $conArr=query($connect,$sqlCount);
    // print_r($conArr);
    $totalCount=$conArr[0]['postCount'];
    // echo $totalCount;
// 这里是二位数组
    $response=["code"=>0,"msg"=>"操作失败"];
    if($postArr){
        //这里就是一个三维数组。
  
        
        $response["code"]=1;
        $response["msg"]="操作成功";
        $response["data"]=$postArr;
        //把获取的总新闻条数添加到三维数组中
        $response["totalCount"]=$totalCount;
    }
    header("content-type: application/json; charset=utf-8");
    echo json_encode($response);
?>