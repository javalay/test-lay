<?php 
    function getData($sql){
        $conn =mysqli_connect("localhost","root","","mybase");
        if(!$conn){
            die("服务器异常，请重试");
        }
        mysqli_set_charset($conn,"utf8");
        $res= mysqli_query($conn,$sql);
        $returnValue="";
        if(!$res){
            $returnValue="查询失败，请重试";
        }else if(mysqli_num_rows($res) ==0){
            $returnValue = '没有满足条件的记录';
        }else{
            while($arr=mysqli_fetch_assoc($res)){
                $result[]=$arr;
            }
            mysqli_close($conn);
            // print_r($result);
            return $result;
        }
        mysqli_close($conn);
        return $returnValue;
    }  
    //修改函数
    function opt($sql){
        echo $sql;
        $conn = mysqli_connect("localhost","root","","mybase");
        // 判断连接是否成功
        if(!$conn){
            die("服务器异常，请重试");
        }
        // 设置编码
        mysqli_set_charset($conn,'utf8');
        //执行sql语句：成功》true 失败false
        $res=mysqli_query($conn,$sql);
        mysqli_close($conn);
        return $res;
    }
 ?>