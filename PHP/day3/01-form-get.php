<?php
    // $_GET可以用来接收客户端以get方式传递的参数，注意只能接收以get方式传递的数据
    // 它的格式是一个关联数组
    // print_r($_GET);
    // 通过$_POST只能接收到使用post方式发送的数据
    // print_r($_POST);
    print_r($_REQUEST);
    // 判断是否拥有某一个参数值，如果有，就说明用户发送了请求，那么就需要进行相应的处理，否则，跳过
    if(isset($_GET['userName123'])){
        echo '我的名称是'.$_GET['userName123'].',我的密码是'.$_GET['userPwd'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- 
        action:设置提交数据的处理页面。就是用来设置提交到的目标地址。一般来说它就是一个可以进行后台业务处理的页面 ***.php
        method:如果没有设置默认请求方式为get
            get:一般用来获取数据:特点：参数会在url地址栏中拼接
            post:一般用来发送数据到服务器
     -->
    <form action="01-form-get.php" method="get">
        <!-- 如果想提交表单元素的数据，则必须为表单元素设置name属性
        因为如果没有设置name属性，那么就无法生成传递参数时所需要的key=value的结构，因为浏览器不会自动的为数据生成key值 -->
        用户名：<input type="text" name="userName123"> <br>
        密码：<input type="password" name="userPwd"> <br>
        <input type="submit">
    </form>
</body>
</html>