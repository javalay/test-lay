<?php 
	$marr=file_get_contents("music.json");
	// print_r($marr);
	$Marr=json_decode($marr,true);
	// print_r($Marr) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>音乐列表</title>
	<link rel="stylesheet" href="bootstrap.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center display-3 py-3">音乐列表</h1>
		<hr>
		<a href="./upload.php" class="btn btn-dark">新增歌曲信息</a>
		<table class="table table-bordered">
			<thead class="thead-inverse">
				<tr>
					<th>标题</th>
					<th>歌手</th>
					<th>专辑</th>
					<th>音乐</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach($Marr as $key => $value) { ?>
				<tr>
					<td><?php echo $value["title"] ?></td>
					<td><?php echo $value["singer"] ?></td>
					<td><?php echo $value["album"] ?></td>
					<!-- controls 音频的控制面板 -->
					<td><audio src="<?php echo  $value["src"] ?>" controls></audio></td>
					<td>
						<a href="edit.php ?id= <?php echo $value["id"] ?>" class="btn btn-primary">编辑</a>
						<a href="del.php ?id= <?php echo $value["id"] ?>" class="btn btn-danger">删除</a> 
					</td>
				</tr>
			<?php
				}
			?>
			</tbody>
		</table>
	</div>
</body>
</html>