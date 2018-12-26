$(function(){
    $("#loginBtn").on('click',function(){
        var username=$.trim($("#username").val())
        var password=$.trim($("#password").val())
        // alert(username)

        data={
            username:username,
            password:password
        }
        console.log(data);
        
        if(!username){
            alert("请输入用户名");
            return;
        }
        if(!password){
            alert("请输入密码");
            return;
        }
        $.ajax({
            type: "post",
            url: "/employee/employeeLogin",
            data: data,
            success: function (response) {
                // console.log(response);
                if(response.success){
					location.href = "user.html";
                }
                else{
                    if(result.error){
						alert(result.message)
					}
                }
            }
        });
    });
});