<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>语法特点</h1>
<?php
$a=1234;
$b=0;
$array=array(
    "foo" => "bar",
    "far" => "foo",
    100 => -100,
);
// echo $array;
// var_dump($array);
// 输出 1  为真  输出为空 就是为假 
echo isset($a);
echo "<br>";
// var_dump() 是一个函数，返回的是bool（true/false）型
var_dump(isset($a));
echo "<br>";
// var_dump() 是一个函数，返回的是bool（true/false）型
var_dump(empty($b));
//判断变量是否为空值，为空的值“” 0 “0” null false array（）; 返回值为true
// empty();
// echo empty($a);
echo "<br>";
// unset();  删除变量 删除后值为空
// unset($a,$b);
echo $a;
echo "<br>";
$c="1221cc3";
// var_dump(is_string($c));
echo "<br>";
// 在php里面+ 只是一个运算符  会把加号两边的数据做转换操作=====字符串连接符用点 . 来进行链接
echo '这是一个数组'.$c;
echo "<br>";

echo "这是一个数组$c";
echo "<br>";
// $c 如果变量名后紧接着其他的合法字符，（中文，a-z，A-Z，0-9）系统会将整个变量及后面的字符当成一个变量进行解析
// 可以将变量包裹在大括号中{}
echo "这是一个数组$c你睡觉哦";
echo "<br>";
echo "这是一个数组{$c}你睡觉哦";
echo "<br>";

//转义字符 \" \\ \n \t \$
echo "这是数组{$c}\n";
echo "<br>";

// echo $a;
// echo $b;
echo "hello wrold<br>";
echo "结果为真";
print("你想干什么");
print_r("true");
var_dump("xxx,a,w");
if(true){?>
    <h1> 结果为真</h1>
    <?php
}
?>
<hr>
</body>
</html>