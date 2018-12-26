$(function(){
    // 修改密码 tap 轻敲事件 不会有300s延时
    $("#modify-btn").on('tap',function(){
        var originPass=$.trim($("[name='originPass']").val());
        var newPass=$.trim($("[name='newPass']").val());
        var sureNewPass=$.trim($("[name='sureNewPass']").val());
        var checkCode=$.trim($("[name='checkCode']").val());
        if(!originPass){
            mui.toast('请输入原密码')
            return;
        }
        if(!newPass){
            mui.toast('请输入新密码')
            return;
        }
        if(!sureNewPass){
            mui.toast('请输入确认新密码')
            return;
        }
        if(newPass !=sureNewPass){
            mui.toast('密码两次输入不一样')
            return;
        }
        if(!/^\d{6}$/.test(checkCode)){
			mui.toast('验证码的格式不符合要求')
			return;
        }
        //
        $.ajax({
            type: "POST",
            url: "/user/updatePassword",
            data: {
                "oldPassword":originPass,
                "newPassword":newPass,
                "vCode":checkCode
            },
            beforeSend:function(){
                $("#modify-btn").html('正在修改密码')
            },
            success: function (response) {
                console.log(response);
                if(response.success){   
                    setTimeout(function(){
                        mui.toast("修改密码成功...")
                        $("#modify-btn").html('确认修改密码')
                        location.href = "login.html"
                    },2000)
                }
                else{
                    mui.toast("修改密码失败"+response.message)
                    $("#modify-btn").html('确认修改密码')
                }
            }
        });
    });
    //调用接口  获取验证码。
    $("#getCode").on('click',function(){
        $.ajax({
            type: "GET",
            url: "/user/vCodeForUpdatePassword",
            success: function (response) {
                $('[name="checkCode"]').val(response.vCode)
            }
        });
    });
});