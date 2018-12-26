$(function () {
    //注册的点击事件
    $('#register-btn').on('click', function () {
		var This = $(this);
        //获取输入框中的数据
        var username = $('[name="username"]').val();
        var mobile = $('[name="mobile"]').val();
        var password = $('[name="password"]').val();
        var againpass = $('[name="againpass"]').val();
        var vCode = $('[name="vCode"]').val();
        //下面是判断输入的数据是否复合规则  
        if(!username){
            mui.toast('请输入用户名')
            return;
        }
        var str=/0?(13|14|15|18)[0-9]{9}/;
        if(!str.test(mobile)){
            mui.toast('请输入合法的手机号')
            return;
        }
        if(!password){
            mui.toast('请输入密码')
            return;
        }
        if(!againpass){
            mui.toast('请输入确认密码')
            return;
        }
        if(password!=againpass){
            mui.toast('请输入相同的密码')
            return;
        }
        if(!/^\d{6}$/.test(vCode)){
			mui.toast('验证码输入的格式不正确');
			return;
        }
        //调用接口判断是否注册成功
        $.ajax({
            type: "post",
            url: "/user/register",
            data: {
                username:username,
                mobile:mobile,
                password:password,
                vCode:vCode
            },
            beforeSend:function(){
                    This.html('正在提交数据...');
			},
            success: function (response) {
                console.log(response["success"]);
                if(response.success){
                setTimeout(function(){
                    mui.toast('注册成功')
                    This.html('注册');
					location.href = "login.html";
                },1000)
                }else if(response["error"]==403){
                    mui.toast(response["message"])
				    This.html('注册')
                }
                else{
                    mui.toast('注册失败')
				    This.html('注册')
                }
            }
        });
    });
   
    //调用接口  获取验证码。
    $(".getCode").on('click',function(){
        $.ajax({
            type: "GET",
            url: "/user/vCode",
            success: function (response) {
                $('[name="vCode"]').val(response.vCode)
            }
        });
    });
});