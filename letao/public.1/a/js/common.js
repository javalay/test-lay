$(function(){
    $("#loginOut").on('click',function(){
        if(confirm("确定要退出吗?")){
            $.ajax({
                type: "get",
                url: "/employee/employeeLogout",
                success: function (response) {
                    console.log(response);
                    if(response.success){
					location.href = "login.html";
                    }
                    else{
                        alert("退出失败")
                    }
                }
            });
        }
    })
})