<?php
  include './common.php';
  // 创建函数实现编辑操作
  function editUser(){
    // 验证用户数据
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
    // 验证用户上传文件
    // 编辑的时候不能强迫用户修改每个值
    // 对于 文件上传，什么时候需要提示：就是用户确实上传了文件，但是上传失败了
    // 如果为表单设置了enctype=multipart/form-data属性，那么就算没有选择文件，系统会也会做默认的提交操作，只不过服务器无法获取获取到文件的相关信息，但是也会生成一个$_FILES,只不过error=4
    // 判断是否确实选择了文件上传           上传失败了
    print_r($_FILES);
    if(!empty($_FILES["img"]["name"]) && $_FILES["img"]["error"] != 0){
      $GLOBALS["error"] = '上传文件失败了';
      return;
    }

    // 收集用户数据
    $id = $_POST["id"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    if(!empty($_FILES["img"]["name"]) && $_FILES["img"]["error"] == 0){
        // 实现文件上传操作
        $fileName = "./assets/img/".uniqid().strrchr($_FILES["img"]["name"],".");
        move_uploaded_file($_FILES["img"]["tmp_name"],$fileName);
        // 重新为$photo赋值
        $photo = $fileName;
        // 创建sql语句，执行编辑操作
        $sql = "update userInfo set name = '$name',gender = '$gender',birthday = '$birthday',photo = '$photo' where id = '$id'";
    }else{
      $sql = "update userInfo set name = '$name',gender = '$gender',birthday = '$birthday' where id = '$id'";
    }
    $res = opt($sql);
    if($res){
      // 实现页面的跳转
      header("Location:./static.php");
    }
  }
  // 判断是否是get请求                   判断是否传递的id号
  if($_SERVER["REQUEST_METHOD"] =='GET' && isset($_GET["id"])){
    // 显示默认数据：什么时候才需要显示默认数据
    $id = $_GET["id"];
    // 创建sql语句
    $sql = "select id,name,photo,gender,birthday from userInfo where id = '$id'";
    // 因为我们传递的id条件，所以数组中只会存储一条记录
    $res = getData($sql);
    $value = $res[0];
  }
  else if($_SERVER["REQUEST_METHOD"] =='POST'){
    // 显示默认数据：什么时候才需要显示默认数据
    $id = $_POST["id"];
    // 创建sql语句
    $sql = "select id,name,photo,gender,birthday from userInfo where id = '$id'";
    // 因为我们传递的id条件，所以数组中只会存储一条记录
    $res = getData($sql);
    $value = $res[0];
    // 实现编辑操作
    editUser();
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
    <h1 class="heading">编辑用户</h1>
    <!-- 有错误信息时显示 -->
    <?php
      if(isset($GLOBALS["error"])){ ?>
        <div class="alert alert-danger" role="alert"><?php echo $GLOBALS["error"]; ?></div>
      <?php }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value = "<?php echo $value["id"] ?>">
      <div class="form-group">
        <label for="name">姓名</label>
        <input type="text" class="form-control" id="name" name="name" value = "<?php echo $value["name"] ?>">
      </div>
      <div class="form-group">
        <label for="gender">性别</label>
        <select class="form-control" id="gender" name="gender">
          <option value="-1">请选择性别</option>
          <option value="男" <?php echo $value["gender"] == '男'?'selected':'' ?>>男</option>
          <option value="女" <?php echo $value["gender"] == '女'?'selected':'' ?>>女</option>
        </select>
      </div>
      <div class="form-group">
        <label for="birthday">生日</label>
        <!-- date:年月日 -->
        <input type="date" class="form-control" id="birthday" name="birthday" value = "<?php echo $value["birthday"] ?>">
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
