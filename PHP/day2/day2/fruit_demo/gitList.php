<!-- // 利用 php语法获取到文件夹中 排版好的文件 然后切割字符串explode("\n",$str); 遇到换行就切割
// 切割之后就是一个复杂类型， -->
<?php 
$str=file_get_contents("fruit.txt");
$arr=explode("\n",$str);
foreach($arr as $value){
    $result[]=explode("|",$value);
}
foreach($result as $value){?>
    <li>
        <img src="<?php echo $value[1] ?>" alt="">
        <a href="javascript:;"><?php echo $value[2] ?></a>
    </li>
    <?php
}
?>