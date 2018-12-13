<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">

  <?php include_once 'public/_navbar.php' ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form id="data-form" class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <option value="1">未分类</option>
              <option value="2">潮生活</option>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <input id="btn-save" class="btn btn-primary" type="button" value="保存" />
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php 
  $current_page = 'post-add';
  ?>
  <?php include_once 'public/_aside.php' ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- 引入富文本插件 -->
  <script src="../static/assets/vendors/ckeditor/ckeditor.js"></script>
  <script>
    $(function(){
      //实现文件的上传功能
      /*
      文件的上传一半不用点击事件，因为点击事件完成的时候，得不到选中的文件
      一般使用change事件，change事件会在表单的值发生改变的时候触发
       */
      $("#feature").on("change", function(){
        //文件的上传
        //获取到要上传的文件，
        //console.log(this)
        var file = this.files[0];
        // console.log(file);
        
        /*
          jquery 是无法直接把文件上传的，需要一个FormData对象来配合着上传在可以
         */
        var data = new FormData();
        // data.append(键，值);
        data.append("file", file);
        $.ajax({
          url : "api/_uploadFile.php",
          type : "POST",
          data :data,
          // 需要配置两个参数，设置jQuery才能把文件带回到服务端
          contentType : false,  //只有设置了这个参数，jquery才会把文件带回到服务端
          processData : false,  //告诉jq不要序列化我们的参数
          success : function(res){
            if( res.code == 1){
              // 把图片预览
              $(".help-block").attr("src",res.src).show();

            }
          }
        });
      });

      /*
        富文本（有格式的文本）

        插件 -- CKEDITOR

        使用富文本插件的步骤：
            1 先引入文件
            2 准备一个文本域，该文本域需要有id
            3 调用插件提供的方法，初始化富文本编辑器
                CKEDITOR.replace("对应文本域的id")
      */
      // 把富文本编辑器初始化的方法
      CKEDITOR.replace("content");

      // 点击保存按钮
      $("#btn-save").on("click", function(){
        //在收集数据之前，得先把富文本编辑器中的内容，更新到文本域当中
        /*
          如果要把编辑器中的内容，更新到对应的文本域里面
          需要调用插件提供的一个方法：编辑器对象.updateElement();
          获取编辑器对象： CDEDITOR.instances.初始化的时候所使用的id
         */
        // console.log(CKEDITOR.instances);
        CKEDITOR.instances.content.updateElement();

        //点击保存按钮收集表单数据，发送回服务端
        var data = $("#data-form").serialize();
        // console.log(data);
        
        // 发送回服务端进行文章的新增操作
        $.ajax({
          url : "api/_addPost.php",
          data :data,
          type : "POST",
          success : function(res){
            console.log(res);
          }
        });
      });

    });
  </script>
</body>
</html>
