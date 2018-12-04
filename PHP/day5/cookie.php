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
        setcookie("username","jack",time()+1,"./day5",);
    ?>
    <a href="cookie1.php">获取图片</a>
</body>
</html>