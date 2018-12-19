<?php 
  require_once "config.php";
  require_once "functions.php";
  $categoryId=$_GET['categoryId'];
//   $content=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
//   $sql="SELECT p.title ,p.created,p.content,p.views,p.likes,p.feature ,c.`name`,u.nickname,
//   (SELECT COUNT(id)FROM comments WHERE comments.post_id=p.id)as commentCount
//   FROM posts p
//   LEFT JOIN users u ON u.id=p.user_id
//   LEFT JOIN categories c on c.id=p.category_id
//   WHERE p.category_id={$categoryId} 
//   LIMIT 10";
//   $postResult=mysqli_query($content,$sql);
//   $postArr=[];
//   while ($row = mysqli_fetch_assoc($postResult)){
//   $postArr[] = $row;
// } 
$connect= connect();
$sql="SELECT p.title ,p.id,p.created,p.content,p.views,p.likes,p.feature ,c.`name`,u.nickname,
      (SELECT COUNT(id)FROM comments WHERE comments.post_id=p.id)as commentCount
      FROM posts p
      LEFT JOIN users u ON u.id=p.user_id
      LEFT JOIN categories c on c.id=p.category_id
      WHERE p.category_id={$categoryId}
      LIMIT 10";
$postArr=query($connect,$sql);
// print_r($postArr);
// $postArr=fetch($result);
?> 
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="./static/assets/css/style.css">
  <link rel="stylesheet" href="./static/assets/vendors/font-awesome/css/font-awesome.css">
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
        <h3><?= $postArr[0]['name'] ?></h3>
        <?php foreach($postArr as $value) {?>
        <div class="entry">
          <div class="head">
          <!-- 传过去文章的id 参数为 postId  detail.php这边用get方式接收 -->
            <a href="detail.php?postId=<?= $value['id'] ?>"><?= $value['title']?></a>
          </div>
          <div class="main">
            <p class="info"><?= $value['nickname']?> 发表于 <?= $value['created']?></p>
            <p class="brief"><?= $value['content']?></p>
            <p class="extra">
              <span class="reading">阅读(<?= $value['views']?>)</span>
              <span class="comment">评论(<?= $value['commentCount']?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?= $value['likes']?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?= $value['name']?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?= $value['feature']?>" alt="">
            </a>
          </div>
        </div>
        <?php }?>
        <div class="loadmore">
          <span class="btn">
            加载更多
          </span>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src=".\static/assets/vendors/jquery/jquery.js"></script>
  <script>
  //这里利用ajax 来获取_getMorePost.php 这里面的数据
    $(function(){
          //设定当前页码数（初始就是1）
          var currentPage = 1;
          var pageSize = 10;//一次获取多少条数据
        // 给按钮注册点击事件
        $(".loadmore .btn").on("click",function(){
          var categoryId = location.search.split("=")[1];
          //location.获取的是这个数据所有用截取数据等于号分开 location search: "?categoryId=2"
          console.log(location);
          currentPage++;//每次自加一获取不同的数据
          //利用ajax
          $.ajax({
            url:"api/_getMorePost.php",
            type:"POST",
            data:{categoryId:categoryId,currentPage:currentPage,pageSize:pageSize},
            success:function(res){
              console.log(res);
              if(res.code==1){
                var data=res.data;
                $.each(data,function(index,val){
                  // 在js中字符串不能换行 只能用转移\进行转译 
                  // var str='<div class="entry">\
                  //     <div class="head">\
                  //       <a href="javascript:;">'+val['title']+'</a>\
                  //     </div>\
                  //     <div class="main">\
                  //       <p class="info">'+val['nickname']+' 发表于 '+val['created']+'</p>\
                  //       <p class="brief">'+val['content']+'</p>\
                  //       <p class="extra">\
                  //         <span class="reading">阅读('+val['views']+')</span>\
                  //         <span class="comment">评论('+val['coummentCount']+')</span>\
                  //         <a href="javascript:;" class="like">\
                  //           <i class="fa fa-thumbs-up"></i>\
                  //           <span>赞('+val['likes']+')</span>\
                  //         </a>\
                  //         <a href="javascript:;" class="tags">\
                  //           分类：<span>'+val['name']+'</span>\
                  //         </a>\
                  //       </p>\
                  //       <a href="javascript:;" class="thumb">\
                  //         <img src="'+val['feature']+'" alt="">\
                  //       </a>\
                  //     </div>\
                  //     </div>';

                  // 也可以用反撇好 ``把标签包裹起来
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
                      var entry=$(str);
                      //insertBefore(content) 把所有段落插入到一个元素之前。与 $("#foo").before("p")相同。
                      entry.insertBefore('.loadmore');
                });
                //生成结构完毕之后，需要判断一下，这次获取文章数据是不是最后一篇
                //最大的获取次数=ceil()
                var maxPage=Math.ceil(res.totalCount/pageSize);
                // console.log(maxPage);
                //如果点击次数大于等于最大能点击次数，这个案件就会隐藏
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