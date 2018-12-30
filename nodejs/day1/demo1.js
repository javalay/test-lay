var fs=require('fs')
// try---catch 是无法捕获错误异常的
// 对于异常操作，要通过判断错误号 err.code 来进行出错处理
try {
    fs.writeFile('.abc.txt','大家好！！！！！！！','utf8',function(err){
        console.log('ok');
        
    })
} catch (error) {
    console.log('出错了'+e.code);
    
} 