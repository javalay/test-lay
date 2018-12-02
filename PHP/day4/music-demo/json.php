<?php
    // 1.读取json文件
    $data = file_get_contents("music.json");
    echo $data;
    echo "<hr>";
    // 如果json数据不能满足格式要求，那么最终转换为的结果为null
    $arr = json_decode($data);
    // var_dump($arr);

    // echo $data;

    // 2.将读取出的数据转换为我们最终需要的格式--数组|对象
    // json_decode:可以将json格式的字符串转换为php数组或者对象。如果发现json格式的数据是使用[]描述的，那么就可以将这个字符串转换为数组，如果是{}描述那么就可以转换为对象.方法的第二个参数的作用是确认转换的数据格式，默认转换为对象，如果写true,那么会将数据转换为数组
    // json_encode:可以将php数组或者对象转换为json格式的字符串

    // 我们最终需要的是数组格式的数据，所以添加第二个参数
    // $arr = json_decode($data,true);
    // print_r($arr);


    // $arr = array(
    //     "name"=>"jack",
    //     "age"=>"20",
    //     "gender"=>true
    // );

    // $str = json_encode($arr);
    // echo $str;
    // echo "<hr>";
    // var_dump(is_string($str));
?>