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

  <?php $current_page = 'comments';?>
  <?php include_once 'public/_aside.php' ?>
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

  <!-- 
    如果一个页面会引入非常多的外部js文件来实现功能，
    会导致该页面看起来既复杂又混乱

    解决方案：模块化
      模块化： 
      就是让每个功能相互独立，当我们需要使用某个功能的时候，直接拿过来使用
  
      每个js就是一个模块
      每个js也可以分成多个模块
      一个功能就是一个模块

    推荐使用模块化工具

      requirejs - 用来实现模块化的工具

      使用步骤
        1 引入requirejs文件
        2 设置data-main属性
          该值是一个js文件的路径
          data-main属性的作用：可以设置该模块的入口文件（声明不同的模块，实现业务代码）
        3 在入口文件中，实现模块的声明以及功能的代码

   -->

   <script src="../static/assets/vendors/require/require.js" data-main="../static/assets/js/comments.js"></script>

</body>
</html>
