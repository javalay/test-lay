<?php 
	require_once '../../config.php';	
	require_once '../../functions.php';
	/*
		获取文章数据，返回给前端
	 */
	// 从前端获取两个数据： 当前是第几页 一共要获取多少条
	$currentPage = $_POST['currentPage'];
	$pageSize = $_POST['pageSize'] ;
	//还要获取筛选的条件
	$status = $_POST['status'] ;
	$categoryId = $_POST['categoryId'];
	//只有当有条件的时候，我们再来把条件拼接到where的后面
	$where = " where 1=1 ";
	if($status != "all"){
		$where .= " and p.`status` = '{$status}' ";
	}
	if($categoryId != "all"){
		$where .= " and p.`category_id` = '{$categoryId}' ";
	}

	//计算出sql语句从哪里开始获取数据
	//从哪里开始获取 = (要获取的页码数 - 1) * 每页获取的数据的条数
	$offset = ($currentPage - 1) * $pageSize;

	//开始连库并完成查询：
	$connect = connect();
	// sql 语句
	$sql = "select p.id, p.title, p.created, p.`status`, u.nickname, c.`name` from posts p
	left JOIN users u on u.id = p.user_id
	LEFT JOIN categories c on c.id = p.category_id" . $where . " limit {$offset}, {$pageSize}";
	// 执行查询 
	$result = query($connect, $sql);
	//查询到了数据之后，再来获取最大的页码数
	$countSql = "select count(*) as count from posts";
	//执行总数的查询
	$countArr = query($connect, $countSql);
	$postCount = $countArr[0]['count'];
	// 计算页码的最大值 = ceil( 文章总数 / 每页的数据条数 );
	$pageCount = ceil($postCount / $pageSize);

	// 把查询的结果返回前端
	$response = ["code"=>0, "msg"=>"操作失败"];
	if( $result !== false ){
		$response['code'] = 1;
		$response['msg'] = "操作成功";
		$response['data'] = $result;
		$response['pageCount'] = $pageCount;
	}
	$response['sql'] = $sql;
	//以 json 方式将结果返回给前端
	header("content-type:application/json; charset=utf-8");
	echo json_encode($response);

?>