<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select id="category" name="" class="form-control input-sm">
            <option value="all">所有分类</option>
          </select>
          <select id="status" name="" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">已删除</option>
          </select>
          <!-- <button id="btn-filt" class="btn btn-default btn-sm">筛选</button> -->
          <input type="button" id="btn-filt" class="btn btn-default btn-sm" value="筛选" />
        </form>
        <ul class="pagination pagination-sm pull-right">
          <!-- <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li> -->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  <?php 
  //设定当前页面的“代号”，用做判断左侧菜单的打开关闭状态
  $current_page = 'posts';
  ?>
  <?php include_once 'public/_aside.php' ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>

    //使用变量保存每一页获取多少条数据
    var pageSize = 10;
    

    //声明一个变量，记录当前是第几页数据
    var currentPage = 1;
    //最大页码数 = Math.ceil( 文章的数据的总量 / 每一页获取的数据的条数 );
    var pageCount = 4;  //先假设就4页

    //封装为生成分页按钮的函数
    function makePageButton(){
      //根据当前页码计算出开始的页码和结束的页码
      //开始页码 = 当前页码 - 2
      var start = currentPage - 2;
      // 如果开始页码数小于1的，强制从1开始
      if( start < 1){
        start = 1;
      }
      //结束页码 = 开始页码 + 4
      var end = start + 4;
      //如果结束的页码数超过的页码总数，特殊处理：
      if( end > pageCount ){
        end = pageCount;
      }

      /*
      动态生成分页结构
       */
      var html = "";
      if(currentPage != 1){
        html += '<li class="item" data-page="' + (currentPage-1) + '"><a href="javascript:;">上一页</a></li>';
      }
      for(var i = start; i <= end; i++){
        if( i == currentPage){
          html += '<li class="item active" data-page="' + i + '"><a href="javascript:;">' + i + '</a></li>';
        }
        else{
          html += '<li class="item" data-page="' + i + '"><a href="javascript:;">' + i + '</a></li>';
        }
        
      }
      if( currentPage < pageCount ){
        html += '<li class="item" data-page="' + (currentPage+1) + '"><a href="javascript:;">下一页</a></li>';
      }
      
      $(".pagination").html(html);
    }

    //封装表格的渲染功能
    function makeTable(data){
      //遍历数组重新生成表格结构
      $.each(data, function(index, val){
        var str = `<tr>
          <td class="text-center"><input type="checkbox"></td>
          <td>${val.title}</td>
          <td>${val.nickname}</td>
          <td>${val.name}</td>
          <td class="text-center">${val.created}</td>
          <td class="text-center">${statusData[val.status]}</td>
          <td class="text-center">
            <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
            <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
          </td>
        </tr>`;
        $(str).appendTo("tbody");
      });
    }

    /*
    1 请求后台，把文章数据请求出来，动态地渲染表格数据
     */
    var statusData = {
      drafted : '草稿',
      published : '已发布',
      trashed : '已作废'
    }
    $(function(){
      // 第一次请求， 把数据请求回来，动态生成表格
      $.ajax({
        url : "api/_getPostsData.php",
        type : "POST",
        data : {currentPage: currentPage, pageSize : pageSize, status: $("#status").val(), categoryId:$("#category").val()},
        success : function(res){
          if( res.code == 1 ){
            // 还要计算出页码的最大值
            pageCount = res.pageCount;
            // 生成分页结构
            makePageButton();

            //遍历数组生成新的元素之前，先把原有的内容清空
            $("tbody").empty();
            var data = res.data;
            makeTable(data);

          }
        }
      });

      /*
      使用委托的方式给每个分页按钮注册点击事件
       */
      $(".pagination").on("click",".item", function(){
        //根据当前的页码获取数据
        currentPage = parseInt($(this).attr("data-page"));
        //根据当前页到服务器请求数据
        $.ajax({
          url : "api/_getPostsData.php",
          type : 'POST',
          data : {currentPage: currentPage, pageSize : pageSize, status: $("#status").val(), categoryId:$("#category").val()},
          success : function(res){
            //成功就进行数据更新
            if( res.code == 1 ){
              // 重新设置页码的最大值
              pageCount = res.pageCount;
              // 要重新生成分页结构
              makePageButton();

              //遍历数组生成新的元素之前，先把原有的内容清空
              $("tbody").empty();
              var data = res.data;
              makeTable(data);
            }
          }
        });
      });

      /*
      先加载所有的分类数据
      */
      $.ajax({
        url : "api/_getCategoryData.php",
        type : "POST",
        success : function(res){
          if( res.code == 1){
            // 遍历数组，生成多个下拉选项，追加到下拉框里面
            var data = res.data;
            $.each(data, function(i, e){
              var html = '<option value="' + e.id+ '">' + e.name +'</option>';
              $(html).appendTo("#category");
            });
          }
        }
      });

      /*
      点击筛选功能
       */
      $("#btn-filt").on("click", function(){
        //点击筛选的时候，先得到状态是什么
        var status = $("#status").val();
        var categoryId = $("#category").val();
        // 把条件待会服务器请求数据
        $.ajax({
          url : "api/_getPostsData.php",
          type : "POST",
          data : {currentPage: currentPage, pageSize: pageSize, status: status, categoryId:categoryId},
          success : function(res){
            console.log(res);
            //再次生成表格
            if(res.code == 1){
              //遍历数组生成新的元素之前，先把原有的内容清空
              $("tbody").empty();
              var data = res.data;
              makeTable(data);
            }
          }
        });
      });


    });
  </script>
</body>
</html>
