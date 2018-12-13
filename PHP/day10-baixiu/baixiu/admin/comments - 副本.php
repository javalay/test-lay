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

  <?php include_once 'public/_navbar.php' ?>

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
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
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
          <!-- <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>

  <?php 
  $current_page = 'comments';
  ?>
  <?php include_once 'public/_aside.php' ?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- 引入分页的插件 -->
  <script src="../static/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
   <!-- 引入模板 -->
   <script src="../static/assets/vendors/art-template/template-web.js"></script>
  <!-- 
    模板引擎
        插件： 用于动态生成页面结构

        art-template

        1 引入插件
        2 建立模板
        3 导入数据
        4 生成结构
   -->
   <!-- 
      模板引擎使用script标签作为模板的载体
      引入如果script标签的type属性不是Javascript的时候，是不会执行的
      模板引擎就可以根据script的id，将其作为模板，生成页面结构
      直接把想要生成的结构放到模板载体当中

      模板的使用：
        
        <div>{{$data}}</div>

        遍历的语法

        {{each $data 值 间}}
          <div>{{值.属性}}</div>
        {{/each}}

        判断语法

        {{if 条件}}
          条件成立的逻辑
        {{/if}}

        {{if 条件}}
          条件成立的逻辑
        {{else if 条件}}
          另外一个条件成立的逻辑
        {{/if}}
    -->
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
  <script>
      // var data = {name : "张三", age : 16};
      // var data = [
      //     {name : "张三", age : 16},
      //     {name : "李四", age : 17},
      //     {name : "王五", age : 18},
      // ];

      /*
        演示模板引擎的使用方式
       */
      // 给模板导入数据
      // 调用插件提供的方法
      // template("模板的id", 数据)
      // var html = template("template", data);
      // console.log(html);
      // $(".page-title").append(html);
  </script>

  <script>
    $(function(){
      //声明变量表示当前是第几页，以及 每页取多少条数据
      var currentPage = 1;
      var pageSize = 10;
      var pageCount ;

      //一开始就加载一次数据
      getCommentsData();
      function getCommentsData(){
        // 使用模板引擎的方式完成表格是数据展示
        $.ajax({
          url : "api/_getCommentsData.php",
          type : "POST",
          data : {currentPage : currentPage, pageSize : pageSize},
          success : function(res){
            if(res.code == 1){
              // 更新一下pageCount
              pageCount = res.pageCount;
              //使用模板引擎生成结构
              // 导入模板的数据结构
              var html = template("template",res.data);
              $("tbody").html(html);

              /*
                完成分页效果

                  插件：
                    1 先引入插件  twbs-pagination
                    2 使用样式，可以是bootstrap提供的样式，也可以是自己的样式
                    3 要有一个可以调用函数的标签 可以ul，也可以是div
                    4 调用 twbsPagination 完成分页效果
              */
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

      // 一开始就加载数据， 分页显示
      // $.ajax({
      //   url : "api/_getCommentsData.php",
      //   type : "POST",
      //   data : {currentPage : currentPage, pageSize : pageSize},
      //   success : function(res){
      //     if(res.code == 1){
      //       var data = res.data;
      //       //遍历数组，生成结构
      //       $.each(data, function(i, e){
      //         var html = `<tr class="danger">
      //             <td class="text-center"><input type="checkbox"></td>
      //             <td>${e.author}</td>
      //             <td>${e.content}</td>
      //             <td>${e.title}</td>
      //             <td>${e.created}</td>
      //             <td>${e.status}</td>
      //             <td class="text-center">
      //               <a href="post-add.php" class="btn btn-info btn-xs">批准</a>
      //               <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      //             </td>
      //           </tr>`;
      //         $(html).appendTo("tbody");
      //       });
      //     }
      //   }
      // });
      
    });
  </script>
</body>
</html>
