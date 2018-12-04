<?php 
    //通过cookie 的判断来验证用户之前是否登录过
    if($_COOKIE['isLogin']!="yes"){
        header("Location:./login.php");
    }
    //判断是否写入过session数据
    // $_SESSION['user']=array(
    //     "username" => $_POST["username"],
	// 	"userPwd" => $_POST["password"],
	// 	"isLogin" => "yes"
    // );
    //下面是session 方式获取数据
    // session_start();
    // if(!isset($_SESSION['user'])||$_SESSION['user']['isLogin']!=="yes"){
    //     header("Location:./login.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>  这是首页!  </h1>
	<a href="logout.php">退出</a>
</body> 
</html>