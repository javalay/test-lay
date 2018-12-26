$(function(){
    //  声明一个对象 三级联动选项
    var picker = new mui.PopPicker({layer:3});
    //把响应的数据添加到主键中 cityData 是一个数组
    picker.setData(cityData);
    //键盘敲击事件 
    $("#showCityPicker").on('tap',function(){
        // alert(12);  暂时主键上面的内容 
        picker.show(function (selectItems) {
            console.log(selectItems);
            console.log(selectItems[0].text)//智子
            console.log(selectItems[1].text)//zz 
            console.log(selectItems[2].text)//zz 
            console.log(selectItems[2].value)//zz 
            $("#showCityPicker").val(selectItems[0].text+selectItems[1].text+selectItems[2].text)
            $("#postcode").val(selectItems[2].value)
          });
    });
    $("#addAdress").on("tap",function(){
       var username= $('[name="recipients"]').val()//用户名
       var detail= $("[name='detail']").val()//三级联动地址
        var postcode=$("[name='postcode']").val()//邮编
        var city= $("[name='city']").val()//详细地址
        console.log(detail+postcode)
        if(!username){
            mui.toast('请输入收件人')
            return;
        }
        if(!detail){
            mui.toast('请选择省市区地址')
            return;
        }
        if(!city){
            mui.toast('请输入详情地址')
            return;
        }
        $.ajax({
            type: "post",
            url: "/address/addAddress", 
            data: {
                address:detail,//三级联动地址
                addressDetail:city,//详细地址
                recipients:username,//收货人
                postcode :postcode,//邮编
            },
            success: function (response) {
                console.log(response);
                if(response.success){
                    setTimeout(function(){
                        mui.toast('添加成功')
                        location.href = "address.html"
                    },1000)
                }
                else{
                   mui.toast('添加失败')
                }
            }
        });
    });
    
	// 默认为添加收货地址
    var flag = true;
    
    // 看地址栏中是否有ID参数 如果有就是修改地址 否则就是添加地址
	if(getParamsByUrl(location.href,'id')){
		// 修改收获地址
		flag = false;
		$.ajax({
			url:'/address/queryAddress',
			method:'get',
			success:function(result){
				for(var i=0;i<result.length;i++){
					if(result[i].id == getParamsByUrl(location.href,'id')){
                        // var editInfo= JSON.parse(localStorage.getItem("editInfo"))
                        // var id=result[i].id
                        $("[name='recipients']").val(result[i].recipients)
                        $("[name='detail']").val(result[i].address)
                        $("[name='postcode']").val(result[i].postCode)
                        $("[name='city']").val(result[i].addressDetail)
					}
				}
			}
		});
    }
    	// 添加收货地址
	$('#addAdress').on('tap',function(){
		var This = $(this);
		var url = '/address/addAddress';
		var data = {
			address:$.trim($("[name='detail']").val()),
			addressDetail:$.trim($("[name='city']").val()),
			recipients:$.trim($("[name='recipients']").val()),
			postcode:$.trim($("[name='postcode']").val())
		}
		if(!data.address){
			mui.toast('请选择地址');
			return;
		}
		if(!data.addressDetail){
			mui.toast('请输入详细地址');
			return;
		}

		if(!data.recipients){

			mui.toast('请输入收货人');

			return;

		}

		if(!data.postcode){

			mui.toast('请输入邮政编码');

			return;

		}

		// 修改收货地址
		if(!flag){
			
			data.id = getParamsByUrl(location.href,'id');

			url = "/address/updateAddress";

		}
		$.ajax({
			url:url,
			type:'post',
			data:data,
			beforeSend:function(){
				This.html('正在'+ (flag ? '添加' : '修改') + '收货地址');
			},
			success:function(result){
				if(result.success){
					location.href = "address.html";
				}else{
					mui.toast(result.message)
				}
			}
		});
	});
    // var editInfo= JSON.parse(localStorage.getItem("editInfo"));
    // console.log(result[i].id);
    // var id=result[i].id
    // var recipients=  $("[name='recipients']").val(result[i].recipients);
    // var address =$("[name='detail']").val(result[i].address);
    // var postCode =$("[name='postcode']").val(result[i].postCode);
    // var addressDetail =$("[name='city']").val(result[i].addressDetail);
    // $.ajax({
    //     type: "POST",
    //     url: "/address/updateAddress",
    //     data: {
    //         id  :id,
    //         address  :address,
    //         addressDetail  :addressDetail,
    //         recipients :recipients,
    //         postcode:postCode,
    //     },
    //     success: function (response) {
    //         console.log(response);
    //     }
    // });
}); 