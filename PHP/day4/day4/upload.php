<?php 
//通过函数来实现所有的操作
function addSong(){
// 验证用户数据
// $_POST["title"] 表单元素通过post提交的数据
// 1判断数据是否有输入                2判断有输入但是输入的是否是一个空格字符串
	if(!isset($_POST["title"]) || trim($_POST["title"])===""){
		$errorArr[]="title";
	}
	if(!isset($_POST["geshou"]) || trim($_POST["geshou"])===""){
		$errorArr[]="geshou";
	}
	if(!isset($_POST["zhuanji"]) || trim($_POST["zhuanji"])===""){
		$errorArr[]="zhuanji";
	}
	if(!isset($_FILES["source"]) || $_FILES["source"]["error"]!=0){
		$errorArr[]="source";
	}
	// print_r($_FILES["source"]);
	if(isset($errorArr)){
		$GLOBALS["err_arr"]=$errorArr;
		return;
	};
	// 实现用户数据的新增加
	//先把获取到文件 上传移动到指定位置
	move_uploaded_file($_FILES["source"]["tmp_name"],"./mp3/".$_FILES["source"]["name"]);
	$data=file_get_contents("music.json");
	$dataArr=json_decode($data,true);
	$newArr=array(
		// 判断$dataArr 数组长度是否等于0 等于0 说明要添加的数据id就是第一个  
		// 否则就是$dataArr 数组长度-1就是数组最后的位置的id 在此基础上然后再加1 就可以实现追加操作
		"id"=>count($dataArr)==0?1:$dataArr[count($dataArr)-1]["id"]+1,
		//把下面所有通过post请求的数据添加到新建数组里面
		"title" => $_POST["title"],
		"singer"=> $_POST["geshou"],
		"album"=> $_POST["zhuanji"],
		// . 后加文件名
		"src"=>"mp3".$_FILES["source"]["name"]
	);
	// 实现写入操作。将新增的数据添加到歌曲列表数组中，再将歌曲列表数组写入到文件中
	$dataArr[] = $newArr;
	//把之前获取到准备添加的数据 使用file_put_contents方法写入数据，
	file_put_contents("music.json",json_encode($dataArr));
	echo '<script>location.href="list.php";</script>';
}
//判断是个提交post请求
	if(!empty($_POST)){
		addSong();
	}
	// 为了避免没有发送post请求时的页面错误。那么 我们需要为数组设置默认值
	else{
		$GLOBALS["err_arr"] = [];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="bootstrap.css">
	<style>
		.showInfo{
			display:block;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1 class=" display-3 py-3">音乐上传</h1>
		<hr>
		<!-- 表单结构： -->
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" >
			<div class="form-group">
				<label for="title">标题</label>
				<!-- 下面的所有 is-invalid 均为要判断的类名 -->
				<input type="text" class="form-control" id="title" name="title">
				<!-- in_array("title",$errorArr):判断当前$errorArr有没有title这个值，如果有返回true -->
				<!-- <small class="invalid-feedback showInfo">这是一个标题</small> -->
				<small class="invalid-feedback <?php echo in_array("title",$GLOBALS["err_arr"])?'showInfo':"" ?>">这是一个标题</small>
			</div>
			<div class="form-group">
				<label for="geshou">歌手</label>
				<input type="text" class="form-control" id="geshou" name="geshou">
				<small class="invalid-feedback <?php echo in_array("geshou",$GLOBALS["err_arr"])?'showInfo':"" ?>">歌手的名称</small>
			</div>
			<div class="form-group">
				<label for="zhuanji">专辑</label>
				<input type="text" class="form-control" id="zhuanji" name="zhuanji">
				<small class="invalid-feedback <?php echo in_array("zhuanji",$GLOBALS["err_arr"])?'showInfo':"" ?>">专辑名称</small>
			</div>
			<div class="form-group">
				<label for="source">资源文件</label>
				<!-- accept 用于设置可以接受的文件类型，可以使用MIMEtype,也可以使用后缀名，使用逗号连接 -->
				<input type="file" class="form-control>" id="source" name="source" accept=".mp3">
				<small class="invalid-feedback  <?php echo in_array("source",$GLOBALS["err_arr"])?'showInfo':"" ?>">文件上传</small>
			</div>
			<button class="btn btn-primary btn-block">上传</button>
		</form>
	</div>
</body>
</html>