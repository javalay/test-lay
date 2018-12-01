<?php
    // $_GET可以用来接收客户端以get方式传递的参数，注意只能接收以get方式传递的数据
    // 它的格式是一个关联数组
    // print_r($_GET);
    // echo '我的名称是'.$_GET['userName123'].',我的密码是'.$_GET['userPwd'];

    // 如果是以post方式发送请求，那么就以$_POST来接收参数
    // print_r($_POST);

    // 判断：用户是否真正的发送的post请求，也就意味着我们得判断当前请求是否是post,如果是则进行处理，否则就跳过
    // print_r($_SERVER);
    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // 这是另一种判断方式
        if(! empty($_POST)){
        // 重点强调
        // 1.通过$_GET只能接收到使用get方式发送的数据
        // print_r($_GET);
        // $_REQUEST可以接收通过get或post方式提交的数据，但是我们不用，为什么,有两个原因
        // 1.效率更低下
        // 2.它的取值受配置文件的影响：它的取值有一个顺序，在同名的情况下，后面所取的值会将前面所取的值覆盖，所以它不安全
        // 建议：能不用就不用
        // print_r($_REQUEST);
    //     $hobby = $_POST['hobby'];   
    // for($i=0;$i< count($hobby);$i++){
    //    " 爱好：".print_r($hobby)."< br>"; 
    // }
        echo '<br>我的名称是:'.$_POST['userName123'];
        echo '<br>我的密码是:'.$_POST['userPwd'];
        echo'<br>性别:'.$_POST['gender'];
            $data=$_POST['hobby'];
            // implode 把一个数组里面一个个对象拼接出来
        echo'<br>我的爱好:'.implode(',',$data);
        echo'<br>学历:'.$_POST['education'];
        echo'<br>   简历:'.$_POST['resume'];
        print_r($_FILES);
        if(! empty ($_FILES)){
            // print_r($_FILES);
            $type=$_FILES["myfile"]["type"];
            $tmp_name=$_FILES['myfile']['tmp_name'];
            // if(strpos($type,"image/")===0){
                $filename=$_FILES['myfile']['name'];
                echo $filename;
                $extension=strrchr($filename,".");
                $myname = time().rand(1000,9999).$extension;
                move_uploaded_file($tmp_name,"./upload/".$myname);//把上传的这个文件移动到 当前文件中./upload/中
                // 双引号字符串-- 外双内单
                 echo "<img src='upload/$myname'/>";
            }
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
     <!-- 
         将method设置为post
         重新设置action
      -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <!-- 如果想提交表单元素的数据，则必须为表单元素设置name属性
        因为如果没有设置name属性，那么就无法生成传递参数时所需要的key=value的结构，因为浏览器不会自动的为数据生成key值 -->
        用户名：<input type="text" name="userName123"> <br>
        密码：<input type="password" name="userPwd"> <br>
        性别：<input type="radio" name="gender" value="男">男
            <input type="radio" name="gender" value="女">女<br>
            <input type="checkbox" name="hobby[]" value="发呆">发呆
            <input type="checkbox" name="hobby[]" value="打游戏">打游戏
            <input type="checkbox" name="hobby[]" value="打代码"">打代码<br>
        学历：<select name="education" >
                <option value="前端">前端</option>
                <option value="JAVA">JAVA</option>
                <option value="IOS">IOS</option>
        </select><br>
        这里输入简历:<textarea cols="10" rows="10" name="resume"></textarea><br>
        头像： <input type="file" name="myfile" ><br>
        <img src=upload/<?= $myname?> style="width:500px">
        <input type="submit"><br>
    </form>
</body>
</html>