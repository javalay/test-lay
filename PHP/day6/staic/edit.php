<?php 
//引用封装好的文件
    include 'common.php';
    //创建函数实现操作
    function editUser(){
      //验证用户操作，用户数据
      if(!isset($_POST['name'])||trim($_POST['name'])===''){
        $GLOBALS['error']='请输入用户名';
        return;
      }
      if(!isset($_POST['gender'])||$_POST['gender']==='-1'){
        $GLOBALS['error']='请选择性别';
        return;
      }
      if(!isset($_POST['birthday'])||trim($_POST['birthday'])===''){
        $GLOBALS['error']='请选择生日日期';
        return;
      }
      print_r($_FILES);
    // 如果为表单设置了enctype=multipart/form-data属性，那么就算没有选择文件，系统会也会做默认的提交操作，只不过服务器无法获取获取到文件的相关信息，但是也会生成一个$_FILES,只不过error=4
    // 判断是否确实选择了文件上传           上传失败了
      if(!empty($_FILES['img']['name'])&&$_FILES['img']['error']!=0){
        $GLOBALS['error']='文件上传失败';
      }
      $id=$_POST['id'];
      $name=$_POST['name'];
      $gender=$_POST['gender'];
      $birthday=$_POST['birthday'];
      if(!empty($_FILES['img']['name'])&&$_FILES['img']['error']==0){
        //创建一个要存储的地址栏 uniqid().strrchr() 这是随机起名的方法
        $fileName="./assets/img/".uniqid().strrchr($_FILES['img']['name'],".");
        //把上传的文件储存到相应的位置
        move_uploaded_file($_FILES['img']['tmp_name'],$fileName);
        $photo=$fileName;
        $sql="update userInfo set name='$name',gender='$gender',birthday='$birthday',photo='$photo' where id='$id'";
      }
      else{
        $sql="update userInfo set name='$name',gender='$gender',birthday='$birthday' where id='$id'";

      }
      $res= opt($sql);
      if($res){
        header("Location:./static.php");
      }
    }
    if(!empty($_GET) && isset($_GET['id'])){
        $id=$_GET['id'];
        $sql="select id,name,photo,gender,birthday from userInfo where id='$id'";
        $res= getData($sql);
        $value=$res[0];
    }
    else if(!empty($_POST)){
        $id=$_POST['id'];
        $sql="select id,name,photo,gender,birthday from userInfo where id='$id'";
        $res= getData($sql);
        $value=$res[0];
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
          <option value="女" <?php echo $value['gender'] == "女"?'selected':'' ?>>女</option>
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
