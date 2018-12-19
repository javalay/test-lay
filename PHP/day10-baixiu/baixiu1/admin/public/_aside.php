<div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/wx.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li class="<?= $current_page=='index'?'active':"" ?>">
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <?php 
            $str1=strrchr($_SERVER['PHP_SELF'],"/");
            $str2=substr($str1,1);
            $pos_last=strrpos($str2,'.');
            $current_page=substr($str2,0,$pos_last);
            // echo $current_page;
        ?>
        <?php 
            $pageArr=['posts','post-add','categories'];
            $bool=in_array($current_page,$pageArr);
        ?>
        <a href="#menu-posts" class="<?= $bool?"":"collapse" ?>" data-toggle="collapse" aria-expanded="<?= $bool?"true":"false" ?>">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?= $bool?"in":"" ?>"">
          <li class="<?= $current_page=='posts'?'active':"" ?>" ><a href="posts.php">所有文章</a></li>
          <li class="<?= $current_page=='post-add'?'active':"" ?>" ><a href="post-add.php">写文章</a></li>
          <li class="<?= $current_page=='categories'?'active':"" ?>" ><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li class="<?= $current_page=='comments'?'active':"" ?>" >
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>     
      <li class="<?= $current_page=='users'?'active':"" ?>" >
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
      <?php $pageArr=['nav-menus','slides','settings']; ?>
      <?php $bool=in_array($current_page,$pageArr); ?>
        <a href="#menu-settings" class="<?= $bool?"":"collapse" ?>" data-toggle="collapse" aria-expanded="<?= $bool?"true":"false" ?>">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?= $bool?"in":"" ?>">
          <li class="<?= $current_page=='nav-menus'?'active':"" ?>" ><a href="nav-menus.php">导航菜单</a></li>
          <li class="<?= $current_page=='slides'?'active':"" ?>" ><a href="slides.php">图片轮播</a></li>
          <li class="<?= $current_page=='settings'?'active':"" ?>" ><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script>
      $(function(){
          console.log(111);
          $.ajax({
              url:'./api/_getUserAvator.php',
              data:{},
              type:"POST",
              success:function(res){
                  console.log(res);
                  if(res.code==1){
                   var profile=$(".profile");
                   profile.children("img").attr("src",res.avatar);
                   profile.children("h3").text(res.nickname);
                  }
              }
          });
      });
  </script>

    <!-- <script> 
    window.onload = function() {
      var href1 = location.href;
      console.log(href1);
      $(".nav li").each(function(index, val) {
        var href2 = $(val).attr("href");
        if(href1.indexOf(href2) >= 0) {
          $(this).parent().addClass("active");
        }
      });
    }
  </script> -->