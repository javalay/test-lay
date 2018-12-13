<?php 
require_once '../config.php';
require_once '../functions.php';
/**
 * 根据文章的分类id对数据进行更多的获取：
 * （讲解分页原理）
 * select * from posts
 * limit 0, 10
 * #这是第1次获取，相当于获取了第1页的数据
 * limit 10, 10
 * #这是第2次获取，相当于获取了第2页的数据
 * limit 20, 10
 * #这是第3次获取，相当于获取了第3页的数据
 * 。。。。。。。
 * 总结：要获取第n页数据，那就应该这样：
 * select ......
 * limit (n-1)*10, 10
 * 其中“10”就是计划每页获取的数据条数
 *
 * 
 * 1 获取分类id，第几次获取，要获取多少条
 * 2 到数据库中查找对应的数据
 * 3 把数据返回给前台，让其生成结构
 */

//1 获取必要数据：
$categoryId = $_POST['categoryId'];
$currentPage = $_POST['currentPage'];
$pageSize = $_POST['pageSize'];
//还需要计算出从哪条数据开始获取（起始行号，从0开始算起）
$offset = ($currentPage - 1 ) * $pageSize;
//2 查询数据库
$connect = connect();
$sql = "select p.id, p.title,p.content,p.created,p.views,p.likes,p.feature,c.`name`,u.nickname,
(select count(*) from comments where post_id = p.id ) as commentsCount
from posts p
left join categories c on c.id = p.category_id
left join users u on u.id = p.user_id
where p.category_id = $categoryId
order by p.created DESC
LIMIT $offset, $pageSize;";
$postArr = query($connect, $sql);

//3 还需要去获取到当前分类下的文章的总条数
$sqlCount = "select count(*) postCount from posts where category_id = $categoryId";
$countArr = query($connect, $sqlCount); 
$totalCount = $countArr[0]['postCount'];
// echo $totalCount;
/**
 * 一般在实际开发中，项目会约定一个返回的结构，比如通常如下所示：
 * 		{
 * 			code: 请求的状态 - 约定如果是某些特定的数字，代表不同的状态
 * 					比如， 1代表成功，0代表失败
 * 			msg : 想要返回给前台的一些信息
 * 			data: 返回给前台的数据
 * 		}
 */
$response = ["code"=>0, "msg"=>"操作失败"];
if($postArr){
	$response['code'] = 1;
	$response['msg'] = "操作成功";
	$response['data'] = $postArr;
	$response['totalCount'] = $totalCount;
}
header("content-type: application/json; charset=utf-8");
echo json_encode($response);

?> 