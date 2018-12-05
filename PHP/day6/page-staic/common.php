<?php
    // 查询数据
    function getData($sql){
        // 1.连接数据库 成功就返回一个连接对象(资源) 失败就返回false
        $conn = mysqli_connect("localhost","root","","mybase");
        // 判断连接是否成功
        if(!$conn){
            die("服务器异常，请重试");
        }
        // 2.设置编码
        mysqli_set_charset($conn,'utf8');

        // 3.执行sql语句:查询语句的执行有两种可能的结果：失败》false 成功》结果集(有数据|没有数据)
        // 4.接收返回值，并实现数据行的获取
        $res = mysqli_query($conn,$sql);
        $returnValue = '';
        if(!$res){
            $returnValue =  '查询失败，请重试';
        }else if(mysqli_num_rows($res) ==0){
            $returnValue = '没有满足条件的记录';
        }else{
            // 循环遍历，读取每一行数据
            while($arr = mysqli_fetch_assoc($res)){
                $result[] = $arr;
            }
            // 关闭数据库连接
            mysqli_close($conn);
            // 5.返回
            return $result;
        }
        // 关闭数据库连接
        mysqli_close($conn);
        return $returnValue;
    }

    // 封装增加删除和修改操作
    function opt($sql){
        echo $sql;
        // 1.连接数据库 成功就返回一个连接对象(资源) 失败就返回false
        $conn = mysqli_connect("localhost","root","root","mybase");
        // 判断连接是否成功
        if(!$conn){
            die("服务器异常，请重试");
        }
        // 2.设置编码
        mysqli_set_charset($conn,'utf8');

        // 3.执行sql语句:成功>true 失败>false
        $res = mysqli_query($conn,$sql);
        // 关闭连接
        mysqli_close($conn);
        return $res;
    }
?>