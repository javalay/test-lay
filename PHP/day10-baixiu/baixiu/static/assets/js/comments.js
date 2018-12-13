/*
	这就是该模块的入口文件
*/

// 1 配置模块
// require.config({});
require.config({
	// 1.1 声明模块
	// 一共要声明的模块有： jquery, 模板引擎, 分页插件, bootstrap
	paths : {//作用：声明每个模块的名称和每个模块对应的路径
		//模块的名字 ： 模块对应的js的路径 - 注意路径是不带后缀名的
		"jquery" : "/static/assets/vendors/jquery/jquery",
		"template" : "/static/assets/vendors/art-template/template-web",
		"pagination" : "/static/assets/vendors/twbs-pagination/jquery.twbsPagination",
		"bootstrap" : "/static/assets/vendors/bootstrap/js/bootstrap",

	},
	// 1.2 声明模块和模块之间的依赖关系
	shim : {
		//模块名称
		"pagination" : {
			// deps : 声明该模块是依赖哪些模块的
			deps : ["jquery"] // 因为依赖的模块可能有多个，以数组的方式表示
		},
		"bootstrap" : {
			deps : ["jquery"]
		}
	}
});

// 2 引入模块
// 使用 requirejs 提供的一个函数来实现
// require(模块数组， 实现功能的回调函数)
// 模块数组中的每个模块的名字是从 paths声明的时候那里直接得到的
require(["jquery","template","pagination","bootstrap"], function($, template, pagination, bootstrap){
// 3 在回调函数中实现功能
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
    });
});
