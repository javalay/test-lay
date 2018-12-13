<?php 

require_once "config.php";
//需要先载入config.php，再载入functions.php，因为后者依赖前者
require_once 'functions.php';
/**
 * 实现分类列表展示功能：
 * 1 获取分类id
 * 2 根据分类id查询出对应分类的文章数据
 * 3 动态生成数据
 */

//1 获取分类id
// $categoryId = $_GET['categoryId'];
//2 根据分类id查询出对应分类的文章数据
// $connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
// $sql = "select p.title,p.content,p.created,p.views,p.likes,p.feature,c.`name`,u.nickname,
// (select count(*) from comments where post_id = p.id ) as commentsCount
// from posts p
// left join categories c on c.id = p.category_id
// left join users u on u.id = p.user_id
// where p.category_id = $categoryId
// order by p.created DESC
// LIMIT 0, 10;";
// $postResult = mysqli_query($connect, $sql);
// $postArr = [];
// while ($row = mysqli_fetch_assoc($postResult)){
//   $postArr[] = $row;
// }
//3 动态生成数据(在后面具体的列表位置，class为entry处)


/*
----------------------------以下代码是使用封装好的代码实现的过程
 */
//1 获取分类id
$categoryId = $_GET['categoryId'];
//2 根据分类id查询出对应分类的文章数据
$connect = connect();
$sql = "select p.id, p.title,p.content,p.created,p.views,p.likes,p.feature,c.`name`,u.nickname,
(select count(*) from comments where post_id = p.id ) as commentsCount
from posts p
left join categories c on c.id = p.category_id
left join users u on u.id = p.user_id
where p.category_id = $categoryId
order by p.created DESC
LIMIT 0, 10;";
$postArr = query($connect, $sql);
//3 动态生成数据(在后面具体的列表位置，class为entry处)
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="static/assets/vendors/nprogress/nprogress.css">
  <script src="static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>

    <?php include_once 'public/_header.php' ?>
    <?php include_once 'public/_aside.php' ?>

    <div class="content">
      <div class="panel new">
        <h3><?php echo $postArr[0]['name'] ?></h3>
        <?php foreach($postArr as $value){ ?>
        <div class="entry"> 
          <div class="head">
            <a href="detail.php?postId=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname'] ?> 发表于 <?php echo $value['created'] ?></p>
            <p class="brief"><?php echo $value['content'] ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views'] ?>)</span>
              <span class="comment">评论(<?php echo $value['commentsCount'] ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes'] ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $value['name'] ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $value['feature'] ?>" alt="">
            </a>
          </div>
        </div>
        <?php } ?>

        <!-- 下面实现“加载更多”按钮及功能 -->
        <div class="loadmore">
           <span class="btn">加载更多</span>
        </div>

      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="./static/assets/vendors/jquery/jquery.js"></script>
    <script>
      $(function(){
        //设定当前页码数（初始就是1）
        var currentPage = 1;
        var pageSize = 10;
        //给“加载更多”按钮注册点击事件
        $(".loadmore .btn").on("click", function(){
          // console.log(111);
          //请求后台，加载更多的跟当前分类相关的数据
          //首先要获取文章分类id
          var categoryId = location.search.split("=")[1];
          console.log(categoryId);
          currentPage++;
          $.ajax({
            url : "api/_getMorePost.php",
            type : "POST",
            data : {categoryId:categoryId,currentPage:currentPage,pageSize:pageSize},
            success : function(res){
              console.log(res);
              //判断是否成功获取数据
              if(res.code == 1){
                //遍历该数据，动态生成结构
                var data = res.data;
                $.each(data, function(index, val){
                  // var str = '<div class="entry">\
                  //     <div class="head">\
                  //       <a href="detail.php?postId='+ val.id +'">'+ val.title +'</a>\
                  //     </div>\
                  //     <div class="main">\
                  //       <p class="info">'+ val.nickname +' 发表于 '+ val.created +'</p>\
                  //       <p class="brief">'+ val.content +'</p>\
                  //       <p class="extra">\
                  //         <span class="reading">阅读('+ val.views +')</span>\
                  //         <span class="comment">评论('+ val.commentsCount +')</span>\
                  //         <a href="javascript:;" class="like">\
                  //           <i class="fa fa-thumbs-up"></i>\
                  //           <span>赞('+ val.likes +')</span>\
                  //         </a>\
                  //         <a href="javascript:;" class="tags">\
                  //           分类：<span>'+ val.name +'</span>\
                  //         </a>\
                  //       </p>\
                  //       <a href="javascript:;" class="thumb">\
                  //         <img src="'+ val.feature +'" alt="">\
                  //       </a>\
                  //     </div>\
                  //   </div>';
                  var str=`<div class="entry">
                    <div class="head">
                      <a href="detail.php?postId=${val.id}">${val.title}</a>
                    </div>
                    <div class="main">
                      <p class="info">${val.nickname} 发表于 ${val.created}</p>
                      <p class="brief">${val.content}</p>
                      <p class="extra">
                        <span class="reading">阅读(${val.views})</span>
                        <span class="comment">评论(${val.commentCount})</span>
                        <a href="javascript:;" class="like">
                          <i class="fa fa-thumbs-up"></i>
                          <span>赞(${val.likes})</span>
                        </a>
                        <a href="javascript:;" class="tags">
                          分类：<span>${val.name}</span>
                        </a>
                      </p>
                      <a href="javascript:;" class="thumb">
                        <img src="${val.feature}" alt="">
                      </a>
                      </div>
                    </div>`;
                  var entry = $(str);
                  entry.insertBefore($(".loadmore"));
                });
                //数据动态添加到列表后，还需要判断，是否还可以去继续点击“加载更多”
                var maxPage = Math.ceil(res.totalCount / pageSize);
                if( currentPage >= maxPage){
                  //此时就需要隐藏加载更多的按钮
                  $(".loadmore .btn").hide();
                }
              }
            }
          });
        });
      });
  </script>
</body>
</html>