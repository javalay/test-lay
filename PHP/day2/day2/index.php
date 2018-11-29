<?php
echo " Hello word!!!";
$str="hello word  世界你好！";
echo mb_strlen($str);
echo date("Y年m月d日 H:i:s");

echo "<hr>";
$data=date("Y-m-d H:i:s");
//获取当前的时间戳
echo strtotime($data);
echo "<hr>";
// echo file_get_contents("data.txt");
// header("Content-Type:image/jpeg");
// $res=file_get_contents("monkey.png");
// echo $res;
$count = file_put_contents("data.txt","这是我写入的内容",FILE_APPEND);
echo $count;
$name="jack";
echo "我的名字叫{$name}\n  <br> 我\t的\"年龄\"是20";
?>
