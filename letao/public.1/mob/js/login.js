$(function(){
    //登录的点击事件
    $("#register-btn").on('click',function(){
        // 获取 输入的用户名和密码
        var username= $.trim($("[name='username']").val());
        var password= $.trim($("[name='password']").val());
        //判断是否有输入值
        if(!username){
            mui.toast('请输入用户名')
            return
        }
        if(!password){
            mui.toast('请输入密码')
            return
        }
        //调用ajax进行登录判断
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: {
                username:username,
                password:password
            },
            beforeSend:function(){
                $("#register-btn").html('正在登录....')
            },
            success: function (response) {
                    console.log(response);
                    //判断有没有登录成功
                if(response.success){
                    //模拟网络延迟 两秒钟
                    setTimeout(function(){
                    mui.toast('登录成功')
                    $("#register-btn").html('立即登录')
                    location.href="user.html"
                },2000)
                }
                else{
                    setTimeout(function(){
                        mui.toast('登录失败')
                        $("#register-btn").html('立即登录')
                    },2000)
                }
            }
        });
    });
});