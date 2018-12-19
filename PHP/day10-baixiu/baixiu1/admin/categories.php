<?php 
  require_once "../config.php";
  require_once "../functions.php";
  checkLogin();
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
  <script>NProgress.set(0.7)</script>

  <div class="main">
  <?php include_once "./public/_navbar.php" ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none;">
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
              <button id="btn-add"  class="btn btn-primary" type="button">添加</button>
              <button id="btn-edit"class="btn btn-primary"type="button"style="display:none;">编辑完成</button>
              <button id="btn-cancel"class="btn btn-primary"type="button"style="display:none;">取消编辑</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action" style="height: 30px;">
            <!-- show when multiple checked -->
            <a id="delAll"  class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
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
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php 
  //设定当前页面的“代号”，用做判断左侧菜单的打开关闭状态
  // $current_page = 'categories';
  ?>
  <?php include_once "./public/_aside.php" ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $(function(){
      //先定义一个全局变量，--有利于后面功能按钮的获取
      var crow=null;
      //使用ajax 请求获得数据，在来动态生成结构
      $.ajax({
        url:"./api/_getCategoryData.php",
        type:"POST",
        success:function(res){
          console.log(res);
          if(res.code==1){
            //遍历数据数组，生成每一行，添加到表格中即可
            var str="";
            var data=res.data;
            $.each(data,function(i,e){
              str += `<tr data-categoryid="${e.id}">
                <td class="text-center"><input type="checkbox"></td>
                <td>${e.name}</td>
                <td>${e.slug}</td>
                <td>${e.classname}</td>
                <td class="text-center">
                  <a href="javascript:;" data-categoryId="${e.id}" class="btn btn-info btn-xs eidt" data-categoryid="${e.id}">编辑</a>
                  <a href="javascript:;" data-categoryId="${e.id}" class="btn btn-danger btn-xs" >删除</a>
                </td>
              </tr>`;
            });
            $(str).appendTo("tbody");
          }
        }
      });
      //点击添加按钮 添加分类数据
      $("#btn-add").on("click",function(){
        var name =$("#name").val();
        var slug=$("#slug").val();
        var classname = $('#classname').val();
        if(name==""){
          $('#msg').text('分类名称不能为空');
          $(".alert").show();
          return;
        }
        if(slug==""){
          $('#msg').text('分类别名不能为空');
          $(".alert").show();
          return;
        }
        if(classname==""){
          $('#msg').text('分类类名不能为空');
          $(".alert").show();
          return;
        }
        $.ajax({
          url:'api/_addCategory.php',
          data:$('#data').serialize(),
          type:'POST',
          success:function(res){
            // console.log(res);
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
              $("#name").val("");
              $("#slug").val("");
              $('#classname').val("");
            }
            else{
              $(".alert").show();
              $('#msg').text(res.msg);
            }
          }
        });
      });
      //利用事件委托----编辑代码
      $("tbody").on('click','.eidt',function(){

        // 显示和隐藏相关按钮
        $("#btn").hide();
        $("#btn-edit").show();
        $("#btn-cancel").show();
        // 来获取当前所要编辑的tr
        crow=$(this).parents('tr');
        //获取相关文本
        var name=crow.children().eq(1).text();
        var slug=crow.children().eq(2).text();
        var classname=crow.children().eq(3).text();
        // 把数据渲染到操作栏中
        $("#name").val(name);
        $("#slug").val(slug);
        $("#classname").val(classname);
      });
      //编辑完成功能
      $("#btn-edit").on("click",function(){
        // 先获取当前所要操作的tr中的id---有助于后期修改和数据库储存
        var id=crow.attr('data-categoryid');
        //获取当前修改后的输入框中的数据
        var name=$("#name").val();
        var slug=$("#slug").val();
        var classname=$("#classname").val();
        // console.log(name);
        //判断输入框的数据是否为空，然后对其进行相关提示操作
        if(name==""){
          $("#alert").show();
          $("#msg").text("分类名称不能为空");
        }
        if(slug==""){
          $("#alert").show();
          $("#msg").text("分类别名不能为空");
        }
        if(classname==""){
          $("#alert").show();
          $("#msg").text("分类类名不能为空");
        }
        //通过ajax发请求，对数据库操作
        $.ajax({
          url:'./api/_updateCategory.php',  
          data:{name:name,slug:slug,classname:classname,id:id},
          type:"POST",
          success:function(res){
            if(res.code==1){
              var name=$("#name").val();
              var slug=$("#slug").val();
              var classname=$("#classname").val();

               //显示和隐藏相关按钮
            $("#btn-add").show();
            $("#btn-edit").hide();
            $("#btn-cancel").hide();
            
            //把'修改后的数据渲染到显示框中
            crow.children().eq(1).text(name);
            crow.children().eq(2).text(slug);
            crow.children().eq(3).text(classname);

            //清空修改框
            $("#name").val("");
            $("#slug").val("");
            $("#classname").val("");

            }
          }
        });
      });
      //取消编辑功能
      $("#btn-cancel").on('click',function(){
            //显示和隐藏相关按钮
            $("#btn-add").show();
            $("#btn-edit").hide();
            $("#btn-cancel").hide();


            //清空修改框
            $("#name").val("");
            $("#slug").val("");
            $("#classname").val("");

      });
      //删除功能
      $("tbody").on('click','.btn-danger',function(){
        // console.log(111);
        crow=$(this).parents('tr');
        var id=$(this).attr('data-categoryId');
        $.ajax({
          url:'./api/_delCategory.php',
          data:{'id':id},
          type:"POST",
          success:function(res){
            if(res.code==1){
              crow.remove();
            }
          }
        });
      });
      //  全选功能的实现
      $("thead input").on('click',function(){
        var state= $(this).prop("checked");
        $("tbody input").prop("checked",state);
        if(state){
          $("#delAll").show();
        }
        else{
          $("#delAll").hide();
        }
      });
      // 多选按钮的全选功能---这里要用事件委托的方式，因为这是动态添加的元素
      $("tbody").on('click','input',function(){
        // console.log(222);
       var all= $("thead input");
       var cks=$("tbody input");
       //如果 下面选中按钮的个数等于当前所有的tbody input 中的个数，那么全选按钮就为true
       if(cks.size()==$("tbody input:checked").size()){
         all.prop("checked",true);
       }
       else{
        all.prop("checked",false);
       }
       //如果下面选中按钮大于等于2时 就把批量删除按钮显示，小于则隐藏
       if($('tbody input:checked').size()>=2){
         $("#delAll").show();
       }
       else{
         $("#delAll").hide();
       }
      }); 
      //批量删除功能
      $("#delAll").on('click',function(){
        var dels=[];
        var cks=$('tbody input:checked');
        cks.each(function(index,el){
          var id=$(el).parents('tr').attr('data-categoryId');
          dels.push(id);
        });
        // console.log(dels);
        $.ajax({
          url:'./api/_delCategories.php',
          type:'POST',
          data:{dels:dels},
          success:function(res){
            cks.parents('tr').remove();
          }
        });
      });
    });
  </script>
</body> 
</html>
   