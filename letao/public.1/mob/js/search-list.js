$(function () {
    //获取地址栏中 用户输入的关键字--放在全局中方便获取
    var urlInfo = getParamsByUrl("key");
    var page = 1;
    var html = "";
    var priceSort = 1;
    // 这里储存this的指向，变为全局变量
    var that = null;
    //调用函数
    //调用mui框架 ，下拉刷新---会自调用 getData 函数。
    mui.init({
        pullRefresh: {
            container: '#refreshContainer', //待刷新区域标识，querySelector能定位的css选择器均可，比如：id、.class等
            up: {
                height: 50, //可选.默认50.触发上拉加载拖动距离
                auto: true, //可选,默认false.自动上拉加载一次
                contentrefresh: "正在加载...", //可选，正在加载状态时，上拉加载控件上显示的标题内容
                contentnomore: '没有更多数据了', //可选，请求完毕若没有更多数据时显示的提醒内容；
                callback: getData //必选，刷新函数，根据具体业务来编写，比如通过ajax从服务器获取新数据；
                // callback  页面一上来就会加载这个数据
            }
        }
    });
    // getData();
    //价格按钮添加轻敲事件
    $("#priceSort").on('tap', function () {
        //更改价格排序条件
        priceSort = priceSort == 1 ? 2 : 1;
        page = 1;
        html = "";
        mui('#refreshContainer').pullRefresh().enablePullupToRefresh();
        getData();
    });
    //封装一个 获取地址栏相关信息的函数
    function getParamsByUrl(name) {
        //获取地址栏的 数据
        console.log(location);
        var str = location.search;
        console.log(str); //?key=11&name=324
        //下面对地址栏的数据进行分割 从？问号开始分割
        var param = str.substr(str.indexOf('?') + 1);
        console.log(param); //key=11&name=324
        //在从 &开始分割
        var params = param.split('&');
        console.log(params); // ["key=11", "name=324"]
        for (var i = 0; i < params.length; i++) {
            var current = params[i].split('=');
            console.log(current); // ["key", "11"]
            if (current[0] == name) {
                return current[1];
            } else {
                return null;
            }
        }
    }
    function getData() {
        //如果这个的that没有赋值 就是true 开始赋值刚开始第一次调用时的this 指向。 
        // 后期调用这个this就不会发生改变
        if (!that) {
            that = this;
            console.log(that);
        }
        $.ajax({
            type: "GET",
            url: "/product/queryProduct",
            data: {
                page: page++, //每次调用函数都会自加， 页数都会加1 
                pageSize: 3,//每次返回几条数据回来
                proName: urlInfo, //地址栏中获取的数据
                price: priceSort // 升序还是降序的排列方式 1为升序 2 为降序
            },
            success: function (response) {
                // console.log(response);
                // console.log(response.data[0]);
                // console.log(response.data[0].pic[0]);
                // console.log(response.data[0].pic[0].picAddr);
                if (response.data.length > 0) {
                    //利用模板引擎 添加页面结构 
                    html += template("searchTpl", response);

                    // var html =template("searchTpl",response);
                    $("#searchTpll").html(html);
                    //  appendTo 方法最佳元素
                    //    $("#searchTpll").appendTo($(html));


                    //1、加载完新数据后，必须执行如下代码，true表示没有更多数据了：
                    //2、若为ajax请求，则需将如下代码放置在处理完ajax响应数据之后
                    that.endPullupToRefresh(false);
                } else {
                    that.endPullupToRefresh(true);
                }
            }
        });
    }
});