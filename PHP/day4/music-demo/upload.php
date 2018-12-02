<?php
	// 通过函数来实现所有的操作
	function addSong(){
		// 验证用户数据
		// 1.判断是否有输入          2.判断有输入但是输入的是否是空格字符串
		if(!isset($_POST["title"]) || trim($_POST["title"]) === ""){
			// echo '请输入歌曲名称';
			// 关于错误信息提示的说明：
			// 之前echo错误信息的方式有重大的缺点：每次只能提示一个错误信息，况且我们还需要对错误信息的结构做相应的设置--不合理也不方便
			// 需求：我们需要一次性的提示用户所有可能的错误操作信息。这个时候我们就需要在判断用户数据的时候，先将这些错误信息存储起来，后期进行一个统一的判断，这个时候我们就可以将这些可能存在的错误存储到数组中。要注意存储的错误信息需要与后期判断时的条件进行对应
			$errorArr[] = "title";
			// ---------------------------------------------------
			// 如果在页面结构中直接添加return语句，那么当执行到这个语句的时候，整个php文件的执行就会结束
			// 如果在方法中添加return语句，那么当执行到这个语句的时候，只会结束当前方法的执行，但是方法的后续代码会继续执行
			// return;
		} 
		if(!isset($_POST["geshou"]) || trim($_POST["geshou"]) === ""){
			$errorArr[] = "geshou";
		}
		if(!isset($_POST["zhuanji"]) || trim($_POST["zhuanji"]) === ""){
			$errorArr[] = "zhuanji";
		}
		// 文件相关信息是存储在$_FILES中
		if(!isset($_FILES["source"]) ||  $_FILES["source"]["error"]!=0){
			$errorArr[] = "source";
		}
		// 处理用户的错误信息:如果之前创建了$errorArr,那么就说明用户的数据是有错误的
		if(isset($errorArr)){
			// 变为超全局变量
			$GLOBALS["err_arr"] = $errorArr;
			return;
		}
		// 实现用户数据的新增
		// 1.实现文件上传
		print_r($_FILES["source"]);
		// move_uploaded_file（源文件的路径，目标文件的路径）
		move_uploaded_file($_FILES["source"]["tmp_name"],"./mp3/".$_FILES["source"]["name"]);
		// 2.将数据写入到json文件中
		$data = file_get_contents("music.json");
		// 所有歌曲列表数组
		$dataArr = json_decode($data,true);
		// 2.1收集用户数据 添加到数组中，先用$_POST[]获取到上传相对性的信息。
		$newSong = array(
			// count获取数组的长度 生成id号：读取文件，将文件转换为数组，再获取数组中的最后一个元素的id号+1
			"id"=>count($dataArr) == 0 ? 1 : $dataArr[count($dataArr)-1]["id"]+1,
			"title"=>$_POST['title'],
			"singer"=>$_POST['geshou'],
			"album"=>$_POST['zhuanji'],
			// 文件名
			"src"=>"./mp3/".$_FILES["source"]["name"]
		);
		// 实现写入操作：将新增的数据添加到歌曲列表数组中，再将歌曲列表数组写入到文件
		$dataArr[] = $newSong;
		// 使用file_put_contents方法写入数据
		// 要注意，我们需要将数组先转换为json格式的字符串
		file_put_contents("music.json",json_encode($dataArr));

		// 实现页面的跳转：虽然在php中无法使用location来实现页面的跳转，但是浏览器端却识别这个操作，所以我们可以将这个操作的代码返回到浏览器，让浏览器来执行这个操作
		echo '<script>location.href="list.php";</script>';
	}
	// 判断用户是否提交post请求
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
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="title">标题</label>
				<!-- 下面的所有 is-invalid 均为要判断的类名 -->
				<input type="text" class="form-control" id="title" name="title">
				<!-- in_array("title",$errorArr):判断当前$errorArr有没有title这个值，如果有返回true  可以覆盖前面的类名-->
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
				<input type="file" class="form-control" id="source" name="source" accept=".mp3">
				<small class="invalid-feedback <?php echo in_array("source",$GLOBALS["err_arr"])?'showInfo':"" ?>">文件上传</small>
			</div>
			<button class="btn btn-primary btn-block">上传</button>
		</form>
	</div>
</body>
</html>