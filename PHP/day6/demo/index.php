<?php 
   $conn= mysqli_connect("localhost","root","","test");
   if(!$conn){
	   die("链接失败aaa");
   }else{
	   echo "链接成功";
   }
   //添加数据
//    $sql="insert into test values(null,'huahua',13)";
//添加后执行语句
//    $result=mysqli_query($conn,$sql);
   // echo mysql_error($conn);
//    if($result){
// 	   die("添加成功");
//    }
   $sql='select id,name,age from test';
   $result=mysqli_query($conn,$sql);
//处理执行结果
if($result===false){
	$err=mysqli_error($conn);
	die("执行失败，请参考".$err);
}

//   $arr=mysqli_fetch_assoc($result);
 while($arr=mysqli_fetch_assoc($result)){
	print_r($arr);
	 $res[]=$arr;
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap.css">
    <title>个人信息</title>
</head>
<body>
		<h1 class="text-center display-3 py-3">个人信息</h1>
<table class="table table-bordered">
			<thead class="thead-inverse">
				<tr>
					<th>id</th>
					<th>姓名</th>
					<th>年龄</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($res as $key => $value){ ?>
						<tr>
							<td><?php echo $value["id"] ?></td>
							<td><?php echo $value["name"] ?></td>
							<td><?php echo $value["age"] ?></td>
						</tr>
					<?php }
				?>
			</tbody>
		</table>
</body>
</html>