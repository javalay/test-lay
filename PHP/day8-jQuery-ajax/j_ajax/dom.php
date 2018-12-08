<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
    // // 封装增加删除和修改操作
    // function opt($sql){
    //     echo $sql;
    //     // 1.连接数据库 成功就返回一个连接对象(资源) 失败就返回false
    //     $conn = mysqli_connect("localhost","root","","mybase");
    //     // 判断连接是否成功
    //     if(!$conn){
    //         die("服务器异常，请重试");
    //     }
    //     // 2.设置编码
    //     mysqli_set_charset($conn,'utf8');
    //     // 3.执行sql语句:成功>true 失败>false
    //     $res = mysqli_query($conn,$sql);
    //     // 关闭连接
    //     mysqli_close($conn);
    //     return $res;
    // }
    // if(!empty($_POST)){
    //     $value = $_POST["value"]; 
    //     echo $value;
    //     // $value=5;
    //     $sql = "update sqlzan set zan = '$value' where id = '1'";
    //     $res= opt($sql);
    //   }
?>
    <script src="../jquery.js"></script>
    <!-- <form action=" " method="post" enctype="multipart/form-data"> -->
    <input type="submit" value="" class="btn" name="value" id="value">
    <!-- </form> -->
    <script>
        $(function(){
            $.ajax({
            type:"get",
            url:"./ajax.php",
            data:{num:this.value},
            dataType:"Text",
            success:function(result){
               $(".btn").val(result);
            }
            $(".btn").click(function(){
        $.ajax({
            type:"get",
            url:"./ajax.php",
            data:{num:this.value},
            dataType:"Text",
            success:function(result){
               $(".btn").val(result);
            },
        // 请求失败之后的回调
            error:function(e){
            if(e.statusText == "timeout"){
                alert("请求超时，请重试");
            }
        }
        });
    });
        })

    </script>
</body> 
</html>