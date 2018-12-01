<?php
    if(! empty($_FILES)){
        $nameArr=$_FILES['myfile']['name'];
        $pathArr=$_FILES['myfile']['tmp_name'];
        foreach($pathArr as $key=> $value){
            $name=time().rand(1000,9999).strrchr($nameArr[$key],".");
            move_uploaded_file($value,'./upload/'.$name);
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
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
文件选择
<input type="file" name="myfile[]">
<input type="file" name="myfile[]">
<input type="submit">
</form>
</body>
</html>