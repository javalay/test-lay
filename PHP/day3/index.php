<?php 
// Array
// (
//     [photo] =>; Array
//         (
//             [name] =>; wx.jpg
//             [type] =>; image/jpeg
//             [tmp_name] =>; C:\Windows\phpD06E.tmp
//             [error] =>; 0
//             [size] =>; 7014
//         )
// )
    function register(){
        // 验证用户数据是否正确
        //isset 判断是否存在这个变量，trim 是去除空格
        if(!isset($_POST['username']) || trim($_POST['username'])===""){
            echo '请输入姓名';
            return;
        }
        if(!isset($_POST['nickname']) || trim($_POST['nickname'])===""){
            echo '请输入昵称';
            return;
        }
        // 实现图片的上传操作
        print_r($_FILES);
        //判断图片的上传是否成功
        if(empty($_FILES) || $_FILES["photo"]["error"]){
            echo "图片上传失败";
            return;
        }
         // 图片上传成功，我们需要去获取上传成功之后的图片名称
        $picName=$_FILES["photo"]["name"];
        //获取原始文件的后缀
        $ext=strrchr($picName,".");
        //这是随机给图片起名字
        $finaName=time().rand(1000,9999).$ext;
        global $finaName;
        //将这个文件的名称添加到$_POST中
        $_POST[]=$finaName;
        // move_uploaded_file("源文件的全路径"，"目标文件的路径");
        $tmp_name=$_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp_name,"./upload/".$finaName);
        echo "<img src='upload/$finaName'/>";
        print_r($_POST);
        $str=implode($_POST,"|");
        //将数据写入到文件里面
        file_put_contents("data.txt",$str."\n",FILE_APPEND);
    }
    if(!empty ($_POST)){
        register();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/form.css">
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        姓名：<input type="text" name="username">
        昵称：<input type="text" name="nickname">
        年龄：<input type="text" name="age">
        电话：<input type="text" name="tel">
        性别：<input type="radio" name="gender" value="男">男
             <input type="radio" name="gender" value="女" >女
             <br>
        班级：<select name="class" >
                <option value="1">黑马1期</option>
                <option value="2">黑马2期</option>
                <option value="3">黑马3期</option>
             </select>
        头像： <input type="file" name="photo" >
        <img src=upload/<?= $finaName?> style="width:500px">
        <input type="submit" value="添加信息">
    </form>
</body>
</html>