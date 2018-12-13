<?php 
/*
  完成的是登录的功能
  1 用户输入邮箱和密码，点击登录
  2 收集用户的数据，发送到服务器
  3 把用户数据和数据库数据对比
  4 把登录结果通知前台

  前端：
      登录按钮注册点击事件
        收集用户数据，ajax发送给服务器

        判断返回的数据是否登录成功
          成功就跳转到后台页面，否则提示错误

  后端：
      得到用户的邮箱和密码
      根据邮箱和密码到数据库中查找有没有对应的数据
      最终通知前端是否登录成功

 */

//如果点击的是右上角的“退出”按钮，则准备退出：
if(isset($_GET['logout']) && $_GET['logout'] == 1){
  $_SESSION['isLogin'] = '';
  header("location:login.php");
  die;
}

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="../static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none;">
        <strong>错误！</strong> <span id="msg">用户名或密码错误！</span>
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <span id="btn-login" class="btn btn-primary btn-block" >登 录</span>
    </form>
  </div>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script>
    $(function(){
        //给登录按钮注册点击事件
        $("#btn-login").on("click",function(){
          // 1 获取手机用户的邮箱和密码
          var email = $("#email").val();
          var password = $("#password").val();
          // 2 先给前段吧数据做一下简单的数据验证
          var reg = /\w+@\w+[.]\w+/;
          if( !reg.test(email) ){
            // 提示用户
            $("#msg").text("你输入的邮箱有误，请重新输入");
            $(".alert").show();
              return;
          }
          // 3 如果邮箱格式正确，就吧数据发送给服务器
          $.ajax({
            type: "POST",
            data : {email:email, password:password},
            url : "api/_userLogin.php",
            success : function(res){
              // 4 判断返回的结果是否登录成功
              if( res.code == 1){
                //跳转到后台首页
                location.href = 'index.php';
              }
              else{
                $("#msg").text("用户名或密码错误！");
                $(".alert").show();
              }
            }
          });
        });
    });
  </script>
</body>
</html>
