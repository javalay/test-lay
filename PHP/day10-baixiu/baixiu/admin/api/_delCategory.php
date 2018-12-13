<?php 
	require_once '../../config.php';	
	require_once '../../functions.php';
	/*
		删除对应的id的分类数据
	 */
	// 1 首先获取 id 
	$id = $_POST['id'];

	// 2 完成 删除的工作
	$connect = connect();
	$sql = "delete from categories where id = '{$id}'";
	$result = mysqli_query($connect, $sql);

	$response = ["code"=>0, "msg"=>"操作失败"];
	// 判断是否执行成功，如果成功，修改响应的返回信息
	if( $result ){
		$response['code'] = 1;
		$response['msg'] = "删除成功";
	}
	//以 json 方式将结果返回给前端
	header("content-type:application/json; charset=utf-8");
	echo json_encode($response);

?>