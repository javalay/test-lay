<?php
// echo 11112221;
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // echo 11
        /*1.读取文件*/
        $dataStr = file_get_contents('./data.json');
        // print_r($dataStr);
        /*2.转换为数组，因为我们需要判断数组中的成员的name属性是否是指定的用户名--遍历*/
        $dataArr = json_decode($dataStr);
        // print_r($dataArr); 
        /*3.遍历*/
        for($i=0;$i<count($dataArr);$i++){
            if($dataArr[$i] -> name == $_GET['name']){
                $arr = array(
                    'code'=>0, //状态码
                    'msg'=>'用户名已存在' //状态信息
                );
                echo json_encode($arr);
                return;
            }
        }
    }
?>