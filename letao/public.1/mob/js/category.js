$(function () {
    //初始化区域滚动
    mui('.mui-scroll-wrapper').scroll({
        decelertion: 0.0005
    });
    //调用Ajax调用数据库的数据
    $.ajax({
        type: "GET",
        url: "/category/queryTopCategory",
        data: {},
        success: function (res) {
            //使用模板引擎
            console.log(res);
            //将数据和html做拼接
            // result 相当于这个数组，可以在模板那边去拼接调用
            var html = template("cate-template-first", {result: res.rows});
            $(".category-left ul").html(html);
            $('.category-left ul ').find('li:first-child').addClass('active');
            if (res.rows.length > 0) {
                var id = res.rows[0].id;
                getTowCategory(id);
            }
        }
    });
    $(".category-left ul").on("click", "li", function () {
        $(this).addClass('active').siblings().removeClass('active');
        //获取当前点击一级分类的ID
        //在设置自定义属性的时候 要以data-　开头　然后调用id的时候要data("-后面的属性")
        var id = $(this).data('id');
        // var id=$(this).attr("data-id");
        getTowCategory(id);
    });

});
function getTowCategory(id){
    $.ajax({
        type: "GET",
        url: "/category/querySecondCategory",
        data: {
            id: id
        },
        success: function (res) {
            console.log(res.rows.length);
            // var html=template("cate-template-tow",{result: res.rows[1]});
            // $(".category-right ul").html(html);
            // if (res.rows.length > 0) {
                var html = template("cate-template-tow", {
                    result: res.rows
                });
                $(".category-right ul").html(html)
            // } 
            // else {
            //     $(".category-right ul").html("无数据");
            // }

        }
    });
}