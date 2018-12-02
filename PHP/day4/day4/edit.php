<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<div class="container">
		<h1 class=" display-3 py-3">编辑</h1>
		<hr>
		<!-- 表单结构： -->
		<form>
			<div class="form-group">
				<label for="title">标题</label>
				<input type="text" class="form-control" id="title" name="title">
				<small class="invalid-feedback">这是一个标题</small>
			</div>
			<div class="form-group">
				<label for="geshou">歌手</label>
				<input type="text" class="form-control" id="geshou" name="geshou">
				<small class="invalid-feedback">歌手的名称</small>
			</div>
			<div class="form-group">
				<label for="zhuanji">专辑</label>
				<input type="text" class="form-control" id="zhuanji" name="zhuanji">
				<small class="invalid-feedback">专辑名称</small>
			</div>
			<div class="form-group">
				<label for="source">资源文件</label>
				<!-- accept 用于设置可以接受的文件类型，可以使用MIMEtype,也可以使用后缀名，使用逗号连接 -->
				<input type="file" class="form-control" id="source" name="source" accept=".mp3">
				<small class="invalid-feedback">文件上传</small>
			</div>
			<button class="btn btn-primary btn-block">保存</button>
		</form>
	</div>
</body>
</html>