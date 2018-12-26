$(function(){
    //存储收获地址的一个数组
    var editInfo=null;

    //获取地址栏的数据
    $.ajax({
        url: "/address/queryAddress",
        method: "get",
        success: function (response) {
            console.log(response);
            editInfo=response;
            console.log(editInfo);
            
            //把获得的数据添加到 页面中
			$('#adress').html(template('adressTpl',{result:response}))
        }
    });
    //删除地址栏数据
    $("#adress").on('tap','.deleteAdress',function(){
        // getAttribute 原生获取自定义属性
        var id=this.getAttribute("data-id");
        // parentNode  原生写法获取父级节点 
        // var li=this.parentNode.parentNode;
        //jQuery 写法 
        var li=$(this).parent().parent();
        console.log(li);
        mui.confirm("确认要删除吗？",function(message){
            console.log(message)
            if(message.index==0){
                //取消删除
                // 关闭列表的滑动效果  li[0] 转换为源生格式
                mui.swipeoutClose(li[0]);
            }
            else{
                // 确认删除
                $.ajax({
                    type: "POST",
                    url: "/address/deleteAddress",
                    data: {
                        id:id
                    },
                    success: function (response) {
                        console.log(response)
                        if(response.success){
                            //刷新页面 这样会有页面跳转的效果， 
                            // location.reload()
                            //直接删除当前li标签
                            li.remove();
                        }
                    }
                })
            }
        })
    })
    //编辑按钮
    // $("#adress").on('tap','.edit-btn',function(){
    //     var id=this.getAttribute("data-id");
    //     console.log(id);
    //     for(var i=0;i<editInfo.length;i++){
    //         if(editInfo[i].id==id){
    //             localStorage.setItem("editInfo",JSON.stringify(editInfo[i]))
	// 				location.href = "addAddress.html";
    //         }
    //     }
    // })
})