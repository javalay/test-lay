<?php 
    header('content-type:text/html;charset=utf-8');
    if(!empty($_GET)){
        $name=$_GET["username"];
        $names=['jack','rose','tom','lili'];
        if(in_array($name,$names)){
            $str='这名字已经被注册过了';
            echo $str;
            header("refresh:10;url=register.html");
        }
        else{
            $str="恭喜你，这个名字可以使用";
            echo $str;
            header("refresh:2;url=register.html");
        }
    }
?> 