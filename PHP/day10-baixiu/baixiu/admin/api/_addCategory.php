<?php 
	require_once '../../config.php';	
	require_once '../../functions.php';
	/*
		完成文章分类的添加操作
	 */	

	// 1 首先获取提交过来的分类相关
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$classname = $_POST['classname'];

	// 2 在讲分类名称添加到数据库之前，还需要判断是否已经存在该名称
	// 		如果已经存在，就不能再添加，返回给前天提示分类名重复
	$connect = connect();
	$countSql = "select count(*) as count from categories where `name` = '{$name}' ";
	$countResult = query($connect, $countSql);
	$count = $countResult[0]['count'];
	$response = ["code"=>0, "msg"=>"操作失败"];
	//如果存在，就提示用户不能添加
	if( $count > 0 ){
		$response["msg"] = "ffff分类名称已经存在，不能重复添加";
	}
	else{
		// 如果不存在，就继续新增的逻辑
		// $keys = array_keys($_POST);
		// $values = array_values($_POST);
		// $sqlAdd = "insert into categories (" . implode(',', $keys) .") values ('" . implode("','", $values) . "')";
		
		// //执行新增的操作语句
		// $addResult = mysqli_query($connect, $sqlAdd);
		
		// 使用封装的添加函数来实现分类的添加功能
		$addResult = insert($connect, "categories", $_POST); 
		
		// 判断添加的结果是否成功，如果成功，告知前端可以动态生成表格结构了
		if( $addResult ){
			$response['code'] = 1;
			$response['msg'] = "操作成功";
		}
	}
	header("content-type:application/json; charset=utf-8");
	echo json_encode($response);

?>
