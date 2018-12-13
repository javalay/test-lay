<?php 

  require_once '../config.php';
  require_once '../functions.php';
  //调用已经封装好的checkLogin验证是否已经登录
  checkLogin();

  /*
  
  使用 ajax 请求，获得数据，再来动态生成结构即可
   */

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
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
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display: none;">
        <strong>错误！</strong><span id="msg"></span>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form id="data">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="slug">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
              <p class="help-block"><strong></strong></p>
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
              <button id="btn-add" class="btn btn-primary" type="button">添加</button>
              <button id="btn-edit" class="btn btn-primary" type="button" style="display: none;">编辑完成</button>
              <button id="btn-cancel" class="btn btn-primary" type="button" style="display: none;">取消编辑</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action" style="height: 30px;">
            <!-- show when multiple checked -->
            <a id="delAll" class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
             <!--  <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td>fa-fire</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php 
  $current_page = 'categories';
  ?>
  <?php include_once 'public/_aside.php' ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>

  /*
  
  使用 ajax 请求，获得数据，再来动态生成结构即可
   */
  // 定义一个全部变量，来保存当前编辑的行
  var currentRow = null;
  $(function(){
      //在页面加载完毕后，就要展示数据，一开始就要获取数据
      $.ajax({
        type : "POST",
        url : "api/_getCategoryData.php",
        success : function(res){
          //请求成功之后，把数据动态地渲染出来
          if(res.code == 1){
              //遍历数据数组，生成每一行，添加到表格中即可
              var str = "";
              var data = res.data;
              $.each(data, function(i, e){
                  str += `<tr data-categoryid="${e.id}">
                <td class="text-center"><input type="checkbox"></td>
                <td>${e.name}</td>
                <td>${e.slug}</td>
                <td>${e.classname}</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs edit" data-categoryid="${e.id}">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
                </td>
              </tr>`;
              });
              $(str).appendTo("tbody");
          }
        }
      });

      //点击添加按钮添加分类数据
      $("#btn-add").on("click",function(){
        // 1 收集表单数据 - 验证表单数据是否添加完整
        var name = $("#name").val();
        var slug = $("#slug").val();
        var classname = $("#classname").val();
        // 如果数据填写不完整，就提示用户要填写完整才能添加
        if( name == ""){
          $("#msg").text("分类名称不能为空");
          $(".alert").show();
          return ;
        }
        if( slug == ""){
          $("#msg").text("分类别名不能为空");
          $(".alert").show();
          return ;
        }
        if( classname == ""){
          $("#msg").text("分类的类名不能为空");
          $(".alert").show();
          return ;
        }

        // 2 发送到服务器端进行添加
        $.ajax({
          url : "api/_addCategory.php",
          data : $("#data").serialize(),
          type : "POST",
          success : function(res){
            //根据返回的结果，动态生成一行数据追加到表格的末尾即可
            if( res.code == 1){
              //  返回成功，则动态更新表格结构（添加一行）
              var str = "";
              str += `<tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>${name}</td>
                <td>${slug}</td>
                <td>${classname}</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs edit">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>`;
              $(str).appendTo("tbody");
            }
          }
        });
      });

      // 实现 分类信息的编辑功能
      // 先对“编辑”进行事件委托
      $("tbody").on("click",".edit", function(){
          //在这里完成编辑的逻辑
          //先将添加按钮隐藏，编辑完成和取消编辑显示出来
          $("#btn-add").hide();
          $("#btn-edit").show();
          $("#btn-cancel").show();

          //将当期行的分类id，放置到 “编辑完成” 按钮上
          var categoryid = $(this).attr("data-categoryid");
          $("#btn-edit").attr("data-categoryid", categoryid);
          currentRow = $(this).parents("tr");  //当前编辑的行

          // 把点击的编辑按钮对应行的数据 填充到对应的输入框
          var name = $(this).parents("tr").children().eq(1).text();
          var slug = $(this).parents("tr").children().eq(2).text();
          var classname = $(this).parents("tr").children().eq(3).text();
          // 把获取到的内容填充到对应的输入框
          $("#name").val(name);
          $("#slug").val(slug);
          $("#classname").val(classname);
      });

      // 编辑完成 按钮的点击事件
      $("#btn-edit").on("click", function(){
        //把表单中的数据更新到数据库中
        var categoryid = $(this).attr("data-categoryid");

        // 1 收集表单数据 - 验证表单数据是否添加完整
        var name = $("#name").val();
        var slug = $("#slug").val();
        var classname = $("#classname").val();
        // 如果数据填写不完整，就提示用户要填写完整才能添加
        if( name == ""){
          $("#msg").text("分类名称不能为空");
          $(".alert").show();
          return ;
        }
        if( slug == ""){
          $("#msg").text("分类别名不能为空");
          $(".alert").show();
          return ;
        }
        if( classname == ""){
          $("#msg").text("分类的类名不能为空");
          $(".alert").show();
          return ;
        }

          //然后，通过ajax把id和修改后的数据，发送到服务器，根据id数据进行更新
          $.ajax({
            url : "api/_updateCategory.php",
            type : "POST",
            data : {name : name, slug : slug, classname : classname, id : categoryid},
            success : function(res){
              //如果修改成功，
              if( res.code == 1 ){
                // 要把两个编辑按钮隐藏，把添加按钮显示
                $("#btn-edit").hide();
                $("#btn-cancel").hide();
                $("#btn-add").show();

                // 清空之前先保存之前修改之后的内容
                var name = $("#name").val();
                var slug = $("#slug").val();
                var classname = $("#classname").val();

                // 清空输入框
                $("#name").val("");
                $("#slug").val("");
                $("#classname").val("");

                // 把对应的数据更新到表格中
                currentRow.children().eq(1).text(name);
                currentRow.children().eq(2).text(slug);
                currentRow.children().eq(3).text(classname);
              }
            }
          });
      });

      // 取消编辑的按钮功能：
      $("#btn-cancel").on("click", function(){
        // 把对应的按钮显示和隐藏
        $("#btn-edit").hide();
        $("#btn-cancel").hide();
        $("#btn-add").show();
        
        // 清空输入框
        $("#name").val("");
        $("#slug").val("");
        $("#classname").val("");
      });

      // 点击删除按钮，删除数据
      $("tbody").on("click", ".del", function(){
        //先把当前点击的行记录下来，当删除成功的时候，我们就把这一行删除掉
        var row = $(this).parents("tr");
        //根据当前点击的按钮对应的行，得到对应的id，在数据库中删除数据
        //先获取要删除的数据的id
        var categoryid = row.attr("data-categoryid");
        //把要删除的id发送给服务器
        $.ajax({
          type : "POST",
          url : "api/_delCategory.php",
          data : {id: categoryid},
          success : function(res) {
            //删除成功，就把对应的行移除掉
            if( res.code == 1){
                row.remove();
            }
          }
        });
      });

      // 全选功能的实现
      $("thead input").on("click", function(){
         //控制别的多选框跟我当前的选中状态一样
         //先获取自己的选中状态
         var status = $(this).prop("checked");
         //控制的别的多选框
         $("tbody input").prop("checked", status);
         //控制“批量删除”按钮的显示隐藏
         if(status){
            $("#delAll").show();
         }
         else{
            $("#delAll").hide();
         }
      });

      //用委托的方式为别的多选框注册点击事件
      $("tbody").on("click", "input", function(){
        //控制全选的多选框是否选中，只有当所有的多选框都选中，全选才选中
        //获取全选多选框
        var all = $("thead input");
        var cks = $("tbody input");
        // if(cks.size() == $("tbody input:checked").size() ){
        //   all.prop("checked", true);
        // }
        // else{
        //   all.prop("checked", false);
        // }
        all.prop("checked", cks.size() == $("tbody input:checked").size());

         //控制“批量删除”按钮的显示隐藏：只要选中的数目超过两个，就显示
         if($("tbody input:checked").size() >= 2){
            $("#delAll").show();
         }
         else{
            $("#delAll").hide();
         }
      });

      //点击批量删除按钮删除数据
      $("#delAll").on("click", function(){
        //准备好收集多个id的数组
        var ids = [];
        // 收集所有选中的id，发送到服务器进行数据的删除
        var cks = $("tbody input:checked");
        //遍历伪数组，找到所有被选中的id
        cks.each(function(index, el){
          var id = $(el).parents("tr").attr("data-categoryid");
          ids.push(id);
        });
        // console.log(ids);
        // 把数据发送回服务器，删除数据
        $.ajax({
          url : "api/_delCategories.php",
          type : "POST",
          data : {ids: ids},
          success : function(res){
            //如果删除成功了，要把对应的行也移除掉
            if(res.code == 1){
              cks.parents("tr").remove();
            }
          }
        });
      });
  });
  </script>
</body>
</html>
