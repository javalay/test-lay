<?php
  // 引入公共的封装模块
  include './common.php';
  // 获取数据
  $res = getData("select id,name,photo,gender,birthday from userInfo");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXX管理系统</a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">用户管理</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">商品管理</a>
      </li>
    </ul>
  </nav>
  <main class="container">
    <h1 class="heading">用户管理 <a class="btn btn-link btn-sm" href="add.php">添加</a></h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>头像</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th class="text-center" width="140">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if(is_array($res)){
          foreach($res as $key=> $value){ ?>
        <tr>
          <th scope="row"><?php  echo $value['id'] ?></th>
          <td><img src="<?php echo  $value['photo'] ?>" class="rounded"></td>
          <td><?php echo $value['name'] ?></td>
          <td><?php echo $value['gender'] ?></td>
          <td><?php 
                  // 1.先获取数据离最原始的1970-1-1所间隔的秒数
                  // strtotime可以获取指定的日期参数离原始1970-1-1所间隔的秒数
                  $time1 = strtotime($value["birthday"]);
                  // 2.再获取今天的日期离原始的1970-1-1所间隔的秒数
                  $time2 = time();
                  // 3.计算两个时间相关的秒数，通过秒数计算出年份值
                  // ceil:向上取整  ceil(0.6) = 1
                  $age = ceil(($time2 - $time1) / 60 / 60 / 24 / 365);
                  // 展示
                  echo $age;
                ?></td>
          <td class="text-center">
            <a href="edit.php?id=<?php echo $value['id'] ?>" class="btn btn-info btn-sm">编辑</a>
            <a href="del.php?id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm">删除</a>
          </td>
        </tr>
        <?php }
        }else{
          echo "<tr><td colspan='6'>".$res."</td> </tr>";
        }
        ?>
      </tbody>
    </table>
  </main>
</body>
</html>
