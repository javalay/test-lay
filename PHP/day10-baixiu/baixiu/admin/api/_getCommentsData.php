<?php 
	require_once '../../config.php';
	require_once '../../functions.php';

	/*
		获取从前端得到的当前是第几页，每页多少条数据，连接数据库获取数据
	*/
		//获取从前端得到的当前是第几页，以及每页多少条数据
		$currentPage = $_POST['currentPage'];
		$pageSize = $_POST['pageSize'];
		// 计算出从哪里开始获取数据
		$offset = ($currentPage - 1) * $pageSize;

		// 连接数据
		$connect = connect();
		// sql语句
		$sql = "select c.id, c.author, c.content, c.created, c.`status`, p.title from comments c
			left join posts p on p.id = c.post_id
			LIMIT {$offset}, {$pageSize}";
		// 执行查询
		$queryResult = query($connect, $sql);
		// 计算最大的页码数
		// 最大的页码数 = ceil(评论的数据总数 / 每页获取的数据条数)
		// 先说评论的数据总数
		$sqlCount = "select count(*) as count from comments";
		$countArr = query($connect, $sqlCount);
		// 取出数据总数
		$count = $countArr[0]['count'];
		$pageCount = ceil($count / $pageSize);
		// 返回数据
		$response = ['code'=>0, 'msg'=>'操作失败'];
		if($queryResult){
			$response['code'] = 1;
			$response['msg'] = "操作成功";
			$response['data'] = $queryResult;
			$response['pageCount'] = $pageCount;
		}
		// 返回json格式
		header("content-type:application/json; charset=utf-8");
		echo json_encode($response);
 ?>