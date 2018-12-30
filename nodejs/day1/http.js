
//简单 操作
var m=10;
var n=1
function add(x,y) { 
    return x+y;
 }
 var resule=add(m,n);
 console.log("计算结果是："+resule);
 // console.log("hello word");


 //-------------实现文件写入

 // var fs =require('fs');
 // var msg='hello word'
 // fs.writeFile('./hello.txt',msg,'utf8',function(err){
 //     if(err){
 //         console.log('写文件出错，具体错误是'+err)
 //     }else{
 //         console.log('ok');
 //     }
 // })

 //------------读取文件
    // 加载fs模块
    // 
    var filename=__dirname+'\\'+'hello.txt';
    // var filename=__filename
    var fs=require('fs')
    fs.readFile(filename,'utf8',function(err,data){
        if(err){
            throw err
        }
        //data 参数的数据类型是一个buffer对象----把buffer对象 转换为字符串 ，调用toString（）
        // .toString('utf8')  转换为 utf-8 编码格式
        console.log(data)
    })

    // ---------解决再文件读取中 ./   相对路径的问题 
    // 解决：  __dirname: 当前执行文件所在的目录  __filename： 当前执行文件的完整路径
    console.log(__dirname)
    console.log(__filename)

var http =require('http');
var fs=require('fs')
var path=require('path')
 http.createServer(function(req,res){
 	//设置报文响应头,告诉浏览器使用响应的数据
	res.setHeader('Content-tyoe','text/html;charset=utf-');
	if(req.url===''|| req.url==="/index"){
        // res.end('Hello Index <h1>你22 哈皮</h1>')
        // readFile 读取文件
        console.log(__dirname);
        
        fs.readFile(path.join(__dirname,'htmls','index.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/login"){
        res.end('Hello login')
        fs.readFile(path.join(__dirname,'htmls','login.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/list"){
        res.end('Hello list')
        fs.readFile(path.join(__dirname,'htmls','list.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else if(req.url==="/register"){
        res.end('Hello register')
        fs.readFile(path.join(__dirname,'htmls','register.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}else{
        // res.end('404 , not Fount . 客户端错误')
        fs.readFile(path.join(__dirname,'htmls','404.html'),function(err,data){
            if(err){
                throw err
            }
            res.end(data)
        })
	}
}).listen(9090,function(){ 
	console.log('服务器启动了，请访问 ： http://localhost:9090')
})
