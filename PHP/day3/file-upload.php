<?php
    if(! empty ($_FILES)){
        print_r($_FILES);
        $type=$_FILES["myfile"]["type"];
        $tmp_name=$_FILES['myfile']['tmp_name'];
        // if(strpos($type,"image/")===0){
            $filename=$_FILES['myfile']['name'];
            echo $filename;
            $extension=strrchr($filename,".");
            $myname = time().rand(1000,9999).$extension;
            move_uploaded_file($tmp_name,"./upload/".$myname);
        }
        // else {
        //     echo '你选择不是图片';
        // }
    // }
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
<form action="" method="post" enctype="multipart/form-data">
    文件选择：<input type="file" name="myfile">
    <br>
<input type="submit">
</form>
</body>
</html>