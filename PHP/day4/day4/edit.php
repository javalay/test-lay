<?php 
	function edic(){
		if(!isset($_POST["title"])|| trim($_POST["title"])===""){
			$errArr[]="title";
		}
		if(!isset($_POST["geshou"])|| trim($_POST["geshou"])===""){
			$errArr[]="geshou";
		}
		if(!isset($_POST["zhuanji"])|| trim($_POST["zhuanji"])===""){
			$errArr[]="zhuanji";
		}
					// 有文件名的存在                         并且发生了错误
		if(!empty($_FILES["source"]["name"]) && $_FILES["source"]["error"] !=0){
			$errArr[]="source";
		}
		if(isset($errArr)&&count($errArr) !=0){
			$GLOBALS["errArr"]=$errArr;
			print_r($GLOBALS["errArr"]);
			return;
		}
		// 把真正要上传的文件存入相对应的文件夹中
		if(isset($_FILES["source"]["name"]) && $_FILES["source"]["error"]==0){
			move_uploaded_file($_FILES["source"]["tmp_name"],"./mp3/".$_FILES["source"]["name"]);
		}
		//记录当前要修改的id值
		$id=$_POST["id"];
		$dataStr=file_get_contents("music.json");
		$dataArr=json_decode($dataStr,true);
		foreach($dataArr as $key => $value){
			if($value["id"]==$id){
				$dataArr[$key]["title"]=$_POST["title"];
				$dataArr[$key]["singer"]=$_POST["geshou"];
				$dataArr[$key]["album"]=$_POST["zhuanji"];
				if(isset($_FILES["source"]["name"])&&$_FILES["source"]["error"]==0){
					$dataArr[$key]["src"]="./mp3/".$_FILES["source"]["name"];
				}
			}
			break;
		}
		file_put_contents("music.json", json_encode($dataArr));
		echo '<script>location.href="list.php";</script>';
	}
//判断是否用的是get 获取有get 事件的获取
	if(!empty($_GET)){
		if(isset($_GET["id"])){
			$id=$_GET["id"];
			$curren=getCurrentData($id);
		}
		// edic();	
	}
	// 判断是否是POST 事件获取方式
	else if(!empty($_POST)){
		if(isset($_POST["id"])){
			$id=$_POST["id"];
			$curren=getCurrentData($id);
		}
		edic();
	}
	function getCurrentData($id){
		$mu=file_get_contents("music.json");
		$mmu=json_decode($mu,true);
		foreach($mmu as $key => $value){
			if($value["id"]==$id){
				$curren=$value;
				break;
			}
		}
		// print_r($curren);
		return $curren;
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
		<h1 class=" display-3 py-3">编辑</h1>
		<hr>
		<!-- 表单结构： -->
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $curren["id"] ?>">
			<div class="form-group">
				<label for="title">标题</label>
				<input type="text" class="form-control " id="title" name="title" value="<?php echo $curren["title"] ?>">
				<small class="invalid-feedback <?php echo in_array("title",$GLOBALS["errArr"])?"showInfo":"" ?>">这是一个标题</small>
			</div>
			<div class="form-group">
				<label for="geshou">歌手</label>
				<input type="text" class="form-control" id="geshou" name="geshou" value="<?php echo $curren["singer"] ?>">
				<small class="invalid-feedback <?php echo in_array("geshou",$GLOBALS["errArr"])?"showInfo":"" ?>">歌手的名称</small>
			</div>
			<div class="form-group">
				<label for="zhuanji">专辑</label>
				<input type="text" class="form-control" id="zhuanji" name="zhuanji" value="<?php echo $curren["album"] ?>">
				<small class="invalid-feedback <?php echo in_array("zhuanji",$GLOBALS["errArr"])?"showInfo":"" ?>">专辑名称</small>
			</div>
			<div class="form-group">
				<label for="source">资源文件</label>
				<!-- accept 用于设置可以接受的文件类型，可以使用MIMEtype,也可以使用后缀名，使用逗号连接 -->
				<input type="file" class="form-control" id="source" name="source" accept=".mp3">
				<small class="invalid-feedback <?php echo in_array("source",$GLOBALS["errArr"])?"showInfo":"" ?>">文件上传</small>
			</div>
			<button class="btn btn-primary btn-block">保存</button>
		</form>
	</div>
</body>
</html>