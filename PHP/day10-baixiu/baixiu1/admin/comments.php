<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
  <?php include_once "./public/_navbar.php" ?>

    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
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
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
  <?php include_once "./public/_aside.php" ?>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
    <!-- 引入分页的插件 -->
    <script src="../static/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
   <!-- 引入模板 -->
   <script src="../static/assets/vendors/art-template/template-web.js"></script>
   <script id="template" type="text/art-template">
    {{each $data val}}
      <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td>{{val.author}}</td>
        <td style="width:400px;">{{val.content}}</td>
        <td>{{val.title}}</td>
        <td>{{val.created}}</td>
        <td>
          {{if val.status == "held"}}
            未审核
          {{else if val.status == "approved"}}
            已准许
          {{else if val.status == "rejected"}}
            已拒绝
          {{else if val.status == "trashed"}}
            已删除
          {{/if}}
        </td>
        <td class="text-center">
          <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
    {{/each}}
  </script>
  <!-- 这是具体的写法，引入的文件过多代码看起来会比较臃肿-一般会使用模块化工具的方法 -->
  <script>
  $(function(){
    //声明变量表示当前是第几页，以及 每页取多少条数据
    var currentPage = 1;
    var pageSize = 10;
    var pageCount ;
    getCommentsData();
    //封装函数，调用ajax
    function getCommentsData(){
      $.ajax({
        type: "POST",
        url: "api/_getCommentsData.php",
        data:{currentPage:currentPage,pageSize:pageSize},
        success: function (res) {
          if(res.code==1){
            var data=res.data;
            console.log(data);
            pageCount = res.pageCount;
            var html = template("template",data);
            $("tbody").html(html);
            //这是在调用页码的插件 先引用文件，在调用相应的函数，有两个参数，
            $(".pagination").twbsPagination({
                totalPages: pageCount, //最大的页码数
                visiblePages: 7, // 总共显示多少个分页按钮
                onPageClick: function (event, page){  // 点击每个按钮的时候执行的操作
                  //回调函数有两个参数，第一个是事件对象，第二个是当前的页码数
                  currentPage = page;
                  //每次点击分页的按钮，也要获取数据
                  getCommentsData();
                }
            });
          }
        }
      });
    }
  });
  </script>
  <!-- 这是引入模块化管理工具--requirejs 后面要添加一个自带的属性值data-main -->
   <script src="../static/assets/vendors/require/require.js" data-main="../static/assets/js/comments.js"></script>
</body>
</html>
