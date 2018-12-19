<?php 
/**
 * 连接数据库的封装
 */
function connect(){
	$connect = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
	return $connect;
}

/**
 * 执行查询获取数据的封装
 */
function query($connect, $sql){
	$result = mysqli_query($connect, $sql);
	return fetch($result);
}

/**
 * 转换结果集为二维数组的封装
 */
function fetch($result){
	$arr = [];
	while($row = mysqli_fetch_assoc($result)){
		$arr[] = $row;
	}
	return $arr;
}
    //登录页验证封装
    function checkLogin(){
        session_start();
        if(!isset($_SESSION['isLogin'])||$_SESSION['isLogin']!=1){
            header("Location:login.php");
        }
	}
	
/**
 * 封装插入数据的代码
 */
function insert($connect, $table, $arr){
	$keys = array_keys($arr);
	$values = array_values($arr);
	$sqlAdd = "insert into {$table} (" . implode(',', $keys) .") values ('" . implode("','", $values) . "')";

	//执行新增的操作语句
	$addResult = mysqli_query($connect, $sqlAdd);
	return $addResult;
}
?>