<?php   
    header('content-type:text/html;charset=utf-8');
    if(!empty($_POST)){
        $name=$_POST["username"];
        $names=['jack','rose','tom','lili'];
        if(in_array($name,$names)){
            $str="已经被用过了";
            echo $str;
        }
        else{
            $str="可以用";
            echo $str;
        }
    }
?>