  <div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li class="<?php echo $current_page == 'index' ? 'active' : ''; ?>">
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <?php 
        $pageArr = ['posts','post-add','categories'];
        $bool = in_array($current_page, $pageArr);
        ?>
        <!-- 关闭状态：<a href="#menu-posts" data-toggle="collapse" class="collapsed"> 下一行是打开状态-->
        <a href="#menu-posts" data-toggle="collapse" class="<?php echo $bool ? '' : 'collapsed'; ?>" <?php echo $bool ? 'aria-expanded="true"' : ''; ?>>
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <!-- 关闭状态：<ul id="menu-posts" class="collapse">  下一行是打开状态-->
        <ul id="menu-posts" class="collapse <?php echo $bool ? 'in' : ''; ?>" <?php echo $bool ? 'aria-expanded="true"' : ''; ?>>
          <li class="<?php echo $current_page == 'posts' ? 'active' : ''; ?>"><a href="posts.php">所有文章</a></li>
          <li class="<?php echo $current_page == 'post-add' ? 'active' : ''; ?>"><a href="post-add.php">写文章</a></li>
          <li class="<?php echo $current_page == 'categories' ? 'active' : ''; ?>"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li class="<?php echo $current_page == 'comments' ? 'active' : ''; ?>">
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li class="<?php echo $current_page == 'users' ? 'active' : ''; ?>">
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <?php 
        $pageArr = ['nav-menus','slides','settings'];
        $bool = in_array($current_page, $pageArr);
        ?>
        <!-- <a href="#menu-settings" class="collapsed" data-toggle="collapse"> -->
        <a href="#menu-settings" data-toggle="collapse" class="<?php echo $bool ? '' : 'collapsed'; ?>" <?php echo $bool ? 'aria-expanded="true"' : ''; ?>>
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <!-- <ul id="menu-settings" class="collapse"> -->
        <ul id="menu-settings" class="collapse <?php echo $bool ? 'in' : ''; ?>" <?php echo $bool ? 'aria-expanded="true"' : ''; ?>>
          <li class="<?php echo $current_page == 'nav-menus' ? 'active' : ''; ?>"><a href="nav-menus.php">导航菜单</a></li>
          <li class="<?php echo $current_page == 'slides' ? 'active' : ''; ?>"><a href="slides.php">图片轮播</a></li>
          <li class="<?php echo $current_page == 'settings' ? 'active' : ''; ?>"><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>

<script src="../static/assets/vendors/jquery/jquery.js"></script>
<script>
  $(function(){
    //使用ajax请求，动态获取用户头像和名称
    $.ajax({
      type : "POST",
      url : "api/_getUserAvatar.php",
      data : {},
      success : function(res){
        // 从服务器端获得结果后再生成头像和名称
        if( res.code == 1){
          var profile = $(".profile");
          profile.children("img").attr('src', res.avatar);
          profile.children("h3").text(res.nickname);
        }
      }
    });
  });
</script>