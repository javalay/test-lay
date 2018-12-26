$(function(){
    //搜索按钮点击事件
    $('#searchBtn').on('click',function(){
        //定义一个全局变量-方便后面的方法的调用
        var keywords=[];
        //获取文本框中的val属性
        var keyword=$('#keyword').val();
        //把值储存在数组中
        keywords.push(keyword);
        if(!keyword){
            alert('请输入关键字');
            return;
        }
        console.log(keywords); 
        //先把获取到的数据存储起来
        if(localStorage.getItem('keywords')){
            // JSON.parse 把字符串转换成json对象
            var keywords=JSON.parse(localStorage.getItem('keywords'));
            keywords.push(keyword);
            localStorage.setItem('keywords',JSON.stringify(keywords));
            console.log(keywords);
        }
        else{
            //如果里面没有数据，就把上面数组的值添加到 localStorage 中
            localStorage.setItem('keywords',JSON.stringify(keywords));
        }
        //
        if(localStorage.getItem('keywords')){
            // JSON.parse 把字符串转换成json对象
            var keywords=JSON.parse(localStorage.getItem('keywords'));
            var html=template('historyTpl',{result:keywords});
            $("#history-box").html(html);
        }
        //页面跳转
        location.href="search-list.html?key="+keyword;
    });
    //清除数据
    $("#clearbtn").on('tap',function(){
        console.log(222);
        localStorage.removeItem('keywords');
        $('#history-box').html('');
        keywords=[];
    });
});