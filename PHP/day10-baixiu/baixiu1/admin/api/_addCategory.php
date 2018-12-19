<?php 
    require_once '../../config.php';
    require_once '../../functions.php';

    $name=$_POST['name'];
    $slug=$_POST['slug'];
    $classname=$_POST['classname'];
    $connect=connect();
    $sql="SELECT COUNT(*) as count FROM categories WHERE `name`='{$name}'";
    $countResult=query($connect,$sql);
    $count=$countResult[0]['count'];
    $response=['code'=>0,'msg'=>'操作失败'];
    if($count>0){
        $response['code']=3;
        $response['msg']='分类名称已经存在，不能重复添加';
    }
    else{

        // / 如果不存在，就继续新增的逻辑
		// $keys = array_keys($_POST);
		// $values = array_values($_POST);
		// $sqlAdd = "insert into categories (" .implode(',', $keys) .") values ('" . implode("','", $values) . "')";
		
		// //执行新增的操作语句
		// $addResult = mysqli_query($connect, $sqlAdd);
		
        $addResult=insert($connect,'categories',$_POST);

        // 判断添加的结果是否成功，如果成功，告知前端可以动态生成表格结构了
		if( $addResult ){
			$response['code'] = 1;
			$response['msg'] = "操作成功";
        }
        //写入数据库失败的情况下
        else{
            $response['code'] = 2;
			$response['msg'] = "写入数据库失败";
        }
    }
    header("content-type:application/json; charset=utf-8");
	echo json_encode($response);
?>