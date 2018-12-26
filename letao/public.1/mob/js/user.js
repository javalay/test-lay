//用一个全局变量记录 数据
var userInfo=null;
    //  判断是否登录 
    $.ajax({
        type: "GET",
        url: "/user/queryUserMessage",
        async: false, //同步
        success: function (response) {
            console.log(response);
            if (response.error && response.error == 400) {
                // setTimeout(function(){
                    location.href = 'login.html'
                // },2000)
            }else{
                userInfo=response;
            }
        }
    });
 
$(function () {
    
    var html=template('userTpl',userInfo);
    $("#user").html(html);
    //退出按钮功能
    $("#logout").on('click', function () {
        $.ajax({
            type: "GET",
            url: "/user/logout  ",
            success: function (response) {
                if (response.success) {
                    mui.toast('退出成功');
                    setTimeout(function () {
                        location.href = "index.html";
                    }, 1000)
                } else {
                    mui.toast('退出失败');
                }
            }
        });
    })
})