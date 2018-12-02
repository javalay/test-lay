<?php
    if(isset($_GET["id"])){
        // 获取id号
        $id = $_GET["id"];
        //获取所有数据，转换为数组
        $data = file_get_contents("music.json");
        $dataArr = json_decode($data,true);
        // 根据id号删除数组中的某个值
        foreach($dataArr as $key => $value){
            // 判断id的值是否匹配，如果匹配则说明找到了需要删除的数据
            if($id == $value["id"]){
                // 删除数组中的这条数据
                // array_splice(数组，起始索引，删除的个数)
                array_splice($dataArr,$key,1);
                break;
            }  
        }
        // 将数组的数据重新写入到文件:将已经删除了某条数据的数组重新写入到文件
        file_put_contents("music.json",json_encode($dataArr));
        // 实现页面的跳转
        echo "<script>location.href='list.php'</script>";
    }
?>