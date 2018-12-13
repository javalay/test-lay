<?php 
	// print_r($_FILES);
	/*
		把上传回来的文件，保存到服务端
	 */
		//获取上传回来的文件
		$file = $_FILES['file'];
		//生成一个不会重复的文件名
		/*
			我们在服务端，为了保证上传的文件不会重名

				时间戳 + 随机数 + 后缀名
		 */
		// 先得到文件的后缀名
		// strrchr(字符串, 符号) 得到的是某个符号最后一次出现在字符串的位置开始到字符串结尾的所有字符
		$ext = strrchr($file['name'], ".");

		$fileName = time() . rand(10000,99999) . $ext;

		//把文件保存到指定目录
		$bool = move_uploaded_file($file["tmp_name"], "../../static/uploads/" . $fileName);

		//如果图片上传成功，返回图片的路径，让前端页面可以预览
		$response = ['code'=>0, 'msg'=>'操作失败'];
		if($bool){
			$response['code'] = 1;
			$response['msg'] = '操作成功';
			//把上传的图片的路径带回前端
			$response['src'] = '/static/uploads/' . $fileName;
		}

		//以json格式返回
		header("content-type: application/json; charset=utf-8");
		echo json_encode($response);
 ?>