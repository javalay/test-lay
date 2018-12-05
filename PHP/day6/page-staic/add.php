<?php
  // 引入公共模块
  include "./common.php";
  function add(){
    // 验证用户输入 
    if(!isset($_POST["name"]) || trim($_POST["name"]) === ''){
      $GLOBALS["error"] = '请输入用户名';
      return;
    }
    if(!isset($_POST["gender"]) || $_POST["gender"] === '-1'){
      $GLOBALS["error"] = '请选择性别';
      return;
    }
    if(!isset($_POST["birthday"]) || trim($_POST["birthday"]) === ''){
      $GLOBALS["error"] = '请选择生日日期';
      return;
    }
    // 判断用户是否成功的上传了文件
    if(!isset($_FILES) || $_FILES["img"]["error"] !=0){
      $GLOBALS["error"] = '文件上传失败';
      return;
    }
 
    // 收集用户信息
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    // name  tmp_name error 
    $img = "./assets/img/".uniqid().strrchr($_FILES["img"]["name"],"."); //icon-01.png

    // 上传图片>如果用户选择了图片
    move_uploaded_file($_FILES["img"]["tmp_name"],$img);

    // 实现用户数据的添加:操作数据库
    $res = opt("insert into userInfo values(null,'$name','$img','$gender','$birthday')");

    // 实现页面的跳转》跳转回首页
    header("Location:static.php");
  }
  // 判断用户是否进行的post方式提交请求
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    add();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XXX管理系统</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">XXXX管理系统</a>
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
    <h1 class="heading">添加用户</h1>
    <?php
      if(isset($GLOBALS["error"]) && count($GLOBALS["error"]) != 0){ ?>
        <!-- 有错误信息时显示 -->
        <div class="alert alert-danger" role="alert"><?php echo $GLOBALS["error"] ?></div>
      <?php }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender" name="gender">
          <option value="-1">请选择性别</option>
          <option value="男">男</option>
          <option value="女">女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <input type="date" class="form-control" id="birthday" name="birthday">
      </div>
      <div class="form-group">
        <label for="img">头像</label>
        <input type="file" class="form-control" id="img" name="img">
      </div>
      <button class="btn btn-primary">保存</button>
    </form>
  </main>
</body>
</html>
