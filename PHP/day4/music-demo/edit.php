<?php
	function edit(){
		// 数据的验证：当用户数据输入不正确的时候，需要给出相应的提示：我们不是当发现数据有问题的时候直接给出相应的处理，
		// 而是为这个数据添加一个错误标记，之后统一的处理(修改页面的结构，添加样式)
		// 判断有没有传递过来相应的值   判断这个值是否是空字符串
		if(!isset($_POST["title"]) || trim($_POST["title"]) === ""){
			$errorArr[] = "title";
		}
		if(!isset($_POST["geshou"]) || trim($_POST["geshou"]) === ""){
			$errorArr[] = "geshou";
		}
		if(!isset($_POST["zhuanji"]) || trim($_POST["zhuanji"]) === ""){
			$errorArr[] = "zhuanji";
		} 
		// 对于文件的判断
		// 因为我们做的是修改操作：修改操作不能强迫用户去修改所有的数据，如果用户如果没有输入值，说明他想使用之前的数据
		// 1.如果用户没有选择文件，说明不想修改这个文件的值，那么也不应该给出相应的错误提示
		// 2.如果用户传递的文件，但是上传失败了，才需要给出相应的提示
		// 判断有没有上传东西	上传是否失败，0代表成功，其它的代表失败

		// 关于文件上传的细节说明：就算用户没有选择文件，系统也会进行一个提交操作(前提：为表单设置了enctype=multipart/form-data),，
		// 只不过服务器接收不到任何有关文件的数据，所以给你的错误信息提示为4(没有文件被上传)
		// var_dump(!isset($_FILES["source"]["name"]); //永远是false
		// if(!isset($_FILES["source"]["name"]) && $_FILES["source"]["error"] != 0){
			// 有文件名的存在                         并且发生了错误
		if(!empty($_FILES["sour  ce"]["name"]) && $_FILES["source"]["error"] != 0){
			$errorArr[] = "source";
		}
		// 统一的判断用户数据是否输入不正确
		// 如果在php结构中使用if直接添加return语句，那么当运行这return语句的时候，整个php文件的执行就会中止。
		// 这种情况下，如果需要继续执行后面的代码，可以使用函数调用的方式来实现 
		if(isset($errorArr) && count($errorArr) !=0){
			$GLOBALS["errorArr"] = $errorArr;
			// 方法中的return,只会中止当前方法的执行，而会继续执行方法调用后的代码
			return;
		}
		// 数据正确的时候，实现编辑操作 
		// 1.实现文件的上传:只有用户真正的上传了文件，同时上传成功，那么才需要将文件从临时目录移到到永久目录
		if(isset($_FILES["source"]["name"]) && $_FILES["source"]["error"] == 0){
			move_uploaded_file($_FILES["source"]["tmp_name"],"./mp3/".$_FILES["source"]["name"]);
		}
		// 2.实现数据的修改
		$id = $_POST["id"];
		// 2.1获取数据：$_POST
		// 2.2读取文件，转换为我们所需要的数组
		$dataStr = file_get_contents("music.json");
		$dataArr = json_decode($dataStr,true);
		// 2.3遍历数组，查找到对应id号的数据
		// 遍历的细节：使用foreach进行遍历，那么$value本质是是数据的副本，所以对副本进行数据的修改，
		// 原始数据压根不会改变
		foreach($dataArr as $key => $value){
			if($value["id"] == $id){ //说明找到了
				// 2.4.实现修改操作
				$dataArr[$key]["title"] = $_POST["title"];
				$dataArr[$key]["singer"] = $_POST["geshou"];
				$dataArr[$key]["album"] = $_POST["zhuanji"];
				// 资源路径的修改：什么时候才需要修改：当用户上传了文件，同时上传成功，否则不需要进行处理
				if(isset($_FILES["source"]["name"]) && $_FILES["source"]["error"] == 0){
					$dataArr[$key]["src"] = "./mp3/".$_FILES["source"]["name"];
				}
			}
			break;
		} 
		// 2.5.将修改后的数据重新写入到文件
		file_put_contents("music.json",json_encode($dataArr));
		// 2.6实现页面的跳转
		echo '<script>location.href="list.php";</script>';
	}
	// 如果是get请求：我们需要接收用户传递的id号，根据id号查找到对应的数据，将数据的详细信息在表单元素中展示
	if(!empty($_GET)){
		// 1.接收id号 ---判断是否有这个id号
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			// // 2.根据id号获取对应id号的数据
			// // 2.1 读取文件
			// $dataStr = file_get_contents("music.json");
			// // 2.2 将文件转换为数组
			// $dataArr = json_decode($dataStr,true);
			// // 2.3 遍历数组，查找到对应id号的数据
			// foreach($dataArr as $key => $value){ 
			// 	if($value["id"] == $id){
			// 		// 2.4 说明查找到了对应id号的数据 $value，就将这个数据存储到一个变量中，方便后期的使用修改
			// 		$current = $value;
			// 		break;
			// 	}
			// }
			$current= getCurrentData($id);
			// print_r $current;
		}
		// edit(); 
	}
	// 如果是post请求：收集数据，实现数据的修改操作 1.实现文件的上传(如果用户重新选择了文件) 2.实现对应id号数据的修改操作
	else if(!empty($_POST)){
		if(isset($_POST["id"])){
			$id = $_POST["id"];
			// // 2.根据id号获取对应id号的数据
			// // 2.1 读取文件
			// $dataStr = file_get_contents("music.json");
			// // 2.2 将文件转换为数组
			// $dataArr = json_decode($dataStr,true);
			// // 2.3 遍历数组，查找到对应id号的数据
			// foreach($dataArr as $key => $value){
			// 	if($value["id"] == $id){
			// 		// 2.4 说明查找到了对应id号的数据，就将这个数据存储到一个变量中，方便后期的使用
			// 		$current = $value;
			// 		break;
			// 	}
			// }
			$current=getCurrentData($id);
		}
		edit();
	}
	function getCurrentData($id){
		// 2.根据id号获取对应id号的数据
			// 2.1 读取文件
			$dataStr = file_get_contents("music.json");
			// 2.2 将文件转换为数组
			$dataArr = json_decode($dataStr,true);
			// 2.3 遍历数组，查找到对应id号的数据
			foreach($dataArr as $key => $value){
				if($value["id"] == $id){
					// 2.4 说明查找到了对应id号的数据，就将这个数据存储到一个变量中，方便后期的使用
					$current = $value;
					break;
				}
			}
			// print_r($current);
			return $current;
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
		<!-- 为了else if 中post请求时 获取当前一个id值 这是 之前get请求时获取的id-->
			<input type="hidden" name="id" value="<?php echo $current["id"] ?>">
			<div class="form-group">
				<label for="title">标题</label>
				<input type="text" class="form-control" id="title" name="title" value="<?php echo $current["title"] ?>">
				<small class="invalid-feedback <?php echo in_array("title",$GLOBALS["errorArr"])?'showInfo':''?>">这是一个标题</small>
			</div>
			<div class="form-group">
				<label for="geshou">歌手</label>
				<input type="text" class="form-control" id="geshou" name="geshou" value="<?php echo $current["singer"] ?>">
				<small class="invalid-feedback <?php echo in_array("geshou",$GLOBALS["errorArr"])?'showInfo':''?>">歌手的名称</small>
			</div>
			<div class="form-group">
				<label for="zhuanji">专辑</label>
				<input type="text" class="form-control" id="zhuanji" name="zhuanji" value="<?php echo $current["album"] ?>">
				<small class="invalid-feedback <?php echo in_array("zhuanji",$GLOBALS["errorArr"])?'showInfo':''?>">专辑名称</small>
			</div>
			<div class="form-group">
				<label for="source">资源文件</label>
				<!-- accept 用于设置可以接受的文件类型，可以使用MIMEtype,也可以使用后缀名，使用逗号连接 -->
				<input type="file" class="form-control" id="source" name="source" accept=".mp3">
				<small class="invalid-feedback <?php echo in_array("source",$GLOBALS["errorArr"])?'showInfo':''?>">文件上传</small>
			</div>
			<button class="btn btn-primary btn-block">保存</button>
		</form>
	</div>
</body>
</html>