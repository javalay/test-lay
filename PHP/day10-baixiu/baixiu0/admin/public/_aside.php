<div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/wx.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li class="<?= $current_page =="index"?"active":"" ?>">
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>

    <!-- //这是第二种方法 动态的去获取所需要的字符串 -->
    <?php  
    $str1=strrchr($_SERVER['PHP_SELF'],"/"); //结果是/index.php
    $str2=substr($str1,1); //结果 index.php
    $pos_last=strrpos($str2,'.'); //结果为 5 表示 字符串$str 中最后一次字符'.'所在的位置
    $current_pagee=substr($str2,0,$pos_last); //截取字符串$str2 从0的位置开始截取到$pos_last 位置
    echo $current_page; 
    // $arr=['posts','post-add','categories'];
    ?>

    <!-- //这种方法是通过静态的去每个页面去添加 所需要的字符串，然后再进行判断。这样做会有一定的局限性 -->
      <?php $pageArr=['posts','post-add','categories']; ?>
      <?php $bool=in_array($current_page,$pageArr); ?>

        <a href="#menu-posts" class="<?= $bool?"":"collapse" ?>" data-toggle="collapse" aria-expanded="<?= $bool?"true":"false"?>">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?= $bool?"in":"" ?>" >
          <li class="<?= $current_page =="posts"?"active":""?>"><a href="posts.php" >所有文章</a></li>
          <li class="<?= $current_page =="post-add"?"active":""?>"><a href="post-add.php" >写文章</a></li>
          <li class="<?= $current_page =="categories"?"active":""?>"><a href="categories.php" >分类目录</a></li>
        </ul>
      </li>
      <li class="<?= $current_page =="comments"?"active":""?>">
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li class="<?= $current_page =="users"?"active":""?>">
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
      <?php $pageArr=['nav-menus','slides','settings']; ?>
      <?php $bool=in_array($current_page,$pageArr); ?>
        <a href="#menu-settings" class="<?= $bool?"":"collapse" ?>" data-toggle="collapse" aria-expanded="<?= $bool?"true":"false"?>">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a> 
        <ul id="menu-settings" class="collapse <?= $bool?"in":"" ?>"">
          <li class="<?= $current_page =="nav-menus"?"active":""?>"><a href="nav-menus.php">导航菜单</a></li>
          <li class="<?= $current_page =="slides"?"active":""?>"><a href="slides.php">图片轮播</a></li>
          <li class="<?= $current_page =="settings"?"active":""?>"><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script>
    //使用Ajax 动态请求头像
    $(function(){
        $.ajax({
            url:"api/_getUserAvator.php",
            type:"POST",
            data:{},
            success:function(res){
              // console.log(res);
              if(res.code==1){
                var profile=$(".profile");
                  profile.children("img").attr("src",res.avatar);
                  profile.children("h3").text(res.nickname);
              }
            } 
        });
  </script>