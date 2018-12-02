<?php 
//先判断是否有这个id传过来
    if(isset($_GET["id"])){
        // 利用get形式 去获取传过来的id值
        $id=$_GET["id"];
        //获取music.json文件
        $arr=file_get_contents("music.json");
        // print_r($arr);
        //把字符串转换为数组的形式
        $dlarr=json_decode($arr,true);
        // print_r($dlarr);
        //循环遍历数组
        foreach($dlarr as $key => $value){
            //判断传过来的id值是否匹配到相应的id值
            if($id==$value["id"]){
                //利用array_splice（数组，起始索引，删除个数）
                array_splice($dlarr,$key,1);
                // 这里要添加break  结束当前的循环
                break;
            }
        }
        //结束上面的操作之后，要把这些数据重新转化为数组，存入music.json 中
        $darr=json_encode($dlarr);
        //然后把更改后的文件重新添加到指定的位置中，方便后期使用
        file_put_contents("music.json",$darr);
        //  这个操作是跳转到之前的那个页面 list.php
        echo "<script>location.href='list.php'</script>"; 
    }
?>