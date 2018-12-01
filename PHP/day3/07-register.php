<?php
    function register(){
        // Array ( 
            // [username] => QQ 
            // [nickname] => QQ 
            // [age] => 123 
            // [tel] => 123 
            // [gender] => 男 
            // [class] => 1 
            // )
        // print_r($_POST);
        // 验证用户数据是否正确
        //isset 判断是否存在这个变量，trim 是去除空格
        if(!isset($_POST["username"]) || trim($_POST["username"]) === ""){
            echo '请输入姓名';
            // 1.如果在php结构中直接写return,那么当运行到return代码的时候，整个php文件的执行就结束了
            // 2.如果在方法中写return,那么这个return就只能结束这个方法的执行
            return;
        }
        if(!isset($_POST["nickname"]) || trim($_POST["nickname"]) === ""){
            echo '请输入昵称';
            return;
        }
        // 实现图片的上传操作
        print_r($_FILES);
        // 判断图片上传操作是否成功
        if(empty($_FILES) || $_FILES["photo"]["error"]!=0){
            echo '图片上传失败';
            return;
        }
        // 图片上传成功，我们需要去获取上传成功之后的图片名称
        $picName = $_FILES["photo"]["name"];
        $ext = strrchr($picName,".");
        $finalName = time().rand(1000,9999).$ext;
        // 将这个文件名称添加到$_POST中
        $_POST[] = $finalName;
        move_uploaded_file($_FILES["photo"]["tmp_name"],$finalName);
        print_r($_POST);
        // 数据的写入：明确数据写入的格式 qq|qq|123|123|男|1
        // implode:它可以将关联的数据以指定分隔符分隔，转换为字符串
        // explode:它可以将字符串以指定的分隔符分隔，生成关联数组
        $str = implode($_POST,"|");
        // 将数据写入到文件
        file_put_contents("data.txt",$str."\n",FILE_APPEND);
    }
    // 判断用户是否提交的post请求
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        register();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- 引入样式 -->
    <link rel="stylesheet" href="./css/form.css">
</head>
<body>   
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        姓名：<input type="text" name="username">
        昵称：<input type="text" name="nickname">
        年龄：<input type="text" name="age">
        电话：<input type="text" name="tel">
        性别：<input type="radio" name="gender" value="男" checked>男
             <input type="radio" name="gender" value="女" >女
             <br>
        班级：<select name="class" >
                <option value="1">黑马1期</option>
                <option value="2">黑马2期</option>
                <option value="3">黑马3期</option>
             </select>
        头像： <input type="file" name="photo" >
        <input type="submit" value="添加信息">
    </form>
</body>
</html>