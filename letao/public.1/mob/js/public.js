$(function(){
    //恢复a元素的跳转
    $('body').on('tap','a',function(){
        mui.openWindow({
            url:$(this).attr('href')
        });
    });
});
// 获取认证码
function getCheckCode(){

	$.ajax({
		type:'get',
		url:'/user/vCode',
		success:function(result){
			alert(result.vCode)
		}
	});

}

// 获取地址栏参数
function getParamsByUrl(url,name){

	var params = url.substr(url.indexOf('?')+1).split('&');

	for(var i=0;i<params.length;i++){

		var param = params[i].split('=');

		if(param[0] == name){

			return param[1];

		}

	}

	return null;

}
