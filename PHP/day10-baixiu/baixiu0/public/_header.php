<?php 
//链接数据库
$connect=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
//准备sql语句
$sql="SELECT * FROM categories Where id!=1";
//查询数据库里面的数据
$reslt=mysqli_query($connect,$sql);
// print_r($reslt);
//  $reslt;
// 把数据集合转换为二维数组，明确指定一个空数组 
$arr=[];
while ($row =mysqli_fetch_assoc($reslt)){
// print_r($row);
    $arr[]=$row;
}
?>
<div class="header">
      <h1 class="logo"><a href="index.php"><img src="./static/assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
        <!-- <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> -->
        <!-- 遍历二维数组 生成结构 -->
        <?php foreach($arr as $value){ ?>
        <!-- 传递参数 categoryId 这个参数在当前数组$value['id'] 中获取-->
        <li><a href="list.php?categoryId=<?= $value['id']?>"><i class="fa <?= $value['classname'] ?>"></i><?= $value['name'] ?> </a></li>
        <?php } ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>