<?php
    /*CORS允许跨域访问*/
    header('Access-Control-Allow-Origin: *');
    /*返回json格式数据*/
    header('Content-Type:application/json;charset=utf-8');

    /* 
    连接数据库: 此处用户名,与密码要与之前设置的对应
    当前用户名: root
    当前密码: root
    */
    $con = mysql_connect("localhost","root","");

    if (!$con){
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("test", $con);

    $pageNum = $_GET['pageNum'];
    $pageSize = $_GET['pageSize'];

    $start=($pageNum-1)*$pageSize;

    $sql="select *,(select count(*) from teacher) as total from teacher order by id desc limit $start , $pageSize ";

    $result = mysql_query($sql);

    $list = array();
    $total = 0;

    while($row = mysql_fetch_array($result)){
        $item = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'password' => $row['password'],
        'name' => $row['name'],
        'school' => $row['school'],
        'age' => intval($row['age']),
        );
        array_push($list,$item);
        $total = $row['total'];
    }

    echo json_encode(
    array(
    'list'=>$list,
    'pageSize'=>intval($pageSize),
    'pageNum'=>intval($pageNum),
    'total'=> intval($total)
    )
    );
    mysql_close($con);

    // sleep(1);
?>