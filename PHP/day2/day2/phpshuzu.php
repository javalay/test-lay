<?php
// 索引数组，通过索引操作数组
 $arr=[1,2,3,true,"abc"];
 echo $arr[1];
 //索引数组 for
 for($i=0;$i<count($arr);$i++){
     echo $arr[$i];
 }
 //关联数组：以键值对的方式来描述数据，类似于js中的对象{key:value,key:value...}
//  语法$arr($key => $value,$key => $value..)
   $arr = array(
        "name" => "jack",
        "age" => 20,
        "gender" => true
    );
 // 获取关联数组中的成员：通过key来获取数组中的成员
 
    // echo $arr["gender"];
    // echo $arr; //Array
    print_r($arr);
    // var_dump($arr);

        // 遍历关联数组 foreach
        // as 后面有两个 代表键和值
    // foreach(数组对象  as 键 => 值){

    // }
    // foreach(数组对象 as 值){

    // }
    foreach($arr as $key => $value){
        echo $key .":".$value.'<br>';
    }
    //as 后面只有一个值，就代表这个值
    // foreach($arr as $value){
    //     echo $value.'<br>';
    // }
        $arr = array(
        1,
        2,
        3,
        "name" => "jack",
        "age" => 20,
        //  10下面的下标跟 这个10 息息相关，
        10 => "bob",
        "rore",//这个下标是11 
        4
    );
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    $arr=array(
        9,6,3,"name"=>8, 5, 2,10=>1, 5=>8
    );
    $max=$arr[0];
    $kmax=0;
    foreach($arr as $key => $value){
        if($value >$max){
            $max=$value;
            $kmax=$key;
        }
    }
    echo $max;
    echo $kmax;
// $arr =array()
//       // 描述学生对象：姓名+年龄
//       $arr = array( //索引数组
//         // 描述第一个学生对象的数据
//         "first" => array( //关联数组--类似于js中的对象
//             "name" => "jack",
//             "age" => 20
//         ),
//         array(
//             "name" => "rose",
//             "age" => 18
//         )
//     );
    // print_r($arr);
    // echo '<r>';
    // foreach($arr as $key => $value){
    //     // 二维数组的遍历需要考虑使用嵌套循环
    //     foreach($value as $subkey => $subvalue){
    //         echo $subkey .":".$subvalue ."<br>";
    //     }
    // }
    // echo "<br>"
    $arr=array(
        9,6,3,"name"=>8, 5, 2,10=>"abc", 5=>8
    );
    $max=$arr[0];
    foreach($arr as $key => $value){
        if(is_numeric($value)){
            if($value >$max){
                $max=$value;
            }
        }
    }
    echo $max;
?>