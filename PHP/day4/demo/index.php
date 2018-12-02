<?php 
//获取文件中的json数据
    $str=file_get_contents("index.json");
    //把数组转换为json格式字符串
    $arr=json_decode($str,true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>
<body>
		<h1 class="text-center display-3 py-3">个人信息</h1>
<table class="table table-bordered">
			<thead class="thead-inverse">
				<tr>
					<th>用户名</th>
					<th>密码</th>
					<th>年龄</th>
					<th>性别</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($arr as $key => $value){ ?>
						<tr>
							<td><?php echo $value["用户名"] ?></td>
							<td><?php echo $value["密码"] ?></td>
							<td><?php echo $value["年龄"] ?></td>
                            <td><?php 
                            if($value["性别"]==1){
                                echo "男";
                            }
                            else{
                                echo "女";
                            }
                             ?></td>
						</tr>
					<?php }
				?>
			</tbody>
		</table>
</body>
</html>