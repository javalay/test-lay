<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    /*
    1.......................
        <?php echo xxxx;?>
        可以简化为：
        <?=xxxx?>
    */

     /*
    2.......................
       $_REQUEST能不用就不用
    */

     /*
    3.......................
       有关判断是否提交过来了数据：
        判断post：
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //去处理post数据
            }
        判断get：
            if(isset($_GET['xxx'])){
                //去处理get数据
            }
        【还可以这样来判断：】
            if( !empty($_POST) ){
                //去处理post数据
            }
            if( !empty($_GET) ){
                //去处理get数据
            }
            
    */

     /*
    2.......................
       表单数据的收集，分3种情况：
        1，单项值：除了checkbox，都是！
        2，多选值：就是checkbox
        3，文件
    */
    /*
            单选项注意事项：
                1，一组单选需要用相同的名字
                2，每个单选都必须使用value且各不相同

            多选项注意事项：
                1，一组多选需要用相同的名字，且带“[ ]"
                2，每个多选都必须使用value且各不相同，下拉选项注意事项：
                1，强烈建议每个option都加value值
    */

    /*
    课堂练习：
        设计一个表单，其中包含：
            用户名，密码，性别（单选），爱好（多选），
            学历（下拉），简历（多行文本框），头像
        提交后，输出如下格式的结果数据：
            用户名：xxx
            密码：xxx
            性别：xxx
            爱好：xxx，yyy，zzz
            学历：xxx
            简历：..........
            头像：<img src="...." />这里应该显示一张图片
        
        参考答案：
        if(!empty($_POST)){
            //print_r($_GET);
            echo "<br>用户名：" . $_GET['userName'];
            //..........
            $data = $_GET['hobby'];//这是一个数组
            //implode（）用于将一个数组转换为一个字符串
            //转换的方式是使用指定的字符来“串起来”
            echo "<br>爱好：" . implode(',', $data);
        }
     */

     /*
      有关文件上传：
        文件上传的核心代码：
        move_uploaded_file("源文件", "目标文件");

        "源文件"就是$_FILES['mysql']['tmp_name']
        "目标文件"需要考虑文件名和后缀的动态获取，如下：
        $source_name = $_FILES['filename']['name'];
        $extension = strrchr($source_name, ".");
        $fileName = time() . rand(1000,9999) . $extension;
        $target_name = "./upload/" . $fileName;

        单文件上传后，$_FILES数组的结构类似如下：
        array(
            "myfile" => array(
                "name" => "xxx.jpp",        //原文件名
                "type" => "image/jpeg",     //原文件类型
                "tmp_name" => "c:/window/temp/fa2e2242.tmp",//临时文件名
                "error" => 0,               //错误代号，0表示没有错误
                "size" => 3424              //文件大小（单位byte）
            )
        )
        多文件上传的表单，推荐使用这个形式：
            <input type="file"  name="myfile[]" multiple >
        
        多文件上传后，$_FILES数组的结构类似如下：
        array(
            "myfile" => array(
                "name" => array(
                    0 => 'xxx1.txt',
                    1 => 'xxx2.png'
                ),
                "type" => array(
                    0 => 'text/html',
                    1 => 'image/png'
                ),
                "tmp_name" => array(
                    0 => 'c:/window/temp/fa2e2242.tmp',
                    1 => 'c:/window/temp/owr234w3.tmp',
                ),
                "error" => array(
                    0 => 0,
                    1 => 0
                ),
                "size" => array(
                    0 => 1042,
                    1 => 2424
                ),
            )
        )

      */
    ?>
</body>
</html>