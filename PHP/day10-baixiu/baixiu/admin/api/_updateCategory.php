<?php 
	require_once '../../config.php';	
	require_once '../../functions.php';
	/*
		根据 id 更新分类的数据
	 */	

	// 1 首先获取 id 和一些要修改的数据
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$classname = $_POST['classname'];
	$id = $_POST['id'];

	// 2 完成 修改数据库的工作
	$connect = connect();
	$sql = "update categories set ";
	unset($_POST['id']);
	foreach($_POST  as $key => $value){
		$sql .= " $key='{$value}',";
	}
	// 循环导致sql语句末尾多一个逗号，先把逗号去掉
	$sql = substr($sql, 0, -1);	//
	$sql .= " where id = '{$id}'";
	$result = mysqli_query($connect, $sql);

	$response = ["code"=>0, "msg"=>"操作失败"];
	// 判断是否执行成功，如果成功，修改响应的返回信息
	if( $result ){
		$response['code'] = 1;
		$response['msg'] = "更新成功";
	}
	//以 json 方式将结果返回给前端
	header("content-type:application/json; charset=utf-8");
	echo json_encode($response);

?>
